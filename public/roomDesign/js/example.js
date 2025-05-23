
/*
 * Camera Buttons
 */

var CameraButtons = function(blueprint3d) {

  var orbitControls = blueprint3d.three.controls;
  var three = blueprint3d.three;

  var panSpeed = 30;
  var directions = {
    UP: 1,
    DOWN: 2,
    LEFT: 3,
    RIGHT: 4
  }

  function init() {
    // Camera controls
    $("#zoom-in").click(zoomIn);
    $("#zoom-out").click(zoomOut);  
    $("#zoom-in").dblclick(preventDefault);
    $("#zoom-out").dblclick(preventDefault);

    $("#reset-view").click(three.centerCamera)

    $("#move-left").click(function(){
      pan(directions.LEFT)
    })
    $("#move-right").click(function(){
      pan(directions.RIGHT)
    })
    $("#move-up").click(function(){
      pan(directions.UP)
    })
    $("#move-down").click(function(){
      pan(directions.DOWN)
    })

    $("#move-left").dblclick(preventDefault);
    $("#move-right").dblclick(preventDefault);
    $("#move-up").dblclick(preventDefault);
    $("#move-down").dblclick(preventDefault);
  }

  function preventDefault(e) {
    e.preventDefault();
    e.stopPropagation();
  }

  function pan(direction) {
    switch (direction) {
      case directions.UP:
        orbitControls.panXY(0, panSpeed);
        break;
      case directions.DOWN:
        orbitControls.panXY(0, -panSpeed);
        break;
      case directions.LEFT:
        orbitControls.panXY(panSpeed, 0);
        break;
      case directions.RIGHT:
        orbitControls.panXY(-panSpeed, 0);
        break;
    }
  }

  function zoomIn(e) {
    e.preventDefault();
    orbitControls.dollyIn(1.1);
    orbitControls.update();
  }

  function zoomOut(e) {
    e.preventDefault;
    orbitControls.dollyOut(1.1);
    orbitControls.update();
  }

  init();
}

/*
 * Context menu for selected item
 */ 

var ContextMenu = function(blueprint3d, sideMenu, productManager) {

  var scope = this;
  var selectedItem;
  var three = blueprint3d.three;

  function init() {
    $("#context-menu-delete").click(function(event) {
        selectedItem.remove();
    });

    $("#context-menu-add-cart").click(function(event) {
      console.log(selectedItem)
      // if(isAxios == 1) {

      if(!!selectedItem.metadata.product_id) {
        let product_id = selectedItem.metadata.product_id;

        if(!productManager.products[product_id]) {
          productManager.products[product_id] = {
            quantity : 1,
          };
        } else {
          productManager.products[product_id]['quantity']++;
        }

        $.post(addToCartURL, {id : product_id, quantity: 1, _token: _token}, function(data) {

          if(data.status == 1) {
            toastr.success(data.message);

          } else {
            toastr.error(data.message);
          }

          // console.log(data, "add cart")
        })
      } else {
        toastr.error("This is not product.")
      }

    })

    three.itemSelectedCallbacks.add(itemSelected);
    three.itemUnselectedCallbacks.add(itemUnselected);

    initResize();

    $("#fixed").click(function() {
        var checked = $(this).prop('checked');
        selectedItem.setFixed(checked);
    });
  }

  function cmToIn(cm) {
    return cm / 2.54;
  }

  function inToCm(inches) {
    return inches * 2.54;
  }

  function itemSelected(item) {
    console.log(item)
    selectedItem = item;

    $("#context-menu-name").text(item.metadata.itemName);

    $("#item-width").val(cmToIn(selectedItem.getWidth()).toFixed(0));
    $("#item-height").val(cmToIn(selectedItem.getHeight()).toFixed(0));
    $("#item-depth").val(cmToIn(selectedItem.getDepth()).toFixed(0));

    $("#context-menu").show();

    $("#fixed").prop('checked', item.fixed);

    if(!!item.metadata.product_id) {
      $("context-menu-add-cart").show();
    } else {
      $("context-menu-add-cart").hide();
    }

  }

  function resize() {
    selectedItem.resize(
      inToCm($("#item-height").val()),
      inToCm($("#item-width").val()),
      inToCm($("#item-depth").val())
    );
  }

  function initResize() {
    $("#item-height").change(resize);
    $("#item-width").change(resize);
    $("#item-depth").change(resize);
  }

  function itemUnselected() {
    selectedItem = null;
    $("#context-menu").hide();
  }

  init();
}

/*
 * Loading modal for items
 */

var ModalEffects = function(blueprint3d) {

  var scope = this;
  var blueprint3d = blueprint3d;
  var itemsLoading = 0;

  this.setActiveItem = function(active) {
    itemSelected = active;
    update();
  }

  function update() {
    if (itemsLoading > 0) {
      $("#loading-modal").show();
    } else {
      $("#loading-modal").hide();
    }
  }

  function init() {
    blueprint3d.model.scene.itemLoadingCallbacks.add(function() {
      itemsLoading += 1;
      update();
    });

     blueprint3d.model.scene.itemLoadedCallbacks.add(function() {
      itemsLoading -= 1;
      update();
    });   

    update();
  }

  init();
}

/*
 * Side menu
 */

var SideMenu = function(blueprint3d, floorplanControls, modalEffects, productManager) {
  var blueprint3d = blueprint3d;
  var floorplanControls = floorplanControls;
  var modalEffects = modalEffects;
  var productManager = productManager;

  var isAddItem = 0;
  var ACTIVE_CLASS = "active";

  var tabs = {
    "FLOORPLAN" : $("#floorplan_tab"),
    "SHOP" : $("#items_tab"),
    "DESIGN" : $("#design_tab")
  }

  var scope = this;
  this.stateChangeCallbacks = $.Callbacks();

  this.states = {
    "DEFAULT" : {
      "div" : $("#viewer"),
      "tab" : tabs.DESIGN
    },
    "FLOORPLAN" : {
      "div" : $("#floorplanner"),
      "tab" : tabs.FLOORPLAN
    },
    "SHOP" : {
      "div" : $("#add-items"),
      "tab" : tabs.SHOP
    }
  }

  // sidebar state
  var currentState = scope.states.FLOORPLAN;

  function init() {
    for (var tab in tabs) {
      var elem = tabs[tab];
      elem.click(tabClicked(elem));
    }

    $("#viewType").click(changeViewType);
    $("#addItem").click(onClickAddItem);

    $("#update-floorplan").click(floorplanUpdate);

    initLeftMenu();

    blueprint3d.three.updateWindowSize();
    handleWindowResize();

    initItems();

    setCurrentState(scope.states.DEFAULT);
  }

  // Change view type mode
  function changeViewType() {

    let tab = currentState.tab;
    console.log(currentState.tab)
    if(currentState.tab == tabs.DESIGN) {
      tab = tabs.FLOORPLAN;
    } else {
      tab = tabs.DESIGN;
    }
    $("#viewType").html(`
      <span class="material-symbols-outlined">
        ${tab == tabs.FLOORPLAN? 'deployed_code' : 'dataset'}
      </span>
    `)

    blueprint3d.three.stopSpin();

    for (var key in scope.states) {
      var state = scope.states[key];
      if (state.tab == tab) {
        setCurrentState(state);
        break;
      }
    }
  }

  function onClickAddItem () {
    if(isAddItem == 0) {
      $("#add-items").show();
      isAddItem = 1;
    } else {
      $("#add-items").hide();
      isAddItem = 0;
    }
  }

  function floorplanUpdate() {
    setCurrentState(scope.states.DEFAULT);
  }

  function tabClicked(tab) {
    return function() {
      // Stop three from spinning
      blueprint3d.three.stopSpin();

      // Selected a new tab
      for (var key in scope.states) {
        var state = scope.states[key];
        if (state.tab == tab) {
          setCurrentState(state);
          break;
        }
      }
    }
  }
  
  function setCurrentState(newState) {

    if (currentState == newState) {
      return;
    }

    // show the right tab as active
    if (currentState.tab !== newState.tab) {
      if (currentState.tab != null) {
        currentState.tab.removeClass(ACTIVE_CLASS);          
      }
      if (newState.tab != null) {
        newState.tab.addClass(ACTIVE_CLASS);
      }
    }

    // set item unselected
    blueprint3d.three.getController().setSelectedObject(null);

    // show and hide the right divs
    currentState.div.hide()
    newState.div.show()

    // custom actions
    if (newState == scope.states.FLOORPLAN) {
      floorplanControls.updateFloorplanView();
      floorplanControls.handleWindowResize();
    } 

    if (currentState == scope.states.FLOORPLAN) {
      blueprint3d.model.floorplan.update();
    }

    if (newState == scope.states.DEFAULT) {
      blueprint3d.three.updateWindowSize();
    }
 
    // set new state
    handleWindowResize();    
    currentState = newState;

    scope.stateChangeCallbacks.fire(newState);
  }

  function initLeftMenu() {
    $( window ).resize( handleWindowResize );
    handleWindowResize();
  }

  function handleWindowResize() {
    $(".sidebar").height(window.innerHeight);
    $("#add-items").height(window.innerHeight);

  };

  // TODO: this doesn't really belong here
  function initItems() {
    $("#add-items").find(".add-item").mousedown(function(e) {
      var modelUrl = $(this).attr("model-url");
      var itemType = parseInt($(this).attr("model-type"));
      var isAxios = parseInt($(this).attr("model-axios"));
      var product_id = parseInt($(this).attr("product-id"));
      var price = parseInt($(this).attr("model-price"));
      var itemFormat = $(this).attr('model-format');

      if(isAxios == 1) {

        if(!productManager.products[product_id]) {
          productManager.products[product_id] = {
            quantity : 1,
          };
        } else {
          productManager.products[product_id]['quantity']++;
        }

        // $.post(addToCartURL, {id : product_id, quantity: productManager.products[product_id]['quantity'], _token: _token}, function(data) {

        //   if(data.status == 1) {
        //     toastr.success(data.message);

        //   } else {
        //     toastr.error(data.message);
        //   }

        //   // console.log(data, "add cart")
        // })
      }

      var metadata = {
        itemName: $(this).attr("model-name"),
        resizable: true,
        modelUrl: modelUrl,
        itemType: itemType,
        product_id: product_id,
        format: itemFormat,
      }

      blueprint3d.model.scene.addItem(itemType, modelUrl, metadata);
      setCurrentState(scope.states.DEFAULT);
      onClickAddItem();
    });

    $(".left-container").find(".addStaticItem").click(function(e) {

      console.log("click-door", $(this).attr("model-url"))

      var modelUrl = $(this).attr("model-url");
      var itemType = parseInt($(this).attr("model-type"));
      var product_id = parseInt($(this).attr("product-id"));

      var metadata = {
        itemName: $(this).attr("model-name"),
        resizable: true,
        modelUrl: modelUrl,
        itemType: itemType,
        product_id: product_id
      }

      blueprint3d.model.scene.addItem(itemType, modelUrl, metadata);
      setCurrentState(scope.states.DEFAULT);
      // onClickAddItem();
    })
  }

  init();

}

