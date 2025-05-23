<?php

namespace App\Http\Controllers;

use App\CPU\CartManager;
use App\CPU\OrderManager;
use App\Model\Customer;
use App\Model\PaymentRequest;
use App\Traits\Processor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use MyFatoorah\Library\MyFatoorah;
use MyFatoorah\Library\API\Payment\MyFatoorahPayment;
use MyFatoorah\Library\API\Payment\MyFatoorahPaymentEmbedded;
use MyFatoorah\Library\API\Payment\MyFatoorahPaymentStatus;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MyFatoorahController extends Controller
{

    use Processor;

    /**
     * @var array
     */
    private $config_values;
    public $mfConfig = [];
    private PaymentRequest $payment;

    //-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Initiate MyFatoorah Configuration
     */
    public function __construct(PaymentRequest $payment)
    {
        $this->payment = $payment;
        $this->payment['guest_id'] = session('guest_id') ?? null;
        // dd($this->payment);

        $config = $this->payment_config('fatoorah', 'payment_config');

        if (!is_null($config) && $config->mode == 'live') {
            $this->config_values = json_decode($config->live_values);
        } elseif (!is_null($config) && $config->mode == 'test') {
            $this->config_values = json_decode($config->test_values);
        } else {
            $this->config_values = null;
        }
        // dd($this->config_values->country_code ?? 'KWT');
        if (!is_null($this->config_values)) {
            $this->mfConfig = [
                'apiKey'      => $this->config_values->api_key,
                'isTest'      => ($config->mode == 'test') ? true : false,
                'countryCode' => $this->config_values->country_code ?? 'KWT',
            ];
        }
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Redirect to MyFatoorah Invoice URL
     * Provide the index method with the order id and (payment method id or session id)
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|uuid'
        ]);
        if ($validator->fails()) {
            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_400, null, $this->error_processor($validator)), 400);
        }
        $data = $this->payment::where(['id' => $request['payment_id']])->where(['is_paid' => 0])->first();
        // dd($data);
        if (!isset($data)) {
            return response()->json($this->response_formatter(GATEWAYS_DEFAULT_204), 200);
        }
        // $config = $this->config_values;
        // dd($data);
        try {
            //For example: pmid=0 for MyFatoorah invoice or pmid=1 for Knet in test mode
            // dd($request);

            $curlData = $this->getPayLoadData($data);

            $mfObj   = new MyFatoorahPayment($this->mfConfig);
            $payment = $mfObj->getInvoiceURL($curlData);

            return redirect($payment['invoiceURL']);
        } catch (Exception $ex) {
            $exMessage = __('myfatoorah.' . $ex->getMessage());
            return response()->json(['IsSuccess' => 'false', 'Message' => $exMessage]);
        }
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Example on how to map order data to MyFatoorah
     * You can get the data using the order object in your system
     * 
     * @param int|string $orderId
     * 
     * @return array
     */
    private function getPayLoadData($data = null)
    {
        // dd(session('guest_id'));
        $callbackURL = route('myfatoorah.callback', ['payment_id' => $data['id']]);
        //You can get the data using the order object in your system
        // $order = $this->getTestOrderData($orderId);

        return [
            'CustomerName'       => Auth::user()->name ?? 'Guest',
            'InvoiceValue'       => $data['payment_amount'],
            'DisplayCurrencyIso' => $data['currency_code'],
            'CustomerEmail'      => Auth::user()->email ?? 'guest@sado-ksa.com',
            'CallBackUrl'        => $callbackURL,
            'ErrorUrl'           => $callbackURL,
            // 'MobileCountryCode'  => '+965',
            'CustomerMobile'     => Auth::user()->phone ?? '0000000000',
            'Language'           => 'en',
            'CustomerReference'  => $data['id'],
            'SourceInfo'         => 'Sado - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION
        ];
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Get MyFatoorah Payment Information
     * Provide the callback method with the paymentId
     * 
     * @return Response
     */
    public function callback()
    {
        try {
            $paymentId = request('paymentId');
            // dd($paymentId);
            $mfObj = new MyFatoorahPaymentStatus($this->mfConfig);
            $data  = $mfObj->getPaymentStatus($paymentId, 'PaymentId');
            // dd($data);
            $message = $this->getTestMessage($data->InvoiceStatus, $data->InvoiceError);
            if ($data->InvoiceStatus == 'Paid') {
                $this->payment::where(['id' => request('payment_id')])->update([
                    'payment_method' => 'fatoorah',
                    'is_paid' => 1,
                    'transaction_id' => $data->InvoiceId,
                ]);
                $data = $this->payment::where(['id' => request('payment_id')])->first();
                session()->put('guest_id', $data->payer_id);
                if (isset($data) && function_exists($data->success_hook)) {
                    $this->payment_success($data);
                    // call_user_func($data->success_hook, $data);
                }
                // dd($data);
                // $response = ['IsSuccess' => true, 'Message' => $message, 'Data' => $data];
                return $this->payment_response($data, 'success');
            } else {
                $payment_data = $this->payment::where(['id' => request('payment_id')])->first();
                if (isset($payment_data) && function_exists($payment_data->failure_hook)) {
                    call_user_func($payment_data->failure_hook, $payment_data);
                }
                return $this->payment_response($payment_data, 'fail');
            }
        } catch (Exception $ex) {
            $exMessage = __('myfatoorah.' . $ex->getMessage());
            // $response  = ['IsSuccess' => 'false', 'Message' => $exMessage];
            // dd('hi');
            // $payment_data = $this->payment::where(['id' => request('payment_id')])->first();
            // if (isset($payment_data) && function_exists($payment_data->failure_hook)) {
            //     call_user_func($payment_data->failure_hook, $payment_data);
            // }
            // return $this->payment_response($payment_data, 'fail');
        }

        // return response()->json($response);
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Example on how to Display the enabled gateways at your MyFatoorah account to be displayed on the checkout page
     * Provide the checkout method with the order id to display its total amount and currency
     * 
     * @return View
     */
    public function checkout()
    {
        try {
            //You can get the data using the order object in your system
            $orderId = request('oid') ?: 147;
            $order   = $this->getTestOrderData($orderId);

            //You can replace this variable with customer Id in your system
            $customerId = request('customerId');

            //You can use the user defined field if you want to save card
            $userDefinedField = config('myfatoorah.save_card') && $customerId ? "CK-$customerId" : '';

            //Get the enabled gateways at your MyFatoorah acount to be displayed on checkout page
            $mfObj          = new MyFatoorahPaymentEmbedded($this->mfConfig);
            $paymentMethods = $mfObj->getCheckoutGateways($order['total'], $order['currency'], config('myfatoorah.register_apple_pay'));

            if (empty($paymentMethods['all'])) {
                throw new Exception('noPaymentGateways');
            }

            //Generate MyFatoorah session for embedded payment
            $mfSession = $mfObj->getEmbeddedSession($userDefinedField);

            //Get Environment url
            $isTest = $this->mfConfig['isTest'];
            $vcCode = $this->mfConfig['countryCode'];

            $countries = MyFatoorah::getMFCountries();
            $jsDomain  = ($isTest) ? $countries[$vcCode]['testPortal'] : $countries[$vcCode]['portal'];

            return view('myfatoorah.checkout', compact('mfSession', 'paymentMethods', 'jsDomain', 'userDefinedField'));
        } catch (Exception $ex) {
            $exMessage = __('myfatoorah.' . $ex->getMessage());
            return view('myfatoorah.error', compact('exMessage'));
        }
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Example on how the webhook is working when MyFatoorah try to notify your system about any transaction status update
     */
    public function webhook(Request $request)
    {
        try {
            //Validate webhook_secret_key
            $secretKey = config('myfatoorah.webhook_secret_key');
            if (empty($secretKey)) {
                return response(null, 404);
            }

            //Validate MyFatoorah-Signature
            $mfSignature = $request->header('MyFatoorah-Signature');
            if (empty($mfSignature)) {
                return response(null, 404);
            }

            //Validate input
            $body  = $request->getContent();
            $input = json_decode($body, true);
            if (empty($input['Data']) || empty($input['EventType']) || $input['EventType'] != 1) {
                return response(null, 404);
            }

            //Validate Signature
            if (!MyFatoorah::isSignatureValid($input['Data'], $secretKey, $mfSignature, $input['EventType'])) {
                return response(null, 404);
            }

            //Update Transaction status on your system
            $result = $this->changeTransactionStatus($input['Data']);

            return response()->json($result);
        } catch (Exception $ex) {
            $exMessage = __('myfatoorah.' . $ex->getMessage());
            return response()->json(['IsSuccess' => false, 'Message' => $exMessage]);
        }
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------
    private function changeTransactionStatus($inputData)
    {
        //1. Check if orderId is valid on your system.
        $orderId = $inputData['CustomerReference'];

        //2. Get MyFatoorah invoice id
        $invoiceId = $inputData['InvoiceId'];

        //3. Check order status at MyFatoorah side
        if ($inputData['TransactionStatus'] == 'SUCCESS') {
            $status = 'Paid';
            $error  = '';
        } else {
            $mfObj = new MyFatoorahPaymentStatus($this->mfConfig);
            $data  = $mfObj->getPaymentStatus($invoiceId, 'InvoiceId');

            $status = $data->InvoiceStatus;
            $error  = $data->InvoiceError;
        }

        $message = $this->getTestMessage($status, $error);

        //4. Update order transaction status on your system
        return ['IsSuccess' => true, 'Message' => $message, 'Data' => $inputData];
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------
    private function getTestOrderData($orderId)
    {
        return [
            'total'    => 15,
            'currency' => 'KWD'
        ];
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------
    private function getTestMessage($status, $error)
    {
        if ($status == 'Paid') {
            return 'Invoice is paid.';
        } else if ($status == 'Failed') {
            return 'Invoice is not paid due to ' . $error;
        } else if ($status == 'Expired') {
            return $error;
        }
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------
    function payment_success($payment_data)
    {
        if (isset($payment_data) && $payment_data['is_paid'] == 1) {
            $unique_id = OrderManager::gen_unique_id();
            $order_ids = [];
            $additional_data = json_decode($payment_data['additional_data']);
            $data = $payment_data->toArray();
            
            $cart_group_ids = CartManager::get_cart_group_ids();
            session()->put('payment_mode', 'web');
            // dd('hi');
            foreach ($cart_group_ids as $group_id) {
                $data += [
                    'payment_method' => $payment_data['payment_method'],
                    'order_status' => 'confirmed',
                    'payment_status' => 'paid',
                    'transaction_ref' => $payment_data['transaction_id'],
                    'order_group_id' => $unique_id,
                    'cart_group_id' => $group_id,
                    
                ];
                // dd($data);
                try {
                    $order_id = OrderManager::generate_order($data);
                } catch (\Throwable $e) {
                    dd($e->getMessage(), $e->getFile(), $e->getLine());
                }                
                unset($data['payment_method']);
                unset($data['cart_group_id']);
                array_push($order_ids, $order_id);
            }
            // dd($cart_group_ids);

            if (isset($additional_data->payment_request_from) && in_array($additional_data->payment_request_from, ['app', 'react'])) {
                CartManager::cart_clean_for_api_digital_payment($data);
            } else {
                CartManager::cart_clean();
            }
        }
    }
}
