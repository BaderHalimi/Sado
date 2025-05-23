<?php

namespace App\Http\Controllers\api\v1;

use App\CPU\BrandManager;
use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Product;
use App\Model\RoomDesign;
use App\Model\OrderDetail;
use App\Model\Review;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function get_brands(Request $request)
    {
        if($request->has('seller_id') && !empty($request->seller_id)){
            //finding brand ids
            $brand_ids = Product::active()
                ->when($request->has('seller_id') && !empty($request->seller_id), function ($query) use ($request) {
                    return $query->where(['added_by' => 'seller'])
                        ->where('user_id', $request->seller_id);
                })->pluck('brand_id');

            $brands = Brand::active()->whereIn('id', $brand_ids)->withCount('brandProducts')->latest()->get();
        }else{
            $brands = BrandManager::get_active_brands();
        }

        return response()->json($brands,200);
    }

    public function get_products(Request $request, $brand_id)
    {
        try {
            $products = BrandManager::get_products($brand_id, $request);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e], 403);
        }

        return response()->json($products,200);
    }

    public function roomList(Request $request) {
        $products = Product::where('room_id', '>', '0')->latest()->get();

        // foreach($products as $product) {
        //     $base64Data = substr($product->thumbnail, strpos($product->thumbnail, ',') + 1);
        //     $is_base64 = base64_decode($base64Data, true) !== false;
        //     if ($is_base64) {
        //         $binaryData = base64_decode($base64Data);
        //         $imageInfo = getimagesizefromstring($binaryData);
        //         $imageType = $imageInfo[2];
        //         $extension = image_type_to_extension($imageType);
        //         $filename = $product->id . '.png';
        //         $url = '/assets/images/room/' . $filename;
        //         file_put_contents(public_path($url), $binaryData);            
        //     } 
        // }

        $latest_products = Product::where('room_id', '>', '0')->orderBy('id', 'desc')->take(8)->get();
        $categories = Category::with('childes.childes')->where(['position' => 0])->priority()->take(11)->get();
        $brands = Brand::active()->take(15)->get();
        //best sell product
        $bestSellProduct = OrderDetail::with('product.reviews')
            ->whereHas('product', function ($query) {
                $query->active();
            })
            ->select('product_id', DB::raw('COUNT(product_id) as count'))
            ->groupBy('product_id')
            ->orderBy("count", 'desc')
            ->take(4)
            ->get();

        //Top-rated
        $topRated = Review::with('product')
            ->whereHas('product', function ($query) {
                $query->active();
            })
            ->select('product_id', DB::raw('AVG(rating) as count'))
            ->groupBy('product_id')
            ->orderBy("count", 'desc')
            ->take(4)
            ->get();

        if ($bestSellProduct->count() == 0) {
            $bestSellProduct = $latest_products;
        }

        if ($topRated->count() == 0) {
            $topRated = $bestSellProduct;
        }
        $bestSellProduct = $latest_products;
        $topRated = $bestSellProduct;

        return response()->json([
            'products' => $products,
            'topRated' => $topRated,
            'bestSellProduct' => $bestSellProduct,
            'brands' => $brands,
            'categories' => $categories,
            'latest_products' => $latest_products,
        ]);

        // return view('roomDesign.roomList', compact('products', 'topRated', 'bestSellProduct', 'brands', 'categories', 'latest_products'));
    }
}