/*
 * Change floor and wall textures
 */

var TextureSelector = function (blueprint3d, sideMenu) {

  var scope = this;
  var three = blueprint3d.three;
  var isAdmin = isAdmin;

  var currentTarget = null;

  function initTextureSelectors() {
    $(".texture-select-thumbnail").click(function(e) {
      var textureUrl = $(this).attr("texture-url");
      var textureStretch = ($(this).attr("texture-stretch") == "true");
      var textureScale = parseInt($(this).attr("texture-scale"));
      currentTarget.setTexture(textureUrl, textureStretch, textureScale);

      e.preventDefault();
    });
  }

  function init() {
    three.wallClicked.add(wallClicked);
    three.floorClicked.add(floorClicked);
    three.itemSelectedCallbacks.add(reset);
    three.nothingClicked.add(reset);
    sideMenu.stateChangeCallbacks.add(reset);
    initTextureSelectors();
  }

  function wallClicked(halfEdge) {
    currentTarget = halfEdge;
    $("#floorTexturesDiv").hide();  
    $("#wallTextures").show();  
  }

  function floorClicked(room) {
    currentTarget = room;
    $("#wallTextures").hide();  
    $("#floorTexturesDiv").show();  
  }

  function reset() {
    $("#wallTextures").hide();  
    $("#floorTexturesDiv").hide();  
  }

  init();
}

/*
 * Floorplanner controls
 */

var ViewerFloorplanner = function(blueprint3d) {

  var canvasWrapper = '#floorplanner';

  // buttons
  var move = '#move';
  var remove = '#delete';
  var draw = '#draw';

  var activeStlye = 'btn-primary disabled';

  this.floorplanner = blueprint3d.floorplanner;

  var scope = this;

  function init() {

    $( window ).resize( scope.handleWindowResize );
    scope.handleWindowResize();

    // mode buttons
    scope.floorplanner.modeResetCallbacks.add(function(mode) {
      $(draw).removeClass(activeStlye);
      $(remove).removeClass(activeStlye);
      $(move).removeClass(activeStlye);
      if (mode == BP3D.Floorplanner.floorplannerModes.MOVE) {
          $(move).addClass(activeStlye);
      } else if (mode == BP3D.Floorplanner.floorplannerModes.DRAW) {
          $(draw).addClass(activeStlye);
      } else if (mode == BP3D.Floorplanner.floorplannerModes.DELETE) {
          $(remove).addClass(activeStlye);
      }

      if (mode == BP3D.Floorplanner.floorplannerModes.DRAW) {
        $("#draw-walls-hint").show();
        scope.handleWindowResize();
      } else {
        $("#draw-walls-hint").hide();
      }
    });

    $(move).click(function(){
      scope.floorplanner.setMode(BP3D.Floorplanner.floorplannerModes.MOVE);
    });

    $(draw).click(function(){
      scope.floorplanner.setMode(BP3D.Floorplanner.floorplannerModes.DRAW);
    });

    $(remove).click(function(){
      scope.floorplanner.setMode(BP3D.Floorplanner.floorplannerModes.DELETE);
    });
  }

  this.updateFloorplanView = function() {
    scope.floorplanner.reset();
  }

  this.handleWindowResize = function() {
    $(canvasWrapper).height(window.innerHeight - $(canvasWrapper).offset().top);
    scope.floorplanner.resizeView();
  };

  init();
}; 

var mainControls = function(blueprint3d, productManager) {
  var blueprint3d = blueprint3d;

  var roomId = null;

  function newDesign() {
    blueprint3d.model.loadSerialized('{"floorplan":{"corners":{"f90da5e3-9e0e-eba7-173d-eb0b071e838e":{"x":204.85099999999989,"y":289.052},"da026c08-d76a-a944-8e7b-096b752da9ed":{"x":672.2109999999999,"y":289.052},"4e3d65cb-54c0-0681-28bf-bddcc7bdb571":{"x":672.2109999999999,"y":-178.308},"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2":{"x":204.85099999999989,"y":-178.308}},"walls":[{"corner1":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","corner2":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","frontTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0}},{"corner1":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","corner2":"da026c08-d76a-a944-8e7b-096b752da9ed","frontTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0}},{"corner1":"da026c08-d76a-a944-8e7b-096b752da9ed","corner2":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","frontTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0}},{"corner1":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","corner2":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","frontTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0}}],"wallTextures":[],"floorTextures":{},"newFloorTextures":{}},"items":[]}');
  }

  function loadDesign() {
    files = $("#loadFile").get(0).files;
    var reader  = new FileReader();
    reader.onload = function(event) {
        var data = event.target.result;
        blueprint3d.model.loadSerialized(data);
    }
    reader.readAsText(files[0]);
  }

  function saveDesign() {
    var data = blueprint3d.model.exportSerialized();
    var a = window.document.createElement('a');
    var blob = new Blob([data], {type : 'text'});
    a.href = window.URL.createObjectURL(blob);
    a.download = 'design.blueprint3d';
    document.body.appendChild(a)
    a.click();
    document.body.removeChild(a)
  }

  function saveSaleDesignSave() {
    var image = blueprint3d.three.dataUrl();
    $("#add-design-room").show();
    $("#roomPreviewer").attr('src', image);
  }

  function onDesignCancel() {
    $("#add-design-room").hide();
  }

  function onDesignScreenShotBtn() {
    var image = blueprint3d.three.dataUrl();
    $("#roomPreviewer").attr('src', image);
  }

  function onDesignSaveBtn() {

    let name = $("#roomName").val();
    if(name == "") {
      toastr.error("Please input room name.");
      return;
    }

    if(user.id == '') {
      toastr.error("Please Login in site.");
    }

    var data = blueprint3d.model.exportSerialized();
    var image = getRealImageData();
    // var price = productManager.getPrice();

    $.post(addToSaleURL, {data : data, image: image, name: name, _token: _token}, function(data) {

      if(data.status == 1) {
        toastr.success(data.message);

        roomId = data.id;
      } else {
        toastr.error(data.message);
      }

      // console.log(data, "add cart")
    })
  }

  function getRealImageData() {
    // Get the image div element
    var imageDiv = document.getElementById("roomPreviewer");

    // Create a canvas element
    var canvas = document.createElement("canvas");
    var context = canvas.getContext("2d");

    const imgW = imageDiv.offsetWidth;
    const imgH = imageDiv.offsetHeight;
    // Set the canvas dimensions to match the image div
    canvas.width = imageDiv.offsetWidth;
    canvas.height = imageDiv.offsetHeight;

    // Draw the image div onto the canvas
    context.drawImage(imageDiv, 0, 0, canvas.width, canvas.height);

    // Get the data URL of the canvas
    var dataURL = canvas.toDataURL("image/png");

    // Use the data URL as needed
    console.log(dataURL);
    return dataURL;
  }

  var isLockItems = false;
  function onLockItemsBtn() {
    isLockItems = !isLockItems;
    blueprint3d.model.scene.getItems().forEach(item => {
      item.setFixed(isLockItems);
    })

    $("#lockItems").html(`
      <span class="material-symbols-outlined">
        ${isLockItems? 'lock' : 'lock_open'}
      </span>
    `);
  }

  function onAddRoomItem() {
    console.log("room add url - ", window.addToRoomCartURL, window.roomId);
    $.post(addToRoomCartURL, {id : window.roomId, quantity: 1, _token: _token}, function(data) {

      if(data.status == 1) {
        toastr.success(data.message);

      } else {
        toastr.error(data.message);
      }

      // console.log(data, "add cart")
    })
  }

  function onAddCeilBtn() {
    console.log(blueprint3d)
  }

  function init() {
    $("#new").click(newDesign);
    $("#loadFile").change(loadDesign);
    $("#saveFile").click(saveDesign);
    $("#designBtn").click(saveSaleDesignSave);

    $("#lockItems").click(onLockItemsBtn);

    $("#designSaveBtn").click(onDesignSaveBtn);
    $("#designScreenShotBtn").click(onDesignScreenShotBtn);
    $("#designCancel").click(onDesignCancel);

    $("#addRoomItem").click(onAddRoomItem);

    $("#addCeilBtn").click(onAddCeilBtn);
  }

  init();
}

