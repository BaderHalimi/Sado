var blueprint3d = null;
var floorPlanPart = null;
var aGlobal = null;
var anItem = null;
var aWall = null;
var aFloor = null;
var aCameraRange = null;
var gui = null;
var globalPropFolder = null;
var itemPropFolder = null;
var materialPropFolder = null;
var wallPropFolder = null;
var floorPropFolder = null;
var cameraPropFolder = null;
var selectionsFolder = null;

var myhome = '{"floorplan":{"corners":{"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2":{"x":0,"y":0,"elevation":2.5},"f90da5e3-9e0e-eba7-173d-eb0b071e838e":{"x":0,"y":5,"elevation":2.5},"da026c08-d76a-a944-8e7b-096b752da9ed":{"x":5,"y":5,"elevation":2.5},"4e3d65cb-54c0-0681-28bf-bddcc7bdb571":{"x":5,"y":0,"elevation":2.5}},"walls":[{"corner1":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","corner2":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","frontTexture":{"url":"public/roomDesign/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"public/roomDesign/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","corner2":"da026c08-d76a-a944-8e7b-096b752da9ed","frontTexture":{"url":"public/roomDesign/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"public/roomDesign/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"da026c08-d76a-a944-8e7b-096b752da9ed","corner2":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","frontTexture":{"url":"public/roomDesign/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"public/roomDesign/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","corner2":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","frontTexture":{"url":"public/roomDesign/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"public/roomDesign/rooms/textures/wallmap.png","stretch":true,"scale":0}}],"rooms":{"f90da5e3-9e0e-eba7-173d-eb0b071e838e,71d4f128-ae80-3d58-9bd2-711c6ce6cdf2,4e3d65cb-54c0-0681-28bf-bddcc7bdb571,da026c08-d76a-a944-8e7b-096b752da9ed":{"name":"A New Room"}},"wallTextures":[],"floorTextures":{},"newFloorTextures":{},"carbonSheet":{"url":"","transparency":1,"x":0,"y":0,"anchorX":0,"anchorY":0,"width":0.01,"height":0.01}},"items":[]}';

var room1 = [
	{
		x : 0, y : 0
	},
	{
		x : 0, y : 500
	},
	{
		x : 500, y : 500
	},
	{
		x : 500, y : 0
	},
]

var room2 = [
	{
		x : 0, y : 0
	},
	{
		x : 0, y : 500
	},
	{
		x : 500, y : 500
	},
	{
		x : 500, y : 250
	},
	{
		x : 250, y : 250
	},
	{
		x : 250, y : 0
	},
]

var myhome1 = "";

var wall_textures = [
	['public/roomDesign/rooms/textures/wallmap.png', true, 1], 
	['public/roomDesign/rooms/textures/wallmap_yellow.png', true, 1],
	['public/roomDesign/rooms/textures/light_brick.jpg', false, 50], 
	['public/roomDesign/rooms/textures/marbletiles.jpg', false, 300],
	['public/roomDesign/rooms/textures/light_fine_wood.jpg', false, 300],
	['public/roomDesign/rooms/textures/hardwood.png', false, 300],
	['public/roomDesign/rooms/textures/wall-1.png', true, 1],
	['public/roomDesign/rooms/textures/wall-2.png', false, 100],
	['public/roomDesign/rooms/textures/wall-3.png', false, 100],
	['public/roomDesign/rooms/textures/wall-4.png', false, 500],
	['public/roomDesign/rooms/textures/wall-5.png', false, 300],
]

var floor_textures = [

]

/*
 * Floorplanner controls
 */

var ViewerFloorplanner = function(blueprint3d)
{
  var canvasWrapper = '#floorplanner';
  // buttons
  var move = '#move';
  var remove = '#delete';
  var draw = '#draw';

  var activeStlye = 'btn-primary disabled';
  this.floorplanner = blueprint3d.floorplanner;
  var scope = this;
  function init()
  {
    $( window ).resize( scope.handleWindowResize );
    scope.handleWindowResize();

    scope.floorplanner.addEventListener(BP3DJS.EVENT_MODE_RESET, function(mode)
    {
      $(draw).removeClass(activeStlye);
      $(remove).removeClass(activeStlye);
      $(move).removeClass(activeStlye);
      if (mode == BP3DJS.floorplannerModes.MOVE)
      {
          $(move).addClass(activeStlye);
      }
      else if (mode == BP3DJS.floorplannerModes.DRAW)
      {
          $(draw).addClass(activeStlye);
      }
      else if (mode == BP3DJS.floorplannerModes.DELETE)
      {
          $(remove).addClass(activeStlye);
      }

      if (mode == BP3DJS.floorplannerModes.DRAW)
      {
        $("#draw-walls-hint").show();
        scope.handleWindowResize();
      }
      else
      {
        $("#draw-walls-hint").hide();
      }
    });

    $(move).click(function()
    {
      scope.floorplanner.setMode(BP3DJS.floorplannerModes.MOVE);
    });

    $(draw).click(function()
    {
      scope.floorplanner.setMode(BP3DJS.floorplannerModes.DRAW);
    });

    $(remove).click(function()
    {
      scope.floorplanner.setMode(BP3DJS.floorplannerModes.DELETE);
    });

	$("#zoomIn2d").click(function() 
	{
		// scope.floorplanner.setMode(BP3DJS.floorplannerModes.MOVE);
		Configuration.setValue('scale', Configuration.getNumericValue('scale') * 1.1);
		scope.floorplanner.zoom();
		scope.updateFloorplanView();
	})

	$("#zoomOut2d").click(function() 
	{
		// scope.floorplanner.setMode(BP3DJS.floorplannerModes.MOVE);
		Configuration.setValue('scale', Configuration.getNumericValue('scale') / 1.1);
		scope.floorplanner.zoom();
		scope.updateFloorplanView();
	})
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

var mainControls = function(blueprint3d)
{
	  var blueprint3d = blueprint3d;

	  function newDesign()
	  {
	    blueprint3d.model.loadSerialized(myhome);
	  }

	  function loadDesign()
	  {
	    files = $("#loadFile").get(0).files;
      if(files.length == 0)
      {
          files = $("#loadFile2d").get(0).files;
      }
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

	  function saveGLTF()
	  {
		  blueprint3d.three.exportForBlender();
	  }

	  function saveGLTFCallback(o)
	  {
		var data = o.gltf;
		var a = window.document.createElement('a');
		var blob = new Blob([data], {type : 'text'});
		a.href = window.URL.createObjectURL(blob);
		a.download = 'design.gltf';
		document.body.appendChild(a);
		a.click();
		document.body.removeChild(a);
	  }

	  function saveMesh() {
		    var data = blueprint3d.model.exportMeshAsObj();
		    var a = window.document.createElement('a');
		    var blob = new Blob([data], {type : 'text'});
		    a.href = window.URL.createObjectURL(blob);
		    a.download = 'design.obj';
		    document.body.appendChild(a)
		    a.click();
		    document.body.removeChild(a)
		  }

	  function init() {
	    $("#new").click(newDesign);
	    $("#new2d").click(newDesign);
	    $("#loadFile").change(loadDesign);
	    $("#saveFile").click(saveDesign);

      $("#loadFile2d").change(loadDesign);
	    $("#saveFile2d").click(saveDesign);

	    $("#saveMesh").click(saveMesh);
	    $("#saveGLTF").click(saveGLTF);
	    blueprint3d.three.addEventListener(BP3DJS.EVENT_GLTF_READY, saveGLTFCallback);
	  }

	  init();
}

var GlobalProperties = function()
{
	this.name = 'Global';
	//a - feet and inches, b = inches, c - cms, d - millimeters, e - meters
	this.units = {a:false, b:false, c:false, d:false, e:true};
	this.unitslabel = {a:BP3DJS.dimFeetAndInch, b:BP3DJS.dimInch, c:BP3DJS.dimCentiMeter, d:BP3DJS.dimMilliMeter, e:BP3DJS.dimMeter};
	this.guiControllers = null;

	this.setUnit = function(unit)
	{
		for (let param in this.units)
		{
			this.units[param] = false;
		}
		this.units[unit] = true;

		BP3DJS.Configuration.setValue(BP3DJS.configDimUnit, this.unitslabel[unit]);

		console.log(this.units, this.unitslabel[unit], BP3DJS.Configuration.getStringValue(BP3DJS.configDimUnit));
		
//		globalPropFolder = getGlobalPropertiesFolder(gui, aGlobal, floorplanner);
		var view2df = construct2dInterfaceFolder(globalPropFolder, aGlobal, blueprint3d.floorplanner);
		blueprint3d.floorplanner.view.draw();
		for (var i in this.guiControllers) // Iterate over gui controllers to update the values
		{
			this.guiControllers[i].updateDisplay();
	    }
	}

	this.setGUIControllers = function(guiControls)
	{
		this.guiControllers = guiControls;
	}
}

var CameraProperties = function()
{
	this.ratio = 1;
	this.ratio2 = 1;
	this.locked = false;
	this.three = null;

	this.change = function()
	{
		if(this.three)
		{
			this.three.changeClippingPlanes(this.ratio, this.ratio2);
		}
	}

	this.changeLock = function()
	{
		if(this.three)
		{
			this.three.lockView(!this.locked);
		}
	}

	this.reset = function()
	{
		if(this.three)
		{
			this.three.resetClipping();
		}
	}
}

var CornerProperties = function(corner, gui)
{
	var scope = this;
	this.x = BP3DJS.Dimensioning.cmToMeasureRaw(corner.x);
	this.y = BP3DJS.Dimensioning.cmToMeasureRaw(corner.y);
	this.elevation = BP3DJS.Dimensioning.cmToMeasureRaw(corner.elevation);
	this.gui = gui;
	this.corner = corner;
	
	function onEvent()
	{
		scope.x = BP3DJS.Dimensioning.cmToMeasureRaw(scope.corner.x);
		scope.y = BP3DJS.Dimensioning.cmToMeasureRaw(scope.corner.y);
		scope.elevation = BP3DJS.Dimensioning.cmToMeasureRaw(scope.corner.elevation);
		scope.xcontrol.updateDisplay();
		scope.ycontrol.updateDisplay();
		scope.elevationcontrol.updateDisplay();
	}
	
	function onChangeX()
	{
		scope.corner.x = BP3DJS.Dimensioning.cmFromMeasureRaw(scope.x);
	}
	function onChangeY()
	{
		scope.corner.y = BP3DJS.Dimensioning.cmFromMeasureRaw(scope.y);
	}
	function onChangeElevation()
	{
		scope.corner.elevation = BP3DJS.Dimensioning.cmFromMeasureRaw(scope.elevation);
	}
	
	this.corner.addEventListener(BP3DJS.EVENT_CORNER_ATTRIBUTES_CHANGED, onEvent);
//	this.corner.addEventListener(BP3DJS.EVENT_MOVED, onEvent);
		
	this.f = gui.addFolder(lang['Current Corner']);
	this.xcontrol = f.add(this, 'x').name(`x(${BP3DJS.Configuration.getStringValue(BP3DJS.configDimUnit)})`).step(0.01).onChange(()=>{onChangeX()});
	this.ycontrol = f.add(this, 'y').name(`y(${BP3DJS.Configuration.getStringValue(BP3DJS.configDimUnit)})`).step(0.01).onChange(()=>{onChangeY()});
	this.elevationcontrol = f.add(this, 'elevation').name(`${lang['Elevation']}(${BP3DJS.Configuration.getStringValue(BP3DJS.configDimUnit)})`).min(0).step(0.01).onChange(()=>{onChangeElevation()});
	
	
	return this.f;
}

var RoomProperties = function(room, gui)
{
	window.currentRoom = room;
	var scope = this;
	this.gui = gui;
	this.room = room;	
	this.f = gui.addFolder(lang['Current Room']);
	this.namecontrol = f.add(room, 'name').name(lang["Name"]);
	return this.f;
}

var Wall2DProperties = function(wall2d, gui)
{
	console.log(wall2d);
	var scope = this;
	this.gui = gui;
	this.wall2d = wall2d;		
	this.walltype = 'Straight';
	this.walllength = BP3DJS.Dimensioning.cmToMeasureRaw( wall2d.wallSize);
	this.wallheight = BP3DJS.Dimensioning.cmToMeasureRaw( wall2d.height);
	function onChangeWallType()
	{
		if(scope.walltype == 'Straight')
		{
			scope.wall2d.wallType = BP3DJS.WallTypes.STRAIGHT;
		}
		else if(scope.walltype == 'Curved')
		{
			scope.wall2d.wallType = BP3DJS.WallTypes.CURVED;
			
		}
		blueprint3d.floorplanner.view.draw();
	}
	
	function onChangeWallLength()
	{
		scope.wall2d.wallSize = BP3DJS.Dimensioning.cmFromMeasureRaw(scope.walllength);
		blueprint3d.floorplanner.view.draw();
	}
	function onChangeWallHeight()
	{
		scope.wall2d.endElevation = BP3DJS.Dimensioning.cmFromMeasureRaw(scope.wallheight);
		scope.wall2d.startElevation = BP3DJS.Dimensioning.cmFromMeasureRaw(scope.wallheight);
		blueprint3d.floorplanner.view.draw();
	}
	
	this.options = ['Straight', 'Curved'];
	if(this.wall2d.wallType == BP3DJS.WallTypes.CURVED)
	{
		this.walltype = 'Curved';
	}
	this.f = gui.addFolder(lang['Current Wall 2D']);
	// this.typecontrol = f.add(this, 'walltype', this.options).name("Wall Type").onChange(()=>{onChangeWallType()});
	if(this.wall2d.wallType == BP3DJS.WallTypes.STRAIGHT)
	{
		this.lengthcontrol = f.add(this, 'walllength').name(lang["Wall Length"]).onChange(()=>{onChangeWallLength()});
		this.lengthcontrol = f.add(this, 'wallheight').name(lang["Wall Height"]).onChange(()=>{onChangeWallHeight()});
	}	
	return this.f;
}

var ItemProperties = function(gui)
{
	this.name = 'an item';
	this.width = 10;
	this.height = 10;
	this.depth = 10;
	this.fixed = false;
	this.currentItem = null;
	this.guiControllers = null;
	this.gui = gui;
	this.materialsfolder = null;
	this.materials = {};
	this.totalmaterials = -1;
	this.proportionalsize = false;
	this.changingdimension = 'w';

	this.setGUIControllers = function(guiControls)
	{
		this.guiControllers = guiControls;
	}

	this.setItem = function(item)
	{
		this.currentItem = item;
		if(this.materialsfolder)
		{
			this.gui.removeFolder(this.materialsfolder.name);
		}
		if(item)
		{
			var scope = this;
			var material = item.material;
			this.name = item.metadata.itemName;
			this.width = BP3DJS.Dimensioning.cmToMeasureRaw(item.getWidth());
			this.height = BP3DJS.Dimensioning.cmToMeasureRaw(item.getHeight());
			this.depth = BP3DJS.Dimensioning.cmToMeasureRaw(item.getDepth());
			this.fixed = item.fixed;
			this.proportionalsize = item.getProportionalResize();

			for (var i in this.guiControllers) // Iterate over gui controllers to update the values
			{
				this.guiControllers[i].updateDisplay();
		    }

			this.materialsfolder = this.gui.addFolder(lang['Materials']);
			this.materials = {};
			if(material.length)
			{
				this.totalmaterials = material.length;
				for (var i=0;i<material.length;i++)
				{
					this.materials['mat_'+i] = '#'+material[i].color.getHexString();
					var matname = (material[i].name) ? material[i].name : 'Material '+(i+1);
					var ccontrol = this.materialsfolder.addColor(this.materials, 'mat_'+i).name(matname).onChange(()=>{scope.dimensionsChanged()});
				}
				return this.materialsfolder;
			}
			this.totalmaterials = 1;
			var matname = (material.name) ? material.name : 'Material 1';
			this.materials['mat_0'] = '#'+material.color.getHexString();
			var ccontrol = this.materialsfolder.addColor(this.materials, 'mat_0').name(matname).onChange(()=>{scope.dimensionsChanged()});
			return this.materialsfolder;
		}
		this.name = 'None';
		return this.materialsfolder;
	}

	this.dimensionsChanged = function()
	{
		if(this.currentItem)
		{
			var item = this.currentItem;



			this.currentItem.resize(h,w,d);

			if( w != ow)
			{
				this.height = BP3DJS.Dimensioning.cmToMeasureRaw(item.getHeight());
				this.depth = BP3DJS.Dimensioning.cmToMeasureRaw(item.getDepth());
			}

			if( h != oh)
			{
				this.width = BP3DJS.Dimensioning.cmToMeasureRaw(item.getWidth());
				this.depth = BP3DJS.Dimensioning.cmToMeasureRaw(item.getDepth());
			}

			if( d != od)
			{
				this.width = BP3DJS.Dimensioning.cmToMeasureRaw(item.getWidth());
				this.height = BP3DJS.Dimensioning.cmToMeasureRaw(item.getHeight());
			}
			for (var i=0;i<this.totalmaterials;i++)
			{
				this.currentItem.setMaterialColor(this.materials['mat_'+i], i);
			}

			this.guiControllers.forEach((control)=>{control.updateDisplay()}); // Iterate over gui controllers to update the values
		}
	}

	this.proportionFlagChange = function()
	{
		if(this.currentItem)
		{
			this.currentItem.setProportionalResize(this.proportionalsize);
		}
	}

	this.lockFlagChanged = function()
	{
		if(this.currentItem)
		{
			this.currentItem.setFixed(this.fixed);
		}
	}

	this.deleteItem = function()
	{
		if(this.currentItem)
		{
			this.currentItem.remove();
			this.setItem(null);
		}
	}

	this.addCartItem = function() {
		if(this.currentItem)
		{
			console.log(this.currentItem);

			if(!!this.currentItem.metadata.productId) {
				if(isRoomLock) {
					toastr.error(lang["This room is not bought."])
					return;
				}

				let product_id = this.currentItem.metadata.productId;
		
				$.post(addToCartURL, {id : product_id, quantity: 1, _token: _token}, function(data) {
		
					if(data.status == 1) {
					toastr.success(data.message);
		
					} else {
					toastr.error(data.message);
					}
		
					// console.log(data, "add cart")
				})
			} else {
				toastr.error(lang["This is not product."])
			}

		}
	}
}

var WallProperties = function()
{
	this.textures = [
		['public/roomDesign/rooms/textures/wallmap.png', true, 1], ['public/roomDesign/rooms/textures/wallmap_yellow.png', true, 1],
		['public/roomDesign/rooms/textures/light_brick.jpg', false, 50], ['public/roomDesign/rooms/textures/marbletiles.jpg', false, 300],
		['public/roomDesign/rooms/textures/light_brick.jpg', false, 100], ['public/roomDesign/rooms/textures/light_fine_wood.jpg', false, 300],
		['public/roomDesign/rooms/textures/hardwood.png', false, 300]];

	this.floormaterialname = 0;
	this.wallmaterialname = 0;

	this.forAllWalls = false;

	this.currentWall = null;
	this.currentFloor = null;

	this.wchanged = function()
	{
		if(this.currentWall)
		{
			this.currentWall.setTexture(this.textures[this.wallmaterialname][0], this.textures[this.wallmaterialname][1], this.textures[this.wallmaterialname][2]);
		}
		if(this.currentFloor && this.forAllWalls)
		{
			this.currentFloor.setRoomWallsTexture(this.textures[this.wallmaterialname][0], this.textures[this.wallmaterialname][1], this.textures[this.wallmaterialname][2]);
		}
	}

	this.fchanged = function()
	{
		if(this.currentFloor)
		{
			this.currentFloor.setTexture(this.textures[this.floormaterialname][0], this.textures[this.floormaterialname][1], this.textures[this.floormaterialname][2]);
		}
	}


	this.setWall = function(wall)
	{
		this.currentWall = wall;
		window.current_wall = wall;
	}

	this.setFloor = function(floor)
	{
		this.currentFloor = floor;
		window.current_floor = floor;
	}
}

function addBlueprintListeners(blueprint3d)
{
	var three = blueprint3d.three;	 
	var currentFolder = undefined; 
	var currentRoom = undefined;
	var startData = undefined;

	function closeCurrent3DSelectionFolders()
	{
		if(itemPropFolder && itemPropFolder != null)
		{
			itemPropFolder.close();
			selectionsFolder.removeFolder(itemPropFolder.name);
		}
		if(wallPropFolder && wallPropFolder != null)
		{
			wallPropFolder.close();
			selectionsFolder.removeFolder(wallPropFolder.name);
		}

		if(materialPropFolder && materialPropFolder != null)
		{
			materialPropFolder.close();
			selectionsFolder.removeFolder(materialPropFolder.name);
		}
	}
	function wallClicked(wall)
	{
		closeCurrent3DSelectionFolders();
		
		aWall = new WallProperties();
		aWall.setWall(wall);
		aWall.setFloor(null);		
		wallPropFolder = getWallAndFloorPropertiesFolder(selectionsFolder, aWall);
		// selectionsFolder.addFolder(wallPropFolder);
		
		// wallPropFolder.open();
		selectionsFolder.open();
	}

	function floorClicked(floor)
	{
		closeCurrent3DSelectionFolders();
		
		aWall = new WallProperties();
		aWall.setFloor(floor);
		aWall.setWall(null);
		
		wallPropFolder = getWallAndFloorPropertiesFolder(selectionsFolder, aWall);
//		selectionsFolder.addFolder(wallPropFolder);
		
		// wallPropFolder.open();
		selectionsFolder.open();
	}

	function itemSelected(item)
	{
		console.log(item, "----------select");
		closeCurrent3DSelectionFolders();
		
		anItem = new ItemProperties(selectionsFolder, item);
		materialPropFolder = anItem.setItem(item);
		
		itemPropFolder = getItemPropertiesFolder(selectionsFolder, anItem);
		// selectionsFolder.addFolder(itemPropFolder);
		
		itemPropFolder.open();
		selectionsFolder.open();
		
	}
	function itemUnselected()
	{
		closeCurrent3DSelectionFolders();
		if(anItem!=null)
		{
			anItem.setItem(undefined);
		}
	}

	three.addEventListener(BP3DJS.EVENT_ITEM_SELECTED, function(o){itemSelected(o.item);});
	three.addEventListener(BP3DJS.EVENT_ITEM_UNSELECTED, function(o){itemUnselected();});
	three.addEventListener(BP3DJS.EVENT_WALL_CLICKED, (o)=>{wallClicked(o.item);});
    three.addEventListener(BP3DJS.EVENT_FLOOR_CLICKED, (o)=>{floorClicked(o.item);});
    three.addEventListener(BP3DJS.EVENT_FPS_EXIT, ()=>{$('#showDesign').trigger('click')});
    
    function echoEvents(o)
    {	
   		// console.log(o.type, o);
    }	
    
    function addGUIFolder(o)
    {	
//    	console.log(o.type, o.item);
    	if(currentFolder)
		{
    		selectionsFolder.removeFolder(currentFolder.name);
		}
    	if(o.type == BP3DJS.EVENT_CORNER_2D_CLICKED)
		{
    		currentFolder = CornerProperties(o.item, selectionsFolder);//getCornerPropertiesFolder(gui, o.item);
		}
    	else if(o.type == BP3DJS.EVENT_ROOM_2D_CLICKED)
		{
    		currentFolder = RoomProperties(o.item, selectionsFolder);//getRoomPropertiesFolder(gui, );
		}
    	else if(o.type == BP3DJS.EVENT_WALL_2D_CLICKED)
		{
    		currentFolder = Wall2DProperties(o.item, selectionsFolder);
		}
    	if(currentFolder)
		{
    		currentFolder.open();
    		selectionsFolder.open();
		}
    }	
    
    var model_floorplan = blueprint3d.model.floorplan;
    model_floorplan.addEventListener(BP3DJS.EVENT_CORNER_2D_DOUBLE_CLICKED, echoEvents);
    model_floorplan.addEventListener(BP3DJS.EVENT_WALL_2D_DOUBLE_CLICKED, echoEvents);
    model_floorplan.addEventListener(BP3DJS.EVENT_ROOM_2D_DOUBLE_CLICKED, echoEvents);
    
    model_floorplan.addEventListener(BP3DJS.EVENT_NOTHING_CLICKED, addGUIFolder);
    model_floorplan.addEventListener(BP3DJS.EVENT_CORNER_2D_CLICKED, addGUIFolder);
    model_floorplan.addEventListener(BP3DJS.EVENT_WALL_2D_CLICKED, addGUIFolder);
    model_floorplan.addEventListener(BP3DJS.EVENT_ROOM_2D_CLICKED, addGUIFolder);
    
    model_floorplan.addEventListener(BP3DJS.EVENT_CORNER_2D_HOVER, echoEvents);
    model_floorplan.addEventListener(BP3DJS.EVENT_WALL_2D_HOVER, echoEvents);
    model_floorplan.addEventListener(BP3DJS.EVENT_ROOM_2D_HOVER, echoEvents);
    
    model_floorplan.addEventListener(BP3DJS.EVENT_CORNER_ATTRIBUTES_CHANGED, echoEvents);
    model_floorplan.addEventListener(BP3DJS.EVENT_WALL_ATTRIBUTES_CHANGED, echoEvents);
    model_floorplan.addEventListener(BP3DJS.EVENT_ROOM_ATTRIBUTES_CHANGED, echoEvents);
    

    function deleteEvent(evt)
    {
    	console.log('DELETED ', evt);
    }
    
    model_floorplan.addEventListener(BP3DJS.EVENT_DELETED, deleteEvent);
    
    BP3DJS.Configuration.setValue(BP3DJS.configSystemUI, false);
    


// three.skybox.toggleEnvironment(this.checked);
// currentTarget.setTexture(textureUrl, textureStretch, textureScale);
// three.skybox.setEnvironmentMap(textureUrl);
}

function getCornerPropertiesFolder(gui, corner)
{
	var f = gui.addFolder(lang['Current Corner']);
	var xcontrol = f.add(corner, 'x').name("x").step(0.01);
	var ycontrol = f.add(corner, 'y').name("y").step(0.01);
	var elevationctonrol = f.add(corner, 'elevation').name(lang["Elevation"]).step(0.01);
	return f;	
}

function getRoomPropertiesFolder(gui, room)
{
	var f = gui.addFolder(lang['Current Room']);
	var namecontrol = f.add(corner, 'name').name(lang["Name"]);
	return f;	
}

function getCameraRangePropertiesFolder(gui, camerarange)
{
	var f = gui.addFolder('Camera Limits');
	var ficontrol = f.add(camerarange, 'ratio', -1, 1).name("Range").step(0.01).onChange(function(){camerarange.change()});
	var ficontrol2 = f.add(camerarange, 'ratio2', -1, 1).name("Range 2").step(0.01).onChange(function(){camerarange.change()});
	var flockcontrol = f.add(camerarange, 'locked').name("Lock View").onChange(function(){camerarange.changeLock()});
	var resetControl = f.add(camerarange, 'reset').name('Reset');
	return f;

}

function construct2dInterfaceFolder(f, global, floorplanner)
{
	function onChangeSnapResolution()
	{
		BP3DJS.Configuration.setValue(BP3DJS.snapTolerance, BP3DJS.Dimensioning.cmFromMeasureRaw(view2dindirect.snapValue));
	}
	
	function onChangeGridResolution()
	{
		BP3DJS.Configuration.setValue(BP3DJS.gridSpacing, BP3DJS.Dimensioning.cmFromMeasureRaw(view2dindirect.gridResValue));
		blueprint3d.floorplanner.view.draw();
	}
	
	var units = BP3DJS.Configuration.getStringValue(BP3DJS.configDimUnit);
	var view2dindirect = {
			'snapValue': BP3DJS.Dimensioning.cmToMeasureRaw(BP3DJS.Configuration.getNumericValue(BP3DJS.snapTolerance)), 
			'gridResValue': BP3DJS.Dimensioning.cmToMeasureRaw(BP3DJS.Configuration.getNumericValue(BP3DJS.gridSpacing))
			};	
	
	f.removeFolder('2D Editor');
	
	var view2df = f.addFolder('2D Editor');
	view2df.add(BP3DJS.config, 'snapToGrid',).name("Snap To Grid");
	view2df.add(view2dindirect, 'snapValue', 0.1).name(`Snap Every(${units})`).onChange(onChangeSnapResolution);
	view2df.add(view2dindirect, 'gridResValue', 0.1).name(`Grid Resolution(${units})`).onChange(onChangeGridResolution);
	view2df.add(BP3DJS.config, 'scale', 0.25, 5, ).step(0.25).onChange(()=>{
//	view2df.add(BP3DJS.config, 'scale', 1.0, 10, ).step(0.25).onChange(()=>{
		blueprint3d.floorplanner.zoom();
//		blueprint3d.floorplanner.view.zoom();
		blueprint3d.floorplanner.view.draw();
		});
	
	
	var wallf = view2df.addFolder(lang['Wall Measurements']);
	wallf.add(BP3DJS.wallInformation, 'exterior').name('Exterior');
	wallf.add(BP3DJS.wallInformation, 'interior').name('Interior');
	wallf.add(BP3DJS.wallInformation, 'midline').name('Midline');
	wallf.add(BP3DJS.wallInformation, 'labels').name('Labels');
	wallf.add(BP3DJS.wallInformation, 'exteriorlabel').name('Label for Exterior');
	wallf.add(BP3DJS.wallInformation, 'interiorlabel').name('Label for Interior');
	wallf.add(BP3DJS.wallInformation, 'midlinelabel').name('Label for Midline');
	
	var carbonPropsFolder = getCarbonSheetPropertiesFolder(view2df, floorplanner.carbonSheet, global);
	
	view2df.open();
	return view2df;
}

function getGlobalPropertiesFolder(gui, global, floorplanner)
{
	var f = gui.addFolder(lang['Interface & Configuration']);
	
	var unitsf = f.addFolder(lang['Units']);	
	var ficontrol = unitsf.add(global.units, 'a',).name("Feets'' Inches'").onChange(function(){global.setUnit("a")});
	var icontrol = unitsf.add(global.units, 'b',).name("Inches'").onChange(function(){global.setUnit("b")});
	var ccontrol = unitsf.add(global.units, 'c',).name('Cm').onChange(function(){global.setUnit("c")});
	var mmcontrol = unitsf.add(global.units, 'd',).name('mm').onChange(function(){global.setUnit("d")});
	var mcontrol = unitsf.add(global.units, 'e',).name('m').onChange(function(){global.setUnit("e")});
	global.setGUIControllers([ficontrol, icontrol, ccontrol, mmcontrol, mcontrol]);
	
//	BP3DJS.Dimensioning.cmFromMeasureRaw(scope.x);
//	BP3DJS.Dimensioning.cmToMeasureRaw(scope.x);
	
	f.open();
	return f;
}

function getCarbonSheetPropertiesFolder(gui, carbonsheet, globalproperties)
{
	var f = gui.addFolder('Carbon Sheet');
	var url = f.add(carbonsheet, 'url').name('Url');
	var width = f.add(carbonsheet, 'width').name('Real Width').max(5.0).step(0.01);
	var height = f.add(carbonsheet, 'height').name('Real Height').max(5.0).step(0.01);
	var proportion = f.add(carbonsheet, 'maintainProportion').name('Maintain Proportion');
	var x = f.add(carbonsheet, 'x').name('Move in X');
	var y = f.add(carbonsheet, 'y').name('Move in Y');

	var ax = f.add(carbonsheet, 'anchorX').name('Anchor X');
	var ay = f.add(carbonsheet, 'anchorY').name('Anchor Y');
	var transparency = f.add(carbonsheet, 'transparency').name('Transparency').min(0).max(1.0).step(0.05);
	carbonsheet.addEventListener(BP3DJS.EVENT_UPDATED, function(){
		url.updateDisplay();
		width.updateDisplay();
		height.updateDisplay();
		x.updateDisplay();
		y.updateDisplay();
		ax.updateDisplay();
		ay.updateDisplay();
		transparency.updateDisplay(width);
	});

	globalproperties.guiControllers.push(width);
	globalproperties.guiControllers.push(height);
	return f;
}

function getItemPropertiesFolder(gui, anItem)
{
	var f = gui.addFolder(lang['Current Item (3D)']);
	var inamecontrol = f.add(anItem, 'name');
	var wcontrol = f.add(anItem, 'width', 0.1, 1000.1).step(0.1);
	var hcontrol = f.add(anItem, 'height', 0.1, 1000.1).step(0.1);
	var dcontrol = f.add(anItem, 'depth', 0.1, 1000.1).step(0.1);
	var pcontrol = f.add(anItem, 'proportionalsize').name(lang['Maintain Size Ratio']);
	var lockcontrol = f.add(anItem, 'fixed').name(lang['Locked in place']);
	var deleteItemControl = f.add(anItem, 'deleteItem').name(lang['Delete Item']);
	var addCartItemControl = f.add(anItem, 'addCartItem').name(lang['Add Cart Item']);

	function changed()
	{
		anItem.dimensionsChanged();
	}

	function lockChanged()
	{
		anItem.lockFlagChanged();
	}

	function proportionFlagChanged()
	{
		anItem.proportionFlagChange();
	}

	wcontrol.onChange(changed);
	hcontrol.onChange(changed);
	dcontrol.onChange(changed);
	pcontrol.onChange(proportionFlagChanged);
	lockcontrol.onChange(lockChanged);

	anItem.setGUIControllers([inamecontrol, wcontrol, hcontrol, dcontrol, pcontrol, lockcontrol, deleteItemControl, addCartItemControl]);

	return f;
}

function getWallAndFloorPropertiesFolder(gui, aWall)
{
	return
	var f = gui.addFolder('Wall and Floor (3D)');
	var wcontrol = f.add(aWall, 'wallmaterialname', {Grey: 0, Yellow: 1, Checker: 2, Marble: 3, Bricks: 4}).name('Wall');
	var fcontrol = f.add(aWall, 'floormaterialname', {'Fine Wood': 5, 'Hard Wood': 6}).name('Floor');
	var multicontrol = f.add(aWall, 'forAllWalls').name('All Walls In Room');
	function wchanged()
	{
		aWall.wchanged();
	}

	function fchanged()
	{
		aWall.fchanged();
	}

	wcontrol.onChange(wchanged);
	fcontrol.onChange(fchanged);
	return f;
}

function datGUI(three, floorplanner)
{
	gui = new dat.GUI();	
	aCameraRange = new CameraProperties();	
	aCameraRange.three = three;
	aGlobal = new GlobalProperties();
	// globalPropFolder = getGlobalPropertiesFolder(gui, aGlobal, floorplanner);	

	// f3d = globalPropFolder.addFolder('3D Editor')
	// cameraPropFolder = getCameraRangePropertiesFolder(f3d, aCameraRange);
	
	// var view2df = construct2dInterfaceFolder(globalPropFolder, aGlobal, floorplanner);
	// view2df.open();
	
	selectionsFolder = gui.addFolder(lang['Selections']);
}


$(document).ready(function()
{
	dat.GUI.prototype.removeFolder = function(name)
	{
		  var folder = this.__folders[name];
		  if (!folder) {
		    return;
		  }
		  folder.close();
		  this.__ul.removeChild(folder.domElement.parentNode);
		  delete this.__folders[name];
		  this.onResize();
	}
	// main setup
	var opts =
	{
			floorplannerElement: 'floorplanner-canvas',
			threeElement: '#viewer',
			threeCanvasElement: 'three-canvas',
			textureDir: "models/textures/",
			widget: false
	}
	blueprint3d = new BP3DJS.BlueprintJS(opts);
	var viewerFloorplanner = new ViewerFloorplanner(blueprint3d);
	
	window.floorPlanPart = blueprint3d.model.floorplan;

	blueprint3d.model.addEventListener(BP3DJS.EVENT_LOADED, function(){console.log('LOAD SERIALIZED JSON ::: ');});
	
	
	mainControls(blueprint3d);

	blueprint3d.model.loadSerialized(window.defaultRoomData);

	if(isRoomLock) {
	  setTimeout(() => {
		blueprint3d.model.scene.getItems().forEach(item => {
		  item.setFixed(true);
		})
	  }, 3000)
	}

	// blueprint3d.model.loadSerialized(myhome);


	addBlueprintListeners(blueprint3d);
	datGUI(blueprint3d.three, blueprint3d.floorplanner);
	blueprint3d.three.stopSpin();
//	gui.closed = true;


	$('#showAddItems').hide();
	$('#viewcontrols').hide();

	$('.card').flip({trigger:'manual', axis:'x'});
	$('#showFloorPlan').click(function()
	{
		$('.card').flip(false);
		$(this).addClass('active');
		$('#showDesign').removeClass('active');
		$('#showFirstPerson').removeClass('active');
		$('#showAddItems').hide();
		$('#viewcontrols').hide();
//		gui.closed = true;
		blueprint3d.three.pauseTheRendering(true);
		blueprint3d.three.getController().setSelectedObject(null);
	});

	$('#showDesign').click(function()
	{
		blueprint3d.model.floorplan.update();
		$('.card').flip(true);
//		gui.closed = false;
		$(this).addClass('active');
		$('#showFloorPlan').removeClass('active');
		$('#showFirstPerson').removeClass('active');

		$('#showAddItems').show();
		$('#viewcontrols').show();

		blueprint3d.three.pauseTheRendering(false);
		blueprint3d.three.switchFPSMode(false);
	});
	$('#showFirstPerson').click(function()
	{
		blueprint3d.model.floorplan.update();
		$('.card').flip(true);
//		gui.closed = true;
		$(this).addClass('active');
		$('#showFloorPlan').removeClass('active');
		$('#showDesign').removeClass('active');

		$('#showAddItems').hide();
		$('#viewcontrols').hide();

		blueprint3d.three.pauseTheRendering(false);
		blueprint3d.three.switchFPSMode(true);
	});

	let orbitControls = blueprint3d.three.controls;
	$("#zoomOutCameraMode").click(function() {
		$(this).toggleClass('active');
		orbitControls.dollyOutC(1.1);
		orbitControls.update();
	});

	$("#zoomInCameraMode").click(function() {
		$(this).toggleClass('active');
		orbitControls.dollyInC(1.1);
		orbitControls.update();
	});

	var panSpeed = 30;
	var directions = {
	  UP: 1,
	  DOWN: 2,
	  LEFT: 3,
	  RIGHT: 4
	}

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


	function pan(direction) {
		switch (direction) {
			case directions.UP:
				orbitControls.panC(0, panSpeed);
			break;
			case directions.DOWN:
				orbitControls.panC(0, -panSpeed);
			break;
			case directions.LEFT:
				orbitControls.panC(panSpeed, 0);
			break;
			case directions.RIGHT:
				orbitControls.panC(-panSpeed, 0);
			break;
		}
		orbitControls.update();
	}
	

	$('#showSwitchCameraMode').click(function()
	{
		$(this).toggleClass('active');
		blueprint3d.three.switchOrthographicMode($(this).hasClass('active'));
	});

	$('#showSwitchWireframeMode').click(function()
	{
		$(this).toggleClass('wireframe-active');
		blueprint3d.three.switchWireframe($(this).hasClass('wireframe-active'));
	});

	$('#topview, #isometryview, #frontview, #leftview, #rightview').click(function(){
		blueprint3d.three.switchView($(this).attr('id'));
	});

	var isFloor = true;
	$("#viewType").click(function() {
		if(isFloor) {
			blueprint3d.model.floorplan.update();
			$('.card').flip(true);
	//		gui.closed = false;
			$(this).addClass('active');
			$('#showFloorPlan').removeClass('active');
			$('#showFirstPerson').removeClass('active');
	
			$('#showAddItems').show();
			$('#viewcontrols').show();
	
			blueprint3d.three.pauseTheRendering(false);
			blueprint3d.three.switchFPSMode(false);
		} else {
			$('.card').flip(false);
			$(this).addClass('active');
			$('#showDesign').removeClass('active');
			$('#showFirstPerson').removeClass('active');
			$('#showAddItems').hide();
			$('#viewcontrols').hide();
	//		gui.closed = true;
			blueprint3d.three.pauseTheRendering(true);
			blueprint3d.three.getController().setSelectedObject(null);
		}

		$("#viewType").html(`
			<span class="material-symbols-outlined">
				${isFloor? 'deployed_code' : 'dataset'}
			</span>
		`)
		isFloor = !isFloor;
	})

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

	function onDesignSaveBtn() {

		let name = $("#roomName").val();
		if(name == "") {
			toastr.error(lang["Please input room name."]);
			return;
		}

		if(user.id == '') {
			toastr.error(lang["Please Login in site."]);
			window.location.href = window.loginURL;
			return;
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

	$("#designBtn").click(saveSaleDesignSave);
    $("#designSaveBtn").click(onDesignSaveBtn);
    $("#designScreenShotBtn").click(onDesignScreenShotBtn);
    $("#designCancel").click(onDesignCancel);

	$("#add-items").find(".add-item").mousedown(function(e) {
	      var modelUrl = $(this).attr("model-url");
	      var itemType = parseInt($(this).attr("model-type"));
	      var itemFormat = $(this).attr('model-format');
	      var productId = $(this).attr('product-id');
	      var metadata = {
	        itemName: $(this).attr("model-name"),
	        resizable: true,
	        modelUrl: baseURL + '/' + modelUrl,
	        itemType: itemType,
	        format: itemFormat,
			productId: productId
	      }
	      console.log('ITEM TYPE ::: ', itemType);
	      if([2,3,7,9].indexOf(metadata.itemType) != -1 && aWall.currentWall)
    	  {
	    	  var placeAt = aWall.currentWall.center.clone();
	    	  blueprint3d.model.scene.addItem(itemType, modelUrl, metadata, null, null, null, false, {position: placeAt, edge: aWall.currentWall});
    	  }
	      else if(aWall.currentFloor)
    	  {
	    	  var placeAt = aWall.currentFloor.center.clone();
	    	  blueprint3d.model.scene.addItem(itemType, modelUrl, metadata, null, null, null, false, {position: placeAt});
    	  }
	      else
    	  {
	    	  blueprint3d.model.scene.addItem(itemType, modelUrl, metadata);
    	  }

		  $("#add-items-modal").modal("hide");
	});

	$(".left-container").find(".addStaticItem").click(function(e) {

		console.log("click-door", $(this).attr("model-url"))
  
		var modelUrl = $(this).attr("model-url");
		var itemType = parseInt($(this).attr("model-type"));
		var itemFormat = $(this).attr('model-format');
		var productId = $(this).attr('model-id');
		var metadata = {
		  itemName: $(this).attr("model-name"),
		  resizable: true,
		  modelUrl: baseURL + '/' + modelUrl,
		  itemType: itemType,
		  format: itemFormat,
		  productId: productId
		}
  
		if([2,3,7,9].indexOf(metadata.itemType) != -1 && aWall.currentWall)
		{
			var placeAt = aWall.currentWall.center.clone();
			blueprint3d.model.scene.addItem(itemType, modelUrl, metadata, null, null, null, false, {position: placeAt, edge: aWall.currentWall});
		}
		else if(aWall.currentFloor)
		{
			var placeAt = aWall.currentFloor.center.clone();
			blueprint3d.model.scene.addItem(itemType, modelUrl, metadata, null, null, null, false, {position: placeAt});
		}
		else
		{
			blueprint3d.model.scene.addItem(itemType, modelUrl, metadata);
		}
		
		$("#add-items-modal").modal("hide");
	})


	function onAddToCartRoomItem() {
		if(productId > 0) {
			$.post(addToCartURL, {id : window.productId, quantity: 1, _token: _token}, function(data) {
	
				if(data.status == 1) {
				  toastr.success(data.message);
		  
				} else {
				  toastr.error(data.message);
				}
		  
				// console.log(data, "add cart")
			})
		} else {
			toastr.error(lang["This room is not set for design."]);
		}


	}

    $("#addRoomItem").click(onAddToCartRoomItem);

	window.isRoof = false;
	$("#addCeilBtn").click(function() {
		window.isRoof = !window.isRoof;

		$("#addCeilBtn").html(`
			<img src="${window.assetsURL + (window.isRoof? '/ceil' : '/no-ceil')}.svg" />
		`)
		// console.log(floorPlanPart)
		// blueprint3d.model.floorplan.rooms.forEach(room => {
		// 	blueprint3d.model.scene.remove(room['roofPlane'])
		// 	delete room['roofPlane'];
		// })
		blueprint3d.model.floorplan.update();
		// blueprint3d.floorplanner.view.draw();

		// blueprint3d.three.
	})

	function generateRoom (type) {
		let startPos = {x : -900, y : -300}
		let roomPos = [];
		if(type == 0) {
			roomPos = room1;
		} else {
			roomPos = room2;
		}
		const corners = roomPos.map(({x, y}) => floorPlanPart.newCorner(startPos.x + x, startPos.y + y))

		corners.forEach((corner, i) => {
			if(i < corners.length - 1) {
				floorPlanPart.newWall(corner, corners[i + 1]);
				// floorPlanPart.newWallsForIntersections(corner, corners[i + 1]);
			} else {
				floorPlanPart.newWall(corner, corners[0]);
				// floorPlanPart.newWallsForIntersections(corner, corners[0]);
			}
		})
	}


	function onAddRoomItem(type = 0) {
		const room = generateRoom(type)
	}

	$("#addRoomPlan1").click(onAddRoomItem.bind(this, 0));
	$("#addRoomPlan2").click(onAddRoomItem.bind(this, 1));

	const wallTextures = wall_textures.map(txt => `
		<div class="color-item" data-url="${txt[0]}" data-stretch="${txt[1]}" data-scale="${txt[2]}"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="${lang['Update wall texture.']}" >
			<img src="${baseURL + '/' + txt[0]}"/>
		</div>
	`);

	$("#interface-color").html(wallTextures);
	$(".color-item").click(function() {
		const url = $(this).attr("data-url");
		const strech = $(this).attr("data-stretch");
		const scale = $(this).attr("data-scale");
		console.log(url, strech, scale)

		if(window.current_wall)
		{
			window.current_wall.setTexture(url, strech, scale);
		}
		if(window.current_floor)
		{
			window.current_floor.setRoomWallsTexture(url, strech, scale);
		}
	})

	const floorTextures = wall_textures.map(txt => `
	<div class="color-floor" data-url="${txt[0]}" data-stretch="${txt[1]}" data-scale="${txt[2]}"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="${lang['Update Floor texture.']}" >
			<img src="${baseURL + '/' + txt[0]}"/>
		</div>
	`);

	$("#interface-floor").html(floorTextures);
	$(".color-floor").click(function() {
		const url = $(this).attr("data-url");
		const strech = $(this).attr("data-stretch");
		const scale = $(this).attr("data-scale");
		console.log(url, strech, scale)
		if(window.current_floor)
		{
			window.current_floor.setTexture(url, strech, scale);
		}
	})


	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

});
