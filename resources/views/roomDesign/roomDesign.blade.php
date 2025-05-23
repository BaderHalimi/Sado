<!DOCTYPE html>
<html>
  <head>
    <title>Architect 3D - Example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('public/roomDesign/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/assets/back-end')}}/css/toastr.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{asset('public/roomDesign/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="{{asset('public/roomDesign/css/app.css')}}" rel="stylesheet">

    <style>
      .category-menu-wrap .category-menu {
        list-style: none;
        padding: 5px 10px 5px 15px;
        display: flex;
        flex-direction: column;
        width: var(--cm-w);
        background-color: #fff;
        padding-block: 0.5rem;
        font-size: 13px;
        border-radius: 5px;
        border: 1px solid #eef6ff;
        box-shadow: 0px 0px 2px 0px rgba(0, 113, 220, 0.05), 0px 2px 5px -4px rgba(27, 127, 237, 0.05);
        margin-top: 1rem;
        margin-bottom: 0;
        max-height: 386px;
        overflow-y: auto;
      }

      .category-menu-wrap .category-menu li a {
        color: black;
      }

      .category-menu-wrap .category-menu > li:not(:last-child), .sub-category-menu > li:not(:last-child), .sub-sub-category-menu > li:not(:last-child) {
          border-bottom: 1px solid rgba(185, 185, 185, 0.2);
      }

      .category-menu-wrap .category-menu > li, .sub-category-menu > li, .sub-sub-category-menu > li {
          padding: 0.625rem 0rem;
      }
      .category-menu-wrap .category-menu > li > a, .sub-category-menu > li > a, .sub-sub-category-menu > li > a {
          display: flex;
          justify-content: space-between;
          align-items: center;
          gap: 0.5rem;
      }

      .category-menu-wrap .category-menu, .sub-category-menu, .sub-sub-category-menu {
        list-style-type: none;
      }

      .mega_menu {
        display: none;
      }

      .mega_menu_inner {
        display: none;
      }

      .end-mega {
        display: none;
      }

      .d-none {
        display: none;
      }

      .d-block {
        display: block;
      }

      body { margin: 0; }
      canvas { display: block; }
    </style>

    <script src="{{asset('public/roomDesign/js/lib/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('public/roomDesign/js/lib/jquery.flip.min.js')}}"></script>
    <script src="{{asset('public/roomDesign/js/lib/dat.gui.min.js')}}"></script>
    <script src="{{asset('public/roomDesign/js/lib/quicksettings.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('public/roomDesign/js/bp3djs.js')}}"></script>
    <script src="{{asset('public/roomDesign/js/nav.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/OBJLoader.js"></script>
  </head>

  <body>
    {{-- Left Menu --}}
    <div class="left-container">
      <div class="left-toolbar">
        <div class="left-toolbar-button {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="addRoomPlan1" data-bs-toggle="tooltip" data-bs-placement="right" title="{{\App\CPU\translate('Add Room')}}">
          <img src="{{asset('public/roomDesign/rooms/room.svg')}}" />
        </div>

        <div class="left-toolbar-button {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="addRoomPlan2" data-bs-toggle="tooltip" data-bs-placement="right" title="{{\App\CPU\translate('Add L-Shape')}}">
          <img src="{{asset('public/roomDesign/rooms/room-1.svg')}}" />
        </div>

        <div class="left-toolbar-button addStaticItem {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="addStaticItem"
            model-name="windows"
            model-url="public/roomDesign/models/js/whitewindow.js"
            model-type="3"
            data-bs-toggle="tooltip" data-bs-placement="right" title="{{\App\CPU\translate('Add Windows')}}">
          <img src="{{asset('public/roomDesign/rooms/window.svg')}}" />
        </div>
        <div class="left-toolbar-button addStaticItem {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="addStaticItem"
          model-name="Doorway"
          model-url="public/roomDesign/models/js/closed-door28x80_baked.js"
          model-type="7"
          data-bs-toggle="tooltip" data-bs-placement="right" title="{{\App\CPU\translate('Add door')}}">
          <img src="{{asset('public/roomDesign/rooms/door.svg')}}" />
        </div>
        <div class="left-toolbar-button addStaticItem {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="addStaticItem"
          model-name="open door"
          model-url="public/roomDesign/models/js/open_door.js"
          model-type="7"
          data-bs-toggle="tooltip" data-bs-placement="right" title="{{\App\CPU\translate('Add Opennig')}}">
          <img src="{{asset('public/roomDesign/rooms/open-door.svg')}}" />
        </div>

        <div class="left-toolbar-button" id="addCeilBtn"
          data-bs-toggle="tooltip" data-bs-placement="right" title="{{\App\CPU\translate('Ceiling Options')}}">
          <img src="{{asset('public/roomDesign/rooms/ceil.svg')}}" />
        </div>

        <div class="hr"></div>

        <a class="left-toolbar-button" data-bs-toggle="tooltip" data-bs-placement="right" title="{{\App\CPU\translate('Go Home')}}" href="{{route('room-list')}} ">
          <span class="material-symbols-outlined">
            home
          </span>
        </a>

        <div class="left-toolbar-button" id="viewType" data-bs-toggle="tooltip" data-bs-placement="right" title="{{\App\CPU\translate('3D View')}}">
          <span class="material-symbols-outlined">
            deployed_code
          </span>
        </div>

        <div class="left-toolbar-button {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="lockItems" data-bs-toggle="tooltip" data-bs-placement="right" title="{{\App\CPU\translate('Lock')}}">
          <span class="material-symbols-outlined">
            lock_open
          </span>
        </div>

        <div class="left-toolbar-button {{$data['isRoomLock'] == 0? 'item-hidden' : ''}}" id="addRoomItem" data-bs-toggle="tooltip" data-bs-placement="right" title="{{\App\CPU\translate('Add Room item')}}">
          <span class="material-symbols-outlined">
            shopping_cart
          </span>
        </div>

        <div class="left-toolbar-button {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="showAddItems" data-bs-toggle="tooltip" data-bs-placement="right"   title="{{\App\CPU\translate('Add/Remove items in 3D')}}">
          <span class="material-symbols-outlined" data-bs-toggle="modal" data-bs-target="#add-items-modal" >
            shopping_cart
          </span>
        </div>

        <div class="hr"></div>

        <div class="left-toolbar-button {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="new" data-bs-toggle="tooltip" data-bs-placement="right" title="{{\App\CPU\translate('New Room')}}">
          <span class="material-symbols-outlined">
            note_add
          </span>
        </div>

        <div class="left-toolbar-button {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="designBtn" data-bs-toggle="tooltip" data-bs-placement="right" title="{{\App\CPU\translate('Design Room for sale')}}">
          <span class="material-symbols-outlined">
            screenshot_monitor
          </span>
        </div>

      </div>
    </div>

    <!-- Save Design Room Part -->
    <div id="add-design-room">
      <div class="mb-3">
        <label for="roomName" class="form-label">{{\App\CPU\translate('Room Name')}}</label>
        <input type="text" class="form-control" id="roomName" placeholder="{{\App\CPU\translate('Please Input Room Name')}}">
      </div>

      <div class="mb-3 text-center">
        <img id="roomPreviewer" src="..." class="rounded mx-auto d-block" alt="room design">
      </div>
      <div class="mb-3 text-center mt-2">
        <button id="designSaveBtn" class="btn btn-success">{{\App\CPU\translate('Save')}}</button>
        <button id="designScreenShotBtn" class="btn btn-info">{{\App\CPU\translate('ScreenShot')}}</button>
        <button id="designCancel" class="btn btn-danger">{{\App\CPU\translate('Cancel')}}</button>
      </div>
    </div>

    <div id="interfaces" class="card">
      <div id="floorplanner" class="front">
        <div id="floorplanner-controls">
          <button id="move" class="btn btn-sm btn-secondary" title="{{\App\CPU\translate('Move Walls')}}">
            <span class="material-symbols-outlined">
              open_with
            </span>
          </button>
          <button id="draw" class="btn btn-sm btn-secondary" title="{{\App\CPU\translate('Draw New Walls')}}">
            <span class="material-symbols-outlined">
              stylus_note
            </span>
          </button>
          <button id="delete" class="btn btn-sm btn-secondary" title="{{\App\CPU\translate('Delete Walls')}}">
            <span class="material-symbols-outlined">
              close
            </span>
          </button>
          <button id="new2d" class="btn btn-sm btn-secondary" title="{{\App\CPU\translate('Remove all Walls')}}">
            <span class="material-symbols-outlined">
              delete
            </span>
          </button>
          <button id="help2d" class="btn btn-sm btn-secondary" title="Tips&#10;Shift Key: Snap To Axis and Snap to Grid&#10;ESC: Stop drawing walls&#10;DbL-Click(Corner): Adjust Elevation&#10;Click(Room): Change Name&#10;">
            <span class="material-symbols-outlined">
              help
            </span>
          </button>
          <button id="zoomIn2d" class="btn btn-sm btn-secondary" title="{{\App\CPU\translate('Zoom in 2D Plan')}}">
            <span class="material-symbols-outlined">
              zoom_in
            </span>
          </button>
          <button id="zoomOut2d" class="btn btn-sm btn-secondary" title="{{\App\CPU\translate('Zoom out 2D Plan')}}">
            <span class="material-symbols-outlined">
              zoom_out
            </span>
          </button>
        </div>
        <div class="btn-hint ">{{\App\CPU\translate('Press the "Esc" key to stop drawing walls')}}</div>
        <canvas id="floorplanner-canvas"></canvas>
      </div>

      <div id="viewer" class="back">
        <div id="viewer-container">
          <canvas id="viewer-canvas"></canvas>
        </div>
      </div>
    </div>
    <div id="interface-controls">
      <div class="btn-group-vertical" id="viewcontrols">
        <div class="btn btn-sm btn-default border border-secondary">
          <a class="btn btn-default bottom border border-secondary" href="#" id="move-left" title="{{\App\CPU\translate('Show side view (left)')}}" aria-label="Left Align">
            <span class="material-symbols-outlined">
              arrow_back
            </span>
          </a>
          <span class="btn-group-vertical">
            <a class="btn btn-default border border-secondary" href="#" id="move-up" title="{{\App\CPU\translate('Show top view')}}">
              <span class="material-symbols-outlined">
                arrow_upward
              </span>
            </a>
            <a class="btn btn-default border border-secondary" href="#" id="isometryview" title="{{\App\CPU\translate('Show 3d view')}}">
              <span class="material-symbols-outlined">
                check_box_outline_blank
              </span>
            </a>
            <a class="btn btn-default border border-secondary" href="#" id="move-down" title="{{\App\CPU\translate('Show front view')}}">
              <span class="material-symbols-outlined">
                arrow_downward
              </span>
            </a>
          </span>
          <a class="btn btn-default bottom border border-secondary" href="#" id="move-right" title="{{\App\CPU\translate('Show side view (right)')}}">
            <span class="material-symbols-outlined">
              arrow_forward
            </span>
          </a>
        </div>
        <button id="zoomInCameraMode" class="btn btn-sm btn-default border border-secondary" title="{{\App\CPU\translate('Zoom Out mode')}}">
          <span class="material-symbols-outlined">
            zoom_in
          </span>
        </button>
        <button id="zoomOutCameraMode" class="btn btn-sm btn-default border border-secondary" title="{{\App\CPU\translate('Zoom In mode')}}">
          <span class="material-symbols-outlined">
            zoom_out
          </span>
        </button>
      </div>
    </div>

    <div class="collapse" id="interface-panel">
      <div>
        <p class="collapse text-center mt-3 wall-texture show" id="wall-title">{{\App\CPU\translate('Wall Texture')}}</p>
        <p class="collapse text-center mt-3 floor-texture" id="floor-title">{{\App\CPU\translate('Floor Texture')}}</p>

        <div class="row justify-content-center">
          <button class="btn btn-primary col-md-3 me-4" type="button" data-bs-toggle="collapse" data-bs-target=".wall-texture" aria-expanded="false" aria-controls="interface-color wall-title">
            {{\App\CPU\translate('Wall')}}
          </button>
          <button class="btn btn-primary col-md-3" type="button" data-bs-toggle="collapse" data-bs-target=".floor-texture" aria-expanded="false" aria-controls="interface-floor floor-title">
            {{\App\CPU\translate('Floor')}}
          </button>
        </div>

        <div class="collapse interface-color wall-texture show" id="interface-color"  data-bs-parent="#interface-panel">
          <div class="color-item" data-url="public/roomDesign/rooms/textures/wall-1.png" data-stretch="1" data-scale="1"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{\App\CPU\translate('Update wall texture.')}}" >
            <img src="{{asset('public/roomDesign/rooms/textures/wall-1.png')}}"/>
          </div>
        </div>

        <div class="collapse interface-color floor-texture" id="interface-floor"  data-bs-parent="#interface-panel">
          <div class="color-floor" data-url="public/roomDesign/rooms/textures/wall-1.png" data-stretch="1" data-scale="1"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{\App\CPU\translate('Update Floor texture.')}}" >
            <img src="{{asset('public/roomDesign/rooms/textures/wall-1.png')}}"/>
          </div>
        </div>
      </div>
    </div>

    <div class="row top-left-panel me-4">
      <button class="btn btn-primary " type="button" data-bs-toggle="collapse" data-bs-target="#interface-panel" aria-expanded="false" aria-controls="interface-panel">
        Texture
      </button>
    </div>

    <!-- Add Items -->
    <div class="modal fade" id="add-items-modal" role = "dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            <h4 class="modal-title">Furniture Inventory</h4>
          </div>
          <div class="modal-body">
            <div id="add-items" class="panel-group">
              <div class="input-group-overlay mx-lg-4 search-form-mobile"
                  style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}}">
                  <input class="form-control appended-form-control search-bar-input" type="text"
                        autocomplete="off"
                        placeholder="{{ translate("search_here")}}..."
                        name="name">
              </div>
              <div class="row search-result-box mt-2">
              </div>
              <div class="all-result-box">
                @if ($categories->count() > 0 )
                  <div class="position-static ">
                      <div class="category-menu-wrap position-static">
                          <ul class="category-menu mt-0">
                              @foreach ($categories as $key=>$category)
                                  <li class="row">
                                      <a class="parent-category">{{$category->name}}</a>
                                      @if ($category->childes->count() > 0)
                                          <div class="mega_menu z-2">
                                              <ul class="sub-category-menu">
                                                @foreach ($category->childes as $key=>$sub_category)
                                                    <li class="row">
                                                        <a class="sub-parent-category">{{$sub_category->name}}</a>
                                                        @if ($sub_category->childes->count() >0)
                                                          <div class="mega_menu_inner">
                                                            <ul class="sub-sub-category-menu">
                                                              @foreach ($sub_category->childes as $sub_sub_category)
                                                                <li class="row">
                                                                  <a class="sub-sub-category">{{$sub_sub_category->name}}</a>
                                                                  <div class="row end-mega" id="items-wrapper">
                                                                    @foreach($products as $product)
                                                                      @if($product['sub_sub_category_id'] == $sub_sub_category['id'])
                                                                      <div class="col-sm-4">
                                                                        <a class="thumbnail add-item"
                                                                          data-dismiss="modal"
                                                                          product-id="{{ $product['id'] }}"
                                                                          model-price="{{ $product['unit_price'] }}"
                                                                          model-name="{{ $product['name'] }}"
                                                                          model-url="storage/app/public/product/model/{{ $product['model'] }}"
                                                                          model-format="{{ pathinfo($product['model'], PATHINFO_EXTENSION) }}"
                                                                          model-axios="1"
                                                                          model-type="1">

                                                                          <img src="{{asset('storage/app/public/product/thumbnail')}}/{{ $product['thumbnail'] }}" alt="Add Item">
                                                                          <div>{{ $product['name'] }}  <span> {{ $product['unit_price'] }}SAR </span></div>

                                                                        </a>
                                                                      </div>
                                                                      @endif
                                                                    @endforeach
                                                                  </div>
                                                                </li>
                                                              @endforeach
                                                              </ul>
                                                          </div>
                                                        @else
                                                          @foreach($products as $product)
                                                            @if($product['sub_category_id'] == $sub_category['id'])
                                                              <div class="col-sm-4">
                                                                <a class="thumbnail add-item"
                                                                  data-dismiss="modal"
                                                                  product-id="{{ $product['id'] }}"
                                                                  model-price="{{ $product['unit_price'] }}"
                                                                  model-name="{{ $product['name'] }}"
                                                                  model-url="storage/app/public/product/model/{{ $product['model'] }}"
                                                                  model-format="{{ pathinfo($product['model'], PATHINFO_EXTENSION) }}"
                                                                  model-axios="1"
                                                                  model-type="1">

                                                                  <img src="{{asset('storage/app/public/product/thumbnail')}}/{{ $product['thumbnail'] }}" alt="Add Item">
                                                                  <div>{{ $product['name'] }}  <span> {{ $product['unit_price'] }}SAR </span></div>

                                                                </a>
                                                              </div>
                                                              @endif
                                                            @endforeach
                                                        @endif
                                                      </li>
                                                @endforeach
                                              </ul>
                                          </div>
                                      @else
                                        @foreach($products as $product)
                                          @if($product['category_id'] == $category['id'])
                                            <div class="col-sm-4">
                                              <a class="thumbnail add-item"
                                                data-dismiss="modal"
                                                product-id="{{ $product['id'] }}"
                                                model-price="{{ $product['unit_price'] }}"
                                                model-name="{{ $product['name'] }}"
                                                model-url="storage/app/public/product/model/{{ $product['model'] }}"
                                                model-format="{{ pathinfo($product['model'], PATHINFO_EXTENSION) }}"
                                                model-axios="1"
                                                model-type="1">

                                                <img src="{{asset('storage/app/public/product/thumbnail')}}/{{ $product['thumbnail'] }}" alt="Add Item">
                                                <div>{{ $product['name'] }}  <span> {{ $product['unit_price'] }}SAR </span></div>

                                              </a>
                                            </div>
                                            @endif
                                          @endforeach
                                      @endif
                                  </li>
                              @endforeach
                          </ul>
                      </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{\App\CPU\translate('Close')}}</button>
          </div>
        </div>
      </div>
    </div>

  </body>

  <script src="{{asset('public/assets/back-end/js/toastr.js')}}"></script>
  <script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
  </script>

  <script>
    window.user = {
      id : `{{ $data["user_id"] }}`,
    }

    window.roomId = `{{ $data["roomId"] }}`;
    window.serverdata = '{{ $data["data"] }}'
    window.productId = `{{$data['product_id']}}`;

    window.baseURL = `{{route('home')}}`
    window.loginURL = `{{route('customer.auth.login')}}`
    window.addToCartURL = `{{route('cart.add')}}`
    window.addToRoomCartURL = `{{route('cart.addRoom')}}`
    window.addToSaleURL = `{{route('add_room')}}`
    window.defaultRoomData = `{!! $data["defaultRoomData"] !!}`
    window.isRoomLock = `{{ $data["isRoomLock"] }}` == "0" ? false : true;

    window.assetsURL = `{{asset('public/roomDesign/rooms')}}`;

    window._token = '{{ csrf_token() }}';

    console.log(`{{\App\CPU\translate('Walls')}}`);

    window.lang = {
      'Current Corner': `{{\App\CPU\translate('Current Corner')}}`,
      'Elevation': `{{\App\CPU\translate('Elevation')}}`,
      'Current Room': `{{\App\CPU\translate('Current Room')}}`,
      'Current Wall 2D': `{{\App\CPU\translate('Current Wall 2D')}}`,
      'Wall Length': `{{\App\CPU\translate('Wall Length')}}`,
      'Wall Height': `{{\App\CPU\translate('Wall Height')}}`,
      'Materials': `{{\App\CPU\translate('Materials')}}`,
      'This room is not bought.': `{{\App\CPU\translate('This room is not bought.')}}`,
      'This is not product.': `{{\App\CPU\translate('This is not product.')}}`,
      'Current Corner': `{{\App\CPU\translate('Current Corner')}}`,
      'Name': `{{\App\CPU\translate('Name')}}`,
      'Wall Measurements': `{{\App\CPU\translate('Wall Measurements')}}`,
      'Interface & Configuration': `{{\App\CPU\translate('Interface & Configuration')}}`,
      'Units': `{{\App\CPU\translate('Units')}}`,
      'Current Item (3D)': `{{\App\CPU\translate('Current Item (3D)')}}`,
      'width': `{{\App\CPU\translate('width')}}`,
      'height': `{{\App\CPU\translate('height')}}`,
      'depth': `{{\App\CPU\translate('depth')}}`,
      'Maintain Size Ratio': `{{\App\CPU\translate('Maintain Size Ratio')}}`,
      'Locked in place': `{{\App\CPU\translate('Locked in place')}}`,
      'Delete Item': `{{\App\CPU\translate('Delete Item')}}`,
      'Add Cart Item': `{{\App\CPU\translate('Add Cart Item')}}`,
      'Selections': `{{\App\CPU\translate('Selections')}}`,
      'Please input room name.': `{{\App\CPU\translate('Please input room name.')}}`,
      'Please Login in site.': `{{\App\CPU\translate('Please Login in site.')}}`,
      'This room is not set for design.': `{{\App\CPU\translate('This room is not set for design.')}}`,
      'Update wall texture.': `{{\App\CPU\translate('Update wall texture.')}}`,
      'Update Floor texture.': `{{\App\CPU\translate('Update Floor texture.')}}`,
    }

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });

    jQuery(".search-bar-input").keyup(function () {
        let name = $(".search-bar-input").val();
        let searchUrl = '{{ url('/') }}/searched-room-products';

        if (name.length > 0) {
            $.ajax({
                url: searchUrl,
                method: 'GET',
                dataType: 'json',
                data: {
                    name: name
                },
                success: function (data) {
                  $('.search-result-box').empty().html(data.result);
                  $('.all-result-box').addClass('d-none');
                },
            });
        } else {
            $('.search-result-box').empty();
            $('.all-result-box').removeClass('d-none');
        }
    });
  </script>

  <script src="{{asset('public/roomDesign/js/items.js')}}"></script>
  <script src="{{asset('public/roomDesign/js/items_gltf.js')}}"></script>
  <script src="{{asset('public/roomDesign/js/app.js')}}"></script>

  <script>
    // Create the scene, camera, and renderer
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ canvas: document.getElementById('viewer-canvas') });
    const controls = new THREE.OrbitControls(camera, renderer.domElement);

    camera.position.set(0, 2, 5);
    controls.update();
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);

    // Function to load OBJ model
    function loadOBJModel(modelUrl) {
        const loader = new THREE.OBJLoader();
        loader.load(modelUrl, function(obj) {
            // Adjust scale based on original dimensions
            obj.scale.set(1, 1, 1); // Adjust scale as needed
            scene.add(obj);
            render();
        }, undefined, function(error) {
            console.error('An error occurred while loading the OBJ model:', error);
        });
    }

    // Function to load GLB model
 // Function to load GLB model
function loadGLBModel(modelUrl) {
    const loader = new THREE.GLTFLoader();
    loader.load(
        modelUrl,
        function(gltf) {
            const model = gltf.scene; // احصل على النموذج المحمل
            model.scale.set(1, 1, 1); // يمكنك ضبط الحجم هنا حسب الحاجة
            scene.add(model); // أضف النموذج إلى المشهد الرئيسي
            render(); // قم بتحديث العرض
        },
        function(xhr) {
            console.log((xhr.loaded / xhr.total * 100) + '% loaded'); // تتبع التقدم
        },
        function(error) {
            console.error('An error occurred while loading the GLB model:', error); // التعامل مع الأخطاء
            alert('حدث خطأ أثناء تحميل النموذج.');
        }
    );
}



    // Load the model based on its format
    function loadModel(modelUrl, modelFormat) {
        if (modelFormat === 'obj') {
            loadOBJModel(modelUrl);
        } else if (modelFormat === 'glb') {
            loadGLBModel(modelUrl);
        } else {
            console.error('Unsupported model format:', modelFormat);
        }
    }

    // Example function to add item
    $('.add-item').on('click', function() {
        const modelUrl = $(this).attr('model-url');
        const modelFormat = $(this).attr('model-format');

        loadModel(modelUrl, modelFormat);
    });

    // Render the scene
    function render() {
        requestAnimationFrame(render);
        controls.update();
        renderer.render(scene, camera);
    }

    render();
  </script>
</html>