/**
 * Products Data
 */
var ProductManager = function() {
  var scope = this;
  this.products = {
    /**
     * id : {
     *  quantity : 10,
     *  price : 2333
     * }
    */
  }
  function init() {
    scope.products = {};
  }

  this.getPrice = () => {
    let price = 0;
    Object.keys(scope.products).forEach(key => {
      const product = scope.products[key];
      price += product.quantity * product.price;
    })

    return price;
  }

  init();
}

/*
 * Initialize!
 */

$(document).ready(function() {
  console.log(user)
  // main setup
  var opts = {
    floorplannerElement: 'floorplanner-canvas',
    threeElement: '#viewer',
    threeCanvasElement: 'three-canvas',
    textureDir: "models/textures/",
    widget: false
  }
  window.blueprint3d = new BP3D.Blueprint3d(opts);
  var productManager = new ProductManager();

  var modalEffects = new ModalEffects(blueprint3d);
  var viewerFloorplanner = new ViewerFloorplanner(blueprint3d);
  var sideMenu = new SideMenu(blueprint3d, viewerFloorplanner, modalEffects, productManager);
  var contextMenu = new ContextMenu(blueprint3d, sideMenu, productManager);
  var textureSelector = new TextureSelector(blueprint3d, sideMenu);        
  var cameraButtons = new CameraButtons(blueprint3d);
  mainControls(blueprint3d, productManager);




  // This serialization format needs work
  // Load a simple rectangle room
  // blueprint3d.model.loadSerialized('{"floorplan":{"corners":{"f90da5e3-9e0e-eba7-173d-eb0b071e838e":{"x":204.85099999999989,"y":289.052},"da026c08-d76a-a944-8e7b-096b752da9ed":{"x":672.2109999999999,"y":289.052},"4e3d65cb-54c0-0681-28bf-bddcc7bdb571":{"x":672.2109999999999,"y":-178.308},"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2":{"x":204.85099999999989,"y":-178.308}},"walls":[{"corner1":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","corner2":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","frontTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0}},{"corner1":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","corner2":"da026c08-d76a-a944-8e7b-096b752da9ed","frontTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0}},{"corner1":"da026c08-d76a-a944-8e7b-096b752da9ed","corner2":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","frontTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0}},{"corner1":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","corner2":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","frontTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/marbletiles.jpg","stretch":true,"scale":0}}],"wallTextures":[],"floorTextures":{},"newFloorTextures":{}},"items":[]}');
  blueprint3d.model.loadSerialized(window.defaultRoomData);

  if(isRoomLock) {
    setTimeout(() => {
      blueprint3d.model.scene.getItems().forEach(item => {
        item.setFixed(true);
      })
    }, 3000)
  }


});
