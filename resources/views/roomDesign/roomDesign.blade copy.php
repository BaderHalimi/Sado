<!DOCTYPE html>
<html>
  <head>
    <title>Architect 3D - Example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('roomdesign/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('roomdesign/css/example.css')}}" rel="stylesheet">
    <link href="{{asset('roomdesign/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/assets/back-end')}}/css/toastr.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  </head>

  <body>

    <div class="container-fluid">


      <div class="row main-row">

        <!-- Right Column -->
        <div class="col-xs-12 main">
          {{-- Left Menu --}}
          <div class="left-container" >
            <div class="left-toolbar">

              <!-- <div class="left-toolbar-button" id="addRoomItem" data-bs-toggle="tooltip" data-bs-placement="right" title="Add Room">
                <img src="{{asset('roomdesign/rooms/room.svg')}}" />
              </div>

              <div class="left-toolbar-button" id="addRoomItem" data-bs-toggle="tooltip" data-bs-placement="right" title="Add Room 1">
                <img src="{{asset('roomdesign/rooms/room-1.svg')}}" />
              </div> -->
              <div class="left-toolbar-button addStaticItem" id="addStaticItem"
                  model-name="windows" 
                  model-url="models/js/whitewindow.js"
                  model-type="3"
                  data-bs-toggle="tooltip" data-bs-placement="right" title="Add windows">
                <img src="{{asset('roomdesign/rooms/window.svg')}}" />
              </div>
              <div class="left-toolbar-button addStaticItem" id="addStaticItem" 
                model-name="door" 
                model-url="models/js/closed-door28x80_baked.js"
                model-type="7"
                data-bs-toggle="tooltip" data-bs-placement="right" title="Add door">
                <img src="{{asset('roomdesign/rooms/door.svg')}}" />
              </div>
              <div class="left-toolbar-button addStaticItem" id="addStaticItem" 
                model-name="open door" 
                model-url="models/js/open_door.js"
                model-type="7"
                data-bs-toggle="tooltip" data-bs-placement="right" title="Add open door">
                <img src="{{asset('roomdesign/rooms/open-door.svg')}}" />
              </div>

              <!-- <div class="left-toolbar-button" id="addCeilBtn" 
                data-bs-toggle="tooltip" data-bs-placement="right" title="Add ceil">
                <img src="{{asset('roomdesign/rooms/ceil.svg')}}" />
                <img src="{{asset('roomdesign/rooms/no-ceil.svg')}}" />
              </div> -->


              <div class="hr"></div>

              <a class="left-toolbar-button" data-bs-toggle="tooltip" data-bs-placement="right" title="Go Home" href="{{route('room-list')}} ">
                <span class="material-symbols-outlined">
                  home
                </span>
              </a>

              <div class="left-toolbar-button {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="viewType" data-bs-toggle="tooltip" data-bs-placement="right" title="3D View">
                <span class="material-symbols-outlined">
                  dataset
                </span>
              </div>


              <div class="left-toolbar-button {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="lockItems" data-bs-toggle="tooltip" data-bs-placement="right" title="Lock">
                <span class="material-symbols-outlined">
                  lock_open
                </span>
              </div>

              <!-- <div class="left-toolbar-button" data-bs-toggle="tooltip" data-bs-placement="right" title="Ruler">
                <span class="material-symbols-outlined">
                  straighten
                </span>
              </div>  -->
              
              <!-- <div class="left-toolbar-button" data-bs-toggle="tooltip" data-bs-placement="right" title="X-ray">
                <span class="material-symbols-outlined">
                  crop_square
                </span>
              </div>   -->
              
              <div class="left-toolbar-button {{$data['isRoomLock'] == 0? 'item-hidden' : ''}}" id="addRoomItem" data-bs-toggle="tooltip" data-bs-placement="right" title="Add Room item">
                <span class="material-symbols-outlined">
                  shopping_cart
                </span>
              </div>

              <div class="left-toolbar-button {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="addItem" data-bs-toggle="tooltip" data-bs-placement="right" title="Add item">
                <span class="material-symbols-outlined">
                  shopping_cart
                </span>
              </div>
              

              <div class="hr"></div>


              <div class="left-toolbar-button {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="new" data-bs-toggle="tooltip" data-bs-placement="right" title="New Room">
                <span class="material-symbols-outlined">
                  note_add
                </span>
              </div> 
              <div class="left-toolbar-button {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="saveFile" data-bs-toggle="tooltip" data-bs-placement="right" title="Save Room">
                <span class="material-symbols-outlined">
                  save
                </span>
              </div> 

              <!-- <div class="left-toolbar-button" id="loadBtn" data-bs-toggle="tooltip" data-bs-placement="right" title="Load Room" for="loadFile">
                <input type="file" class="hidden-input" id="loadFile" hidden>
                <span class="material-symbols-outlined">
                  deployed_code_update
                </span>
              </div>  -->


              <div class="left-toolbar-button {{$data['isRoomLock'] == 0? '' : 'item-hidden'}}" id="designBtn" data-bs-toggle="tooltip" data-bs-placement="right" title="Design Room for sale">
                <span class="material-symbols-outlined">
                  screenshot_monitor
                </span>
              </div> 

              <div class="left-toolbar-button" data-bs-toggle="tooltip" data-bs-placement="right" title="">
                <span>
                  In
                </span>
              </div> 

            </div>
          </div>

          <!-- Save Design Room Part -->
          <div id="add-design-room">
            <div class="mb-3">
              <label for="roomName" class="form-label">Room Name</label>
              <input type="text" class="form-control" id="roomName" placeholder="Please Input Room Name">
            </div>

            <div class="mb-3 text-center">
              <img id="roomPreviewer" src="..." class="rounded mx-auto d-block" alt="room design">
            </div>
            <div class="mb-3 text-center mt-2">
              <button id="designSaveBtn" class="btn btn-success">Save</button>
              <button id="designScreenShotBtn" class="btn btn-info">ScreenShot</button>
              <button id="designCancel" class="btn btn-danger">Cancel</button>
            </div>
          </div>

          <!-- Add Items -->
          <div id="add-items">
            <div class="row" id="items-wrapper">
              @foreach($products as $product)
                <div class="col-sm-4">
                  <a class="thumbnail add-item"
                    product-id="{{ $product['id'] }}"
                    model-price="{{ $product['unit_price'] }}"
                    model-name="{{ $product['name'] }}" 
                    model-url="models/js/{{ $product['model'] }}"
                    model-axios="1"
                    model-type="1">

                    <img src="{{asset('storage/app/public/product/thumbnail')}}/{{ $product['thumbnail'] }}" alt="Add Item">
                    <div>{{ $product['name'] }}  <span> {{ $product['unit_price'] }}SAR </span></div>
                    
                  </a>
                </div>
              @endforeach
              <!-- Items added here by items.js -->
            </div>
          </div>

          <!-- 3D Viewer -->
          <div id="viewer">

            {{-- <div id="main-controls">
              <a href="#" class="btn btn-default btn-sm" id="new">
                New Plan
              </a>
              <a href="#" class="btn btn-default btn-sm" id="saveFile">
                Save Plan
              </a>
              <a class="btn btn-sm btn-default btn-file">
               <input type="file" class="hidden-input" id="loadFile">
               Load Plan
              </a>
            </div> --}}

            <div id="camera-controls">
              <a href="#" class="btn btn-default bottom" id="zoom-out">
                <span class="glyphicon glyphicon-zoom-out"></span>
              </a>
              <a href="#" class="btn btn-default bottom" id="reset-view">
                <span class="glyphicon glyphicon glyphicon-home"></span>
              </a>
              <a href="#" class="btn btn-default bottom" id="zoom-in">
                <span class="glyphicon glyphicon-zoom-in"></span>
              </a>
              
              <span>&nbsp;</span>

              <a class="btn btn-default bottom" href="#" id="move-left" >
                <span class="glyphicon glyphicon-arrow-left"></span>
              </a>
              <span class="btn-group-vertical">
                <a class="btn btn-default" href="#" id="move-up">
                  <span class="glyphicon glyphicon-arrow-up"></span>
                </a>
                <a class="btn btn-default" href="#" id="move-down">
                  <span class="glyphicon glyphicon-arrow-down"></span>
                </a>
              </span>
              <a class="btn btn-default bottom" href="#" id="move-right" >
                <span class="glyphicon glyphicon-arrow-right"></span>
              </a>
            </div>

            <div id="loading-modal">
              <h1>Loading...</h1>  
            </div>
          </div>

          <!-- 2D Floorplanner -->
          <div id="floorplanner">
            <canvas id="floorplanner-canvas"></canvas>
            <div id="floorplanner-controls" class="{{$data['isRoomLock'] == 0? '' : 'item-hidden'}}">

              <button id="move" class="btn btn-sm btn-default">
                <span class="glyphicon glyphicon-move"></span>
                Move Walls
              </button>
              <button id="draw" class="btn btn-sm btn-default">
                <span class="glyphicon glyphicon-pencil"></span>
                Draw Walls
              </button>
              <button id="delete" class="btn btn-sm btn-default">
                <span class="glyphicon glyphicon-remove"></span>
                Delete Walls
              </button>
              <span class="pull-right">
                <button class="btn btn-primary btn-sm" id="update-floorplan">Done &raquo;</button>
              </span>

            </div>
            <div id="draw-walls-hint">
              Press the "Esc" key to stop drawing walls
            </div>
          </div>

          <!-- Add Items -->

      
        </div>
        <!-- End Right Column -->


        <!-- Left Column -->
        <div class="sidebar" style="z-index: 1000; position: absolute; right: 0px; {{$data['isRoomLock'] == 0? '' : 'display:none;'}}">
          <!-- Main Navigation -->
          <hr />

          <!-- Context Menu -->
          <div id="context-menu">
            <div style="margin: 0 20px">
              <span id="context-menu-name" class="lead"></span>
              <br /><br />
              <button class="btn btn-block btn-danger" id="context-menu-delete">
                <span class="glyphicon glyphicon-trash"></span> 
                Delete Item
              </button>

              <button class="btn btn-block btn-success" id="context-menu-add-cart">
                <span class="glyphicon glyphicon-add"></span> 
                Add Cart
              </button>
            <br />
            <div class="panel panel-default">
              <div class="panel-heading">Adjust Size</div>
              <div class="panel-body" style="color: #333333">

                <div class="form form-horizontal" class="lead">
                  <div class="form-group">
                    <label class="col-sm-5 control-label">
                       Width
                    </label>
                    <div class="col-sm-6">
                      <input type="number" class="form-control" id="item-width">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-5 control-label">
                      Depth 
                    </label>
                    <div class="col-sm-6">
                      <input type="number" class="form-control" id="item-depth">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-5 control-label">
                      Height
                    </label>
                    <div class="col-sm-6">
                      <input type="number" class="form-control" id="item-height">
                    </div>
                  </div>
                </div>
                <small><span class="text-muted">Measurements in inches.</span></small>
              </div>
            </div>

            <label><input type="checkbox" id="fixed" /> Lock in place</label>
            <br /><br />
            </div>
          </div>

          <!-- Floor textures -->
          <div id="floorTexturesDiv" style="display:none; padding: 0 20px">
            <div class="panel panel-default">
              <div class="panel-heading">Adjust Floor</div>
              <div class="panel-body" style="color: #333333">

                <div class="col-sm-6" style="padding: 3px">
                  <a href="#" class="thumbnail texture-select-thumbnail" texture-url="rooms/textures/light_fine_wood.jpg" texture-stretch="false" texture-scale="300">
                    <img alt="Thumbnail light fine wood" src="rooms/thumbnails/thumbnail_light_fine_wood.jpg" />
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Wall Textures -->
          <div id="wallTextures" style="display:none; padding: 0 20px">
            <div class="panel panel-default">
              <div class="panel-heading">Wall Material</div>
              <div class="panel-body" style="color: #333333">
                <div class="col-sm-3" style="padding: 3px">
                  <a href="#" class="thumbnail texture-select-thumbnail" texture-url="rooms/textures/marbletiles.jpg" texture-stretch="false" texture-scale="300">
                    <img alt="Thumbnail marbletiles" src="rooms/thumbnails/thumbnail_marbletiles.jpg" />
                  </a>
                </div>
                <div class="col-sm-3" style="padding: 3px">
                  <a href="#" class="thumbnail texture-select-thumbnail" texture-url="rooms/textures/wallmap_yellow.png" texture-stretch="true" texture-scale="">
                    <img alt="Thumbnail wallmap yellow" src="rooms/thumbnails/thumbnail_wallmap_yellow.png" />
                  </a>
                </div>
                <div class="col-sm-3" style="padding: 3px">
                  <a href="#" class="thumbnail texture-select-thumbnail" texture-url="rooms/textures/light_brick.jpg" texture-stretch="false" texture-scale="100">
                    <img alt="Thumbnail light brick" src="rooms/thumbnails/thumbnail_light_brick.jpg" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>


  </body>


  <script src="{{asset('roomdesign/js/jquery.js')}}"></script>
  <script src="{{asset('roomdesign/js/bootstrap.js')}}"></script>
  
  <script src="{{asset('roomdesign/js/three.min.js')}}"></script>
  <script src="{{asset('roomdesign/js/bp3djs.js')}}"></script>
  <script src="{{asset('roomdesign/js/blueprint3d.js')}}"></script>


  <script src="{{asset('public/assets/back-end/js/toastr.js')}}"></script>
  <script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
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

    window.baseURL = `{{route('home')}}`
    window.addToCartURL = `{{route('cart.add')}}`
    window.addToRoomCartURL = `{{route('cart.addRoom')}}`
    window.addToSaleURL = `{{route('add_room')}}`
    window.defaultRoomData = `{!! $data["defaultRoomData"] !!}`
    window.isRoomLock = `{{ $data["isRoomLock"] }}` == "0" ? false : true;

    window._token = '{{ csrf_token() }}';

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });

  </script>


  <script src="{{asset('roomdesign/js/items.js')}}"></script>
  <script src="{{asset('roomdesign/js/example.js')}}"></script>
  
</html>