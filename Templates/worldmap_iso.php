<?php
if(!isset($_SESSION['sessid']))
	header("Location: index.php");
//view=worldmap_iso&islandX=48&islandY=77
if(!isset($_GET['islandX'])||!isset($_GET['islandY']))
 header("Location: ../index.php");
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/worldmap.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<body id="worldmap_iso" dir="rtl">
<div id="container">
 <div id="container2">
  <div id="header">
   <h1>إيكارياما ikariam</h1>
   <h2>عش في العصور القديمة!</h2>
  </div>
  <div id="avatarNotes"></div>
<script type='text/javascript'>
if(!window.console) {
    var console = function(){};
    console.log = function(){};
}
MAXSIZE = 9;
halfMaxSize = Math.floor(MAXSIZE/2);
start_x=<?php echo $_GET['islandX'];?>;
start_y=<?php echo $_GET['islandY'];?>;
center_x=<?php echo $_GET['islandX'];?>;
center_y=<?php echo $_GET['islandY'];?>;
center_x_begin=<?php echo $_GET['islandX'];?>;
center_y_begin=<?php echo $_GET['islandY'];?>;
wonder_status=1;
tradegood_status=1;
city_status=1;
IE = (navigator.appName!='Microsoft Internet Explorer')?0:1;
tradegoodText = new Array();
tradegoodText[1] = 'مشروب العنب';
tradegoodText[2] = 'رخام';
tradegoodText[3] = 'بلور';
tradegoodText[4] = 'كبريت';
wonderText = new Array();
wonderText[1] = 'حدَّاد هفيستس';
wonderText[2] = 'بستان هادس الرائع';
wonderText[3] = 'حدائق ديميتر';
wonderText[4] = 'مركز أثينا';
wonderText[5] = 'مركز هيرميز';
wonderText[6] = 'حصن آرس';
wonderText[7] = 'مركز بوزيدون';
wonderText[8] = 'كولوسوس';
var mapText = new Array();
mapText['markedislandlink'] = 'تركيز الخارطة على وسط هذه الجزيرة';
markCoordX = -1;
markCoordY = -1;
occupiedIslandJS = new Array();
allyIslandJS = new Array();
militaryIslandsJS = new Array();

/*if (!occupiedIslandJS[13]) {
    occupiedIslandJS[13] = new Array();
}
if (occupiedIslandJS[13]) {
    occupiedIslandJS[13][15] = 1;
}
 */
/*if (!allyIslandJS[25]) {
    allyIslandJS[25] = new Array();
}
if (allyIslandJS[25]) {
    allyIslandJS[25][66] = 1;
}
*/
ownIslandJS = new Array();
<?php 
for($i=0; $i<count($session->cities); $i++){
$cid = $session->cities[$i];
$iid = $database->getCityField($cid,"iid");
$x = $database->getIslandField($iid,"x");
$y = $database->getIslandField($iid,"y");
?>
if (!ownIslandJS[<?php echo $x;?>]) {
    ownIslandJS[<?php echo $x;?>] = new Array();
}
if (ownIslandJS[<?php echo $x;?>]) {
    ownIslandJS[<?php echo $x;?>][<?php echo $y;?>] = 1;
}
<?php }?>

var shortcuts = new Array();
<?php 
for($i=0; $i<count($session->cities); $i++){
$cid = $session->cities[$i];
$iid = $database->getCityField($cid,"iid");
$x = $database->getIslandField($iid,"x");
$y = $database->getIslandField($iid,"y");
?>
if(shortcuts[<?php echo $x;?>] == undefined) shortcuts[<?php echo $x;?>] = new Array();
if(shortcuts[<?php echo $x;?>][<?php echo $y;?>] = 1){
 shortcuts[<?php echo $x;?>][<?php echo $y;?>] =3;
} else{
 shortcuts[<?php echo $x;?>][<?php echo $y;?>] = 2;
}
<?php }?>
function Map(x, y) {
 var thisObj = this;
 thisObj.scrollDiv = new Array();
 thisObj.scrollDiv[0] = document.getElementById('map1'); 
 thisObj.scrollDiv[1] = document.getElementById('linkMap'); 
 thisObj.maxX = 9;
 thisObj.maxY = 9;
 thisObj.currMapX = x;
 thisObj.currMapY = y;
 thisObj.waitingForData = false;
 thisObj.waitingForIslandData = false;
 thisObj.startDragY = 0;
 thisObj.startDragX = 0;
 thisObj.startPosX = 0;
 thisObj.startPosY = 0;
 thisObj.posX = 0;
 thisObj.posY = 0;
 thisObj.dx = 0;
 thisObj.dy = 0;
 thisObj.lastDiffX = 0;
 thisObj.lastDiffY = 0;
 thisObj.tilesToLoad = new Array();
 thisObj.tile = new Array();
 thisObj.action = '';
 thisObj.dragHandleObj = document.getElementById('dragHandlerOverlay');
 thisObj.islands = new Array();
 this.initCoords = function() {
 thisObj.startDragY = 0;
 thisObj.startDragX = 0;
 thisObj.startPosX = 0;
 thisObj.startPosY = 0;
 thisObj.posX = 0;
 thisObj.posY = 0;
 thisObj.lastDiffX = 0;
 thisObj.lastDiffY = 0;
 thisObj.dx = 0;
 thisObj.dy = 0;
 thisObj.tilesToLoad = new Array();
 thisObj.tile = new Array();
 thisObj.action = '';
 thisObj.waitingForData = false;
 thisObj.waitingForIslandData = false;
 thisObj.scrollDiv[0].style.top = '0px';
 thisObj.scrollDiv[0].style.left = '0px';
}    
this.moveBy = function(deltaMapX, deltaMapY) {
if (thisObj.action == '') {
 if (deltaMapX && deltaMapY) {
  deltaMapX /= 2;
  deltaMapY /= 2;
 }
 if (deltaMapX) {
  thisObj.startMovePosX = thisObj.posX;
  thisObj.targetMovePosX = thisObj.posX - 240*deltaMapX;
 } else {
  thisObj.startMovePosX = thisObj.posX;
  thisObj.targetMovePosX = thisObj.posX;
 }
 if (deltaMapY) {
  thisObj.startMovePosY = thisObj.posY;
  thisObj.targetMovePosY = thisObj.posY - 120*deltaMapY;
 } else {
  thisObj.startMovePosY = thisObj.posY;
  thisObj.targetMovePosY = thisObj.posY;
 }
 thisObj.action = 'move';
 thisObj.moveInterval();
}
}
 this.moveInterval = function() {
if (!thisObj.scrollStartTime) {
thisObj.scrollStartTime = new Date().getTime();
var deltaTime = 0;
} else {
var currTime = new Date().getTime();
                var deltaTime =  currTime - thisObj.scrollStartTime;
            }
            thisObj.posX = thisObj.startMovePosX + (thisObj.targetMovePosX-thisObj.startMovePosX)*(deltaTime/500);
            thisObj.posY = thisObj.startMovePosY + (thisObj.targetMovePosY-thisObj.startMovePosY)*(deltaTime/500);        
            thisObj.setPosition();
            if (deltaTime < 500) {
                setTimeout(thisObj.moveInterval, 50);
            } else {
                thisObj.scrollStartTime = 0;
                thisObj.action = '';
              thisObj.posX = thisObj.startMovePosX + (thisObj.targetMovePosX-thisObj.startMovePosX);
                thisObj.posY = thisObj.startMovePosY + (thisObj.targetMovePosY-thisObj.startMovePosY);
                thisObj.setPosition();
                var dx = Math.round((thisObj.targetMovePosX-thisObj.startMovePosX)/2-(thisObj.targetMovePosY-thisObj.startMovePosY))/120;
                var dy = Math.round((thisObj.targetMovePosY-thisObj.startMovePosY) + (thisObj.targetMovePosX-thisObj.startMovePosX)/2)/120;
                thisObj.drawBorder(0, dx);
                if (Math.abs(dx)>1) {
                    thisObj.drawBorder(0, dx);
                }
                thisObj.drawBorder(dy, 0);
                if (Math.abs(dy)>1) {
                    thisObj.drawBorder(dy, 0);
                }
            } 
   }
   this.drawMap = function() {
    for (var x = 0; x <= thisObj.maxX; x++) {
            thisObj.tile[x] = new Array();
            for (var y = 0; y <= thisObj.maxY; y++) {
                obj = document.getElementById('tile_'+ x +'_'+ y); 
                thisObj.tile[x][y] = obj;
                obj.style.left = (x*120 - y*120) +'px';
                obj.style.top  = (x*60  + y*60)  +'px';
                thisObj.drawPiece(obj,  thisObj.currMapX + x - Math.floor(thisObj.maxX/2), thisObj.currMapY + y - Math.floor(thisObj.maxY/2));
            }
        }
    }   
    this.drawPiece = function(obj, x, y) {
        mapX = x;
        mapY = y;
        wonder = obj.firstChild;
        tradegood = wonder.nextSibling;
        cities = tradegood.nextSibling;
        marking = cities.nextSibling;
        own  = marking.nextSibling;
        coords = marking.id.split('_');
        var linkId = 'link_'+obj.id;
        objLink = document.getElementById(linkId);
        obj.style.zIndex  = 100+mapX+mapY;
        obj.mapX = mapX;
        obj.mapY = mapY; 
        if (thisObj.islands && thisObj.islands[mapX] && thisObj.islands[mapX][mapY]) {
            if (thisObj.islands[mapX][mapY]!='ocean') {
                var isl = thisObj.islands[mapX][mapY];
                obj.className = 'island'+ isl[5];
                obj.title = isl[1] +' ['+mapX+':'+mapY+']';//name
                obj.alt =isl[1];
                wonder.className='wonder wonder'+isl[3];
                tradegood.className='tradegood tradegood'+isl[2];
                cities.innerHTML=isl[7];
                cities.className = 'cities';
                if (thisObj.currMapX == mapX && thisObj.currMapY == mapY) {
                    thisObj.markIsland(obj.id);
                } else {
                    marking.className = '';
                }
                if (militaryIslandsJS[mapX] && militaryIslandsJS[mapX][mapY]) {
                    obj.className = 'island'+ isl[5]  + 'treaty';
                } else {
                    own.className = '';
                }
                if (occupiedIslandJS[mapX] && occupiedIslandJS[mapX][mapY]) {
                    obj.className = 'island'+ isl[5]  + 'own';
                } else {
                }
                if (allyIslandJS[mapX] && allyIslandJS[mapX][mapY]) {
                    obj.className = 'island'+ isl[5]  + 'ally';
                } else {
                }
                if (ownIslandJS[mapX] && ownIslandJS[mapX][mapY]) {
                     obj.className = 'island'+ isl[5]  + 'own';
                } else {
                }
                objLink.innerHTML = '<a href="#'+ mapX +':'+ mapY +'" onclick="map.clickIsland(\''+ obj.id +'\');return false;" class="islandLink"></a>';
                objLink.style.left = obj.style.left;
                objLink.style.top  = obj.style.top;
                ;
            } else  {
           obj.className = thisObj.getOceanClass(mapX, mapY);
                obj.title = '';
                wonder.className='';
                tradegood.className='';
                cities.className = '';
                cities.innerHTML='';
                objLink.innerHTML = '';
                own.className = '';
                marking.className = '';
            }
            obj.toLoad = false;;
        } else {
            obj.className = thisObj.getOceanClass(mapX, mapY);
            obj.title = '';
            wonder.className='';
            tradegood.className='';
            cities.className = '';
            objLink.innerHTML = '';
            own.className = '';
            marking.className = '';
            if (mapX < (100 + thisObj.maxX) && mapX>0 && mapY < (100 + thisObj.maxY) && mapY> 0) {
                obj.className = 'loading';
                cities.innerHTML = '';
                obj.toLoad = true;
                thisObj.tilesToLoad[mapX+'_'+mapY] = obj;
                thisObj.getMapData(mapX, mapY);
            } else { 
                cities.innerHTML = ''; 
                obj.toLoad = false;
            }
        }
    }
 this.drawBorder = function(deltaX, deltaY) {        
       if (deltaX>0) {
            thisObj.lastDiffX += 120;
            thisObj.dx--;
            for (y=0; y<=thisObj.maxY; y++) {
                dy =  thisObj.dy + y;
                obj = thisObj.tile[thisObj.maxX][y];
                obj.style.left = (thisObj.dx*120 - dy*120) +'px';
                obj.style.top  = (thisObj.dx*60  + dy*60)  +'px';
                thisObj.drawPiece(obj, thisObj.currMapX + thisObj.dx - Math.floor(thisObj.maxX/2), thisObj.currMapY + dy - Math.floor(thisObj.maxY/2));
                var temp = thisObj.tile[thisObj.maxX][y];
                for (x=thisObj.maxX-1; x>=0; x--) {
                    thisObj.tile[x+1][y] = thisObj.tile[x][y]; 
                }
                thisObj.tile[0][y] = temp;
            }
        } else if(deltaX<0) {
            thisObj.lastDiffX -= 120;
            thisObj.dx++;
            for (y=0; y<=thisObj.maxY; y++) {
                dy =  thisObj.dy + y;
                obj =thisObj.tile[0][y];
                obj.style.left = ((thisObj.dx+thisObj.maxX-1)*120 - dy*120) +'px';
                obj.style.top  = ((thisObj.dx+thisObj.maxX-1)*60  + dy*60)  +'px';
                thisObj.drawPiece(obj, thisObj.currMapX + thisObj.dx+thisObj.maxX-1 - Math.floor(thisObj.maxX/2), thisObj.currMapY + dy - Math.floor(thisObj.maxY/2));
                var temp = thisObj.tile[0][y];
                for (x=0; x<thisObj.maxX; x++) {
                    thisObj.tile[x][y] = thisObj.tile[x+1][y]; 
                }
                thisObj.tile[thisObj.maxX][y] = temp;
            }
        } else
        if (deltaY > 0) {

            thisObj.lastDiffY += 120;

            thisObj.dy++;

//            console.log('c');

            for (x=0; x<=thisObj.maxX; x++) {

                dx = thisObj.dx + x;

                obj = thisObj.tile[x][0];

                //console.log('tile_'+ x +'_'+ ((Math.abs(dy+800)%9)));

                obj.style.left = ((dx)*120 - (thisObj.dy+thisObj.maxY)*120) +'px';

                obj.style.top  = ((dx)*60  + (thisObj.dy+thisObj.maxY)*60)  +'px';

                thisObj.drawPiece(obj, thisObj.currMapX + dx - Math.floor(thisObj.maxX/2), thisObj.currMapY + thisObj.dy+thisObj.maxY - Math.floor(thisObj.maxY/2));



                var temp = thisObj.tile[x][0];

                for (y=0; y<thisObj.maxY; y++) {

                    thisObj.tile[x][y] = thisObj.tile[x][y+1]; 

                    //console.log('tile['+ (x) +']['+  (y+1) +'] = tile['+ (x) +']['+ y +']' );

                }

                thisObj.tile[x][thisObj.maxY] = temp;

                

            }

        } else if(deltaY < 0) {

            thisObj.lastDiffY -= 120;

            thisObj.dy--;

//            console.log('d');

            //dy = Math.floor((diffX/2-diffY)/120);

            for (x=0; x<=thisObj.maxX; x++) {

                dx = thisObj.dx + x;

                obj = thisObj.tile[x][thisObj.maxY];;

                //console.log('tile_'+ x +'_'+ ((Math.abs(dy+800)%9)));

                obj.style.left = ((dx)*120 - (thisObj.dy)*120) +'px';

                obj.style.top  = ((dx)*60  + (thisObj.dy)*60)  +'px';

                thisObj.drawPiece(obj, thisObj.currMapX + dx - Math.floor(thisObj.maxX/2), thisObj.currMapY + thisObj.dy - Math.floor(thisObj.maxY/2));



                var temp = thisObj.tile[x][thisObj.maxY];

                for (y=thisObj.maxY-1; y>=0; y--) {

                    thisObj.tile[x][y+1] = thisObj.tile[x][y]; 

                    //console.log('tile['+ (x+1) +']['+  y +'] = tile['+ (x) +']['+ y +']' );

                }

                thisObj.tile[x][0] = temp;

            }

        

        }

        

    }
 this.drawBorderPlusX = function() {
        thisObj.drawBorder(1, 0);
    }
 this.getMapData = function(x, y) {
        if (!thisObj.waitingForData) {

            thisObj.waitingForData = true;

            jsonUrl  = '?action=WorldMap&function=getJSONArea&x_min='+ (x - thisObj.maxX -4);

            jsonUrl += '&x_max='+ (x + thisObj.maxX +4);

            jsonUrl += '&y_min='+ (y - thisObj.maxY -4);

            jsonUrl += '&y_max='+ (y + thisObj.maxY +4);

            ajaxRequest(jsonUrl, thisObj.handleMapData);    

        }

    }
 this.handleMapData = function(JSONResponse) {

        

//        console.log('handleMapData');

        

        if (!JSONResponse) return false;



        var responseData = JSON.parse(JSONResponse);

        var mapData = responseData['data'];

        var requestData = responseData['request'];

        

        for (x = requestData['x_min']; x<=requestData['x_max']; x++) {

            for (y = requestData['y_min']; y<=requestData['y_max']; y++) {

                if (!thisObj.islands[x]) {

                    thisObj.islands[x] = new Array();

                }

                if (mapData[x] && mapData[x][y]) {

                    thisObj.islands[x][y] = mapData[x][y];

                } else {

                    thisObj.islands[x][y] = 'ocean';

                }         

            }

        }

        for (var coords in thisObj.tilesToLoad) {

//            console.log('handleMapData'+coords+'#'+ thisObj.tilesToLoad[coords].mapX+':'+ thisObj.tilesToLoad[coords].mapY);

            var testCoords = thisObj.tilesToLoad[coords].mapX +'_'+ thisObj.tilesToLoad[coords].mapY;

            if (thisObj.tilesToLoad[coords].toLoad == true) {

                if (testCoords==coords) {

                    var xy = coords.split('_');

//                    console.log('coord');

                    thisObj.drawPiece(thisObj.tilesToLoad[coords], xy[0], xy[1]);

                } else {

//                    console.log('mapXY');

                    thisObj.drawPiece(thisObj.tilesToLoad[coords],  thisObj.tilesToLoad[coords].mapX,  thisObj.tilesToLoad[coords].mapY);

                }

            }

        }

        thisObj.tilesToLoad = new Array();

        

        thisObj.waitingForData = false;

        //thisObj.drawMap(); 

    }
 this.dragHandle = function(event) { 

        

        // init

        addListener(document, 'onclick', thisObj.dragStop)

        thisObj.dragHandleObj.style.cursor = 'crosshair';



        thisObj.startDragHandlePosX = document.all ? window.event.clientX : event.pageX;

        thisObj.startDragHandlePosY = document.all ? window.event.clientY : event.pageY;



        if (typeof(event)!="undefined"){

            if (event.preventDefault) {

               event.preventDefault();

            }

            event.returnValue = false;

        }





        // drag&drop

        document.onmousemove = function(ev) {

            

            // drag&drop init

            if (thisObj.action == '') {

            

                thisObj.startPosX = thisObj.startDragHandlePosX;

                thisObj.startPosY = thisObj.startDragHandlePosY;



                if (typeof(event)!="undefined"){

                    if (event.preventDefault) {

                       event.preventDefault();

                    }

                    event.returnValue = false;

                }

                

                thisObj.startDragY = (parseInt(thisObj.scrollDiv[0].style.top))?parseInt(thisObj.scrollDiv[0].style.top):0;

                thisObj.startDragX = (parseInt(thisObj.scrollDiv[0].style.left))?parseInt(thisObj.scrollDiv[0].style.left):0;

                

                //console.log('thisObj.startDragXY:' + thisObj.startDragX +':'+thisObj.startDragY);

                

                thisObj.startMapX = thisObj.currMapX;

                thisObj.startMapY = thisObj.currMapY;

            

                thisObj.action = 'dragHandle';

            }



            

            

            // verschiebung auslesen

            thisObj.posX = document.all ? window.event.clientX : ev.pageX;

            thisObj.posY = document.all ? window.event.clientY : ev.pageY;

            if (typeof(event)!="undefined"){

                if (event.preventDefault) {

                   event.preventDefault();

                }

                event.returnValue = false;

            }

            

            // verschieben

            thisObj.setPosition();

             

            /* */

            // neue Inseln an Rand anfuegen  

            var diffX = (thisObj.posX  - thisObj.startPosX + thisObj.startDragX); // verschiebung seit dem Draw

            var diffY = (thisObj.posY  - thisObj.startPosY + thisObj.startDragY); // verschiebung seit dem Draw

            //console.log('diffX:diffY:' + diffX +':'+ diffY);

            //dx = -Math.round( (diffX/2 + diffY)/120 );

            //dy =  Math.round( (diffX/2 - diffY)/120 );

            

            dx = thisObj.dx;

            dy = thisObj.dy;

                        

            dyy = dy;

            dxx = dx;

            

            //console.log( thisObj.currMapX - thisObj.lastDiffX/240 - thisObj.lastDiffY/120);





      

            if ( (diffX/2 + diffY) > thisObj.lastDiffX+120 ) {

                thisObj.drawBorder(1, 0);

            } 

            if ( (diffX/2 + diffY ) < thisObj.lastDiffX-120 ) {

                thisObj.drawBorder(-1, 0);

            }  

            if ( (diffX/2 - diffY) > thisObj.lastDiffY+120 ) {

                thisObj.drawBorder(0, 1);

            } 

            if ( (diffX/2 - diffY) < thisObj.lastDiffY-120 ) {

                thisObj.drawBorder(0, -1);

            }    





            if (typeof(obj) != 'undefined') {

                //console.log(obj.style.left);

            }
};}, 
 this.setPosition = function() {
 var dx = (thisObj.posX  - (thisObj.startPosX-thisObj.startDragX));

            var dy = (thisObj.posY - (thisObj.startPosY-thisObj.startDragY));

            

            document.navInputForm.xcoord.value = thisObj.currMapX - Math.round(dy/120+dx/240);

            document.navInputForm.ycoord.value = thisObj.currMapY - Math.round(dy/120-dx/240);

            

            //console.log(dy, '###', dy);

            

            thisObj.scrollDiv[0].style.left = dx + 'px';

            thisObj.scrollDiv[0].style.top =  dy + 'px';

            thisObj.scrollDiv[1].style.left = dx + 'px';

            thisObj.scrollDiv[1].style.top =  dy + 'px';

    }
 this.dragStop = function(ev) {

        document.onmousemove = '';

        

        if (thisObj.action == 'dragHandle') {

            setTimeout(function() {thisObj.action = ''}, 100);

        }

        thisObj.dragHandleObj.style.cursor = 'move';

        

    },
 this.jumpToCoord = function() {

        var x = document.navInputForm.xcoord.value;

        var y = document.navInputForm.ycoord.value;

        

        thisObj.jumpToXY(x, y);

    }
 this.jumpToShortcut = function() {

        var text = document.navShortcutForm.homeCitySelect.value;  

        var trennzeichenPos = text.indexOf(':');

        var x = parseInt(text.substring(0, trennzeichenPos), 10);

        var y = parseInt(text.substring(trennzeichenPos+1, text.length), 10);

        

        thisObj.jumpToXY(x, y);

    }
 this.jumpToXY = function(x, y) {

        thisObj.currMapX = parseInt(x);

        thisObj.currMapY = parseInt(y);



        thisObj.initCoords();

        thisObj.drawMap();

        thisObj.setPosition();

        //thisObj.markIsland(x, y);

    }
 this.getOceanClass = function(x, y) {

        var klasse = 'ocean1';

        if( (Math.abs((x+y*3)%4)) ==0) klasse = 'ocean2';

        if( (Math.abs((x+y*4)%5)) ==0) klasse = 'ocean3';

        if( (Math.abs((x+y*5)%12))==0) klasse = 'ocean_feature1';

        if( (Math.abs((x+y*6)%13))==0) klasse = 'ocean_feature2';

        if( (Math.abs((x+y*7)%12))==0) klasse = 'ocean_feature3';

        if( (Math.abs((x+y*8)%13))==0) klasse = 'ocean_feature4';

        return klasse;

    }
 this.getXYFromEvent = function(event) {

        posX = document.all ? window.event.clientX : event.pageX;

        posY = document.all ? window.event.clientY : event.pageY;

        return [posX, posY];

    }
 this.centerIsland = function(x, y) {

        thisObj.jumpToXY(x, y); 

    }
 this.markIsland = function(objId) {

        obj = document.getElementById(objId);

        var x = obj.mapX;

        var y = obj.mapY;

        

        var linkId = 'link_'+objId;

        objLink = document.getElementById(linkId);

        objLink.className = '';         





        //var id = 'magnify_'+ x +'_'+ y ;

        var id = objId.replace('tile', 'magnify');

        if (thisObj.magnifiedIslandObj) {

            if (thisObj.magnifiedIslandObj.id == id) { // klick 2 auf Objekt

            } else { // klick auf anderes Objekt

                thisObj.magnifiedIslandObj.className = '';

                thisObj.markedIslandObj.className = '';



                var oldLinkId = 'link_'+ thisObj.magnifiedIslandObj.id.replace('magnify', 'tile');

//                console.log(oldLinkId);

                objOldLink = document.getElementById(oldLinkId);

                objOldLink.className = '';         

            }

        }

        //console.log(x+'###'+y);

        idMarking = objId.replace('tile', 'marking');

        if (document.getElementById(id)) {

            thisObj.magnifiedIslandObj = document.getElementById(id);

            

            thisObj.markedIslandObj = document.getElementById(idMarking);

            thisObj.markedIslandObj.className = 'islandMarked';

            thisObj.markedIslandXY  = [x, y]; 

            

            objLink.className = 'islandLinkMarked';         

        }

        

        // Inseldaten in Seite schreiben

        // Breadcrumbs

        isl = thisObj.islands[x][y];

        var text = isl[1] +' ['+ x +':'+ y +']';

        

        document.getElementById('islandBread').innerHTML = '<a title="'+ mapText['markedislandlink'] +'" class="island" onclick="map.centerIsland('+ x +', '+ y +');" href="#">'+ text +'</a>';

        // Info

        document.getElementById('islandName').innerHTML =  thisObj.islands[x][y][1];



        //document.getElementById('islandActions').className = 'nohidden';

        document.getElementById('islandInfos').className = 'nohidden';

        document.getElementById('tradegoodLabel').innerHTML = '<a href="/action.php?view=informations&articleId=10013&mainId=10013">'+tradegoodText[isl[2]]+ '</a>';

        document.getElementById('wonderLabel').innerHTML = '<a href="/action.php?view=wonderDetail&wonderId='+isl[3]+'">'+wonderText[isl[3]]+'</a';

        var button1 = Dom.get('islandAddButton');

        var button2 = Dom.get('islandRemoveButton');

       

        if(shortcuts[x] != undefined && shortcuts[x][y] != 'undefined' && (shortcuts[x][y] == 1 || shortcuts[x][y] == 3)) {

            button1.style.display = 'none';

            button2.href="?action=WorldMap&function=removeIslandFromShortcut&islandX="+x+"&islandY="+y+"&actionRequest=<?php $session->checker;?>";

            button2.style.display = 'inline';

        } else if(shortcuts[x] != undefined && shortcuts[x][y] != 'undefined' && shortcuts[x][y] == 2) {

            button1.style.display = 'none';

            button2.style.display = 'none';

        } else {

            button1.style.display = 'inline';

            button1.onclick = function() { showIslandAddDialog(isl[0], x, y, thisObj.islands[x][y][1]); };

            button2.href="#";

            button2.style.display = 'none';

        }

    }
 this.clickIsland = function(objId) {

        if (thisObj.action == '') {

            obj = document.getElementById(objId);

            var x = obj.mapX;

            var y = obj.mapY;

            var id = objId.replace('tile', 'magnify');

            

//            console.log('clickIsland: '+ id);

            if (thisObj.magnifiedIslandObj) {

                if (thisObj.magnifiedIslandObj.id == id) { // klick 2 auf Objekt

                    window.location.href = '?view=island&id=' + thisObj.islands[x][y][0];

                    return true;

                } else { // klick auf anderes Objekt

                }

            } else {

                thisObj.magnifiedIslandObj = document.getElementById(id);

            }

            thisObj.markIsland(objId);

        }

    }
 this.getIslandData = function(x, y) {

        if (!thisObj.waitingForIslandData) {

            thisObj.waitingForIslandData = true;

            jsonUrl  = '?action=WorldMap&function=getJSONIsland&x='+ x;

            jsonUrl += '&y='+ y;

            ajaxRequest(jsonUrl, thisObj.handleIslandData);    

        }

    }
 this.handleIslandData = function(JSONResponse) {
  var responseData = JSON.parse(JSONResponse);
  document.getElementById('information').innerHTML = '';

        for (var i in responseData['data']) {

            document.getElementById('information').innerHTML += responseData['data'][i]['name'] + '('+ responseData['data'][i]['avatar_name']+')' +'<br />';

        }

        thisObj.waitingForIslandData = false;

    }
 this.getXYOffset = function(obj) {

        var xy = [0, 0];

        do {

            xy[0] += obj.offsetLeft;

            xy[1] += obj.offsetTop;

            obj = obj.parentNode;

        }   while(obj.parentNode) 

//        console.log('Left: '+ xy)

        return xy;

    }
 thisObj.cityStatus = 1;
 this.switchCities = function() {

        thisObj.cityStatus= (thisObj.cityStatus+1)%2;

        if(thisObj.cityStatus==0) document.getElementById('buttonCities').className='deactivated';

        else document.getElementById('buttonCities').className='';

        for (var j=0;j<=thisObj.maxX;j++){

            for (var i=0;i<=thisObj.maxY;i++){

                cities= document.getElementById('cities_'+i+'_'+j);

                cities.style.visibility = (thisObj.cityStatus) ? 'visible':'hidden';

            }

        }   

    }
 thisObj.tradegoodStatus = 1;
 this.switchTradegood = function() {
        thisObj.tradegoodStatus= (thisObj.tradegoodStatus+1)%2;
        if(thisObj.tradegoodStatus==0) document.getElementById('buttonTradegood').className='deactivated';

        else document.getElementById('buttonTradegood').className='';

        for (var j=0;j<=thisObj.maxX;j++){

            for (var i=0;i<=thisObj.maxY;i++){

                tradegood= document.getElementById('tradegood_'+i+'_'+j);

                tradegood.style.visibility = (thisObj.tradegoodStatus) ? 'visible':'hidden';

            }

        }   

    }

 // drag and drop
    addListener(thisObj.dragHandleObj, 'mousedown', thisObj.dragHandle);
    addListener(document.getElementById('linkMap'), 'mousedown', thisObj.dragHandle);
    //addListener(thisObj.dragHandleObj, 'mouseout', thisObj.dragStop);
    addListener(document, 'mouseup', thisObj.dragStop)
    thisObj.initCoords();
}

 function showIslandAddDialog(islandId, islandX, islandY, islandName) {

    var box = Dom.get('annotationBox');

    box.style.display='block';

    var closeButton = box.firstChild;

    var header = Dom.get('annotationHeader');

    header.innerHTML = "إضافة الجزيرة إلى قائمة الاختصارات: "+islandName;

    var content = Dom.get('annotationText');

    //content.innerHTML = "Insel Anfügen und so";

    document.addIslandForm.islandX.value = islandX;

    document.addIslandForm.islandY.value = islandY;

    document.addIslandForm.label.value = islandName;

}
</script>
<script type="text/javascript">
Event.onDOMReady( function() {
 replaceSelect(Dom.get("homeCitySelect"));
});
</script>
<style type="text/css">
#worldmap_iso #container #mapShortcutInput {background-image:url(img/bg_mapnav_coord.jpg);background-repeat:repeat;height:28px;padding-top:3px;position:relative;padding-left:18px;}
.citySpecialSelect .dropbutton {background-position: 0px -25px; padding-left:8px; height:25px; line-height:25px; cursor:default;}
</style>
  <div id="breadcrumbs">
   <h3>أنت هنا:</h3>
   <span id="worldBread" class="world">عالم</span>
   <div id="islandBread" class="island"></div>
  </div>
  <div id="navigation" class="dynamic" style="z-index:10000">
   <h3 class="header">إبحار</h3>
   <div class="content">
    <form name="navInputForm" action="javaScript:void(null);" onSubmit="map.jumpToCoord();">
     <div id="mapCoordInput"style="position:relative;">
     <label for="inputXCoord" class="x">X:</label>
     <input class="x" id="inputXCoord" type="text" name="xcoord"  maxlength=4 value="77" />
     <label for="inputYCoord" class="y">Y:</label>
     <input class="y" id="inputYCoord" type="text" name="ycoord"  maxlength=4 value="47" />
     <input class="submitButton" type="image" src="img/blank.gif" name="submit" />
    </div>
    </form>
    <div id="mapControls"  style="position:relative;">
     <ul class="visibility">
     <li><a href="#" onClick='map.switchTradegood();' id="buttonTradegood"></a></li>
     <li><a href="#" onClick='map.switchCities();' id="buttonCities"></a></li>
     </ul>
     <ul class="scrolling">
     <li class="nw"><a href="#" onClick="map.moveBy(-1,-1); return false;"></a></li>
     <li class="n"><a href="#" onClick="map.moveBy(0,-1); return false;"></a></li>
     <li class="ne"><a href="#" onClick="map.moveBy(1,-1); return false;"></a></li>
     <li class="w"><a href="#" onClick="map.moveBy(-1,0); return false;"></a></li>
     <li class="e"><a href="#" onClick="map.moveBy(1,0); return false;"></a> </li>
     <li class="sw"><a href="#" onClick="map.moveBy(-1,1); return false;"></a></li>
     <li class="s"><a href="#" onClick="map.moveBy(0,1); return false;"></a></li>
     <li class="se"><a href="#" onClick="map.moveBy(1,1); return false;"></a></li>
     </ul>
    </div>
    <form name="navShortcutForm" action="javaScript:void(null);" onSubmit="map.jumpToShortcut();">
     <div id="mapShortcutInput"  style="position:relative;" title="قائمة الاختصارات-للجزيرة">
      <select id="homeCitySelect"class="citySpecialSelect smallFont"name="newHomeCity" tabindex="1" onChange="map.jumpToShortcut();">
      <option value="78:48" >[78:48] ޒ Juma ޒ</option>
      <option value="77:47"  selected="selected">[77:47] ޒ kilea ޒ</option>
      </select>
     </div>
    </form>
   </div>
   <div class="footer"></div>
  </div>
  <div id="information" class="dynamic">
   <h3 id="islandName" class="header">معلومات</h3>
   <div class="content">
    <table id="islandInfos">
    <tr><th>سلعة:</th><td id="tradegoodLabel" class=label></td></tr>
    <tr><th>مكافأة:</th><td id="wonderLabel"  class="label"></td></tr>
    </table>
    <div class="centerButton">
     <p><a class="button" id="islandAddButton" href="#" title="إضافة الجزيرة إلى قائمة الاختصارات">إضافة اختصار</a>
     <a class="button" id="islandRemoveButton" href="#"  title="حذف هذه الجزيرة من قائمة الاختصارات">حذف الاختصارات</a></p>
    </div>
   </div>
   <div class="footer"></div>
  </div>
  <div id="mainview" style="overflow:visible;z-index:30">
   <div id="annotationBox" style="display:none;">
   <div class="close" onClick="this.parentNode.style.display='none'"></div>
   <h3 class="header" id="annotationHeader"></h3>
   <div class="content" style="padding:10px;" id="annotationText">
    <form name="addIslandForm" action="action.php" method="POST">
     <input type="hidden" name="action" value="WorldMap" /> 
     <input type="hidden" name="function" value="addIslandToShortcut" />
     <input type="hidden" name="actionRequest" value="d5d28c6fbc939350dfbb82a57421511c" />
     <input type="hidden" name="islandX" value="1" />
     <input type="hidden" name="islandY" value="1" />
     <p>يمكن لكل جزيرة أن تمنح في قائمة الاختصارات نصاً يصفها لا يتعدى عدد حروفه 15.</p>
     <div class="centerButton">نص:
      <input type="text" name="label" value="inselname"  maxlength="15"></div> 
     <div class="centerButton"><a class="button" onClick="document.addIslandForm.submit();" href="#">إضافة جزيرة</a></div>
    </form>
   </div>
   <div class="footer"></div>
  </div>
  <div id="scrollcover" style="overflow: hidden ;background-image:url(img/world/bg_ocean01.gif);z-index:35">
   <div id="worldmap" style="overflow:visible;position:absolute;z-index:40;left:240px;top:-300px;">
    <div id="map1" style="position:absolute;z-index:50;cursor:move;">
     <?php 
	  for($i=0; $i<10; $i++){
	   $c = 0;
	   for($j=0; $j<10; $j++){
	 ?><div align='center' alt=''  valign='middle' id='tile_<?php echo $j;?>_<?php echo $i;?>'class = "ocean1"style='z-index:100;position:absolute; width:240px; height:120px; left:<?php echo 120*$j;?>px; top:<?php echo $c;?>px;'><div id='wonder_<?php echo $j;?>_<?php echo $i;?>' ></div><div id='tradegood_<?php echo $j;?>_<?php echo $i;?>' ></div><div id='cities_<?php echo $j;?>_<?php echo $i;?>'></div><div id='marking_<?php echo $j;?>_<?php echo $i;?>'></div><div></div><div id='magnify_<?php echo $j;?>_<?php echo $i;?>'></div></div><?php $c += 60;}}?></div> 
    <div class="linkMapContainer" style="z-index:10000;position:absolute;left:240px;">
     <div id="linkMap" style="position:absolute;z-index:10000;">
      <?php 
	  for($i=0; $i<10; $i++){
	   $c = 0;
	   for($j=0; $j<10; $j++){
	 ?><div id="link_tile_<?php echo $j;?>_<?php echo $i;?>" style="z-index:10000;position:absolute;left:<?php echo 120*$j;?>px;top:<?php echo $c;?>px;"></div><?php $c += 60;}}?></div>
    </div>
    <div id="dragHandlerOverlay" style="cursor:move;position:absolute;z-index:1000;margin-right:-500px;margin-top:240px;width:800px;height:600px;background-image:url(img/blank.gif);">
    </div>
   </div>
  </div>
  </div><!-- END mainview -->
<script>
var map = new Map(<?php echo $_GET['islandX'];?>,<?php echo $_GET['islandY'];?>);
map.handleMapData(<?php $island->getJSONArea($_GET);?>);
map.drawMap();
</script>
<?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>