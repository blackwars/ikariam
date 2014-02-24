<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");

?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<body id="cityMilitary-army" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariama</h1>
    <h2>عش في العصور القديمة!</h2>
   </div>
   <div id="avatarNotes"></div>
   <div id="breadcrumbs">
    <h3>أنت هنا:</h3>
    <a href="?view=worldmap_iso&amp;islandX=<?php echo $city->x;?>&amp;islandY=<?php echo $city->y;?>" title="عودة إلى خارطة العالم"><img src="img/resource/icon-world.gif" alt="عالم" /></a><span>&nbsp;&gt;&nbsp;</span>
    <a href="?view=island&amp;id=<?php echo $city->iid;?>" title="عودة إلى الجزيرة"><img src="img/resource/icon-island.gif" alt="<?php echo $island->name?>" /><?php echo $island->name?>[<?php echo $city->x;?>:<?php echo $city->y;?>]</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="?view=city&amp;id=<?php echo $city->cid;?>" class="city" title="عودة إلى المدينة"><?php echo $city->cname;?></a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="building">النظرة العامة للجيش</span>
   </div>
   <div id="backTo" class="dynamic">
    <h3 class="header">عودة إلى المدينة</h3>
    <div class="content">
        <a href="?view=city&id=<?php echo $city->cid;?>" title="عودة إلى المدينة">
        <img src="img/action_back.gif" width="160" height="100" alt="" />
        <span class="textLabel">&lt;&lt; عودة إلى المدينة</span></a>
    </div>
    <div class="footer"></div>
   </div>
   <div id="mainview">
    <div class="buildingDescription">
     <h1>القوات في المدينة</h1>
     <p>اطلع على القوات المتمركزة في هذه المدينة</p>
    </div>
    <div class="militaryAdvisorTabs">
     <table cellpadding="0" cellspacing="0" id="tabz">
      <tr><td><a title="وحدات" href="?view=cityMilitary-army&id=<?php echo $city->cid;?>"><em>وحدات</em></a></td>
      <td class="selected"><a title="سفن" href="?view=cityMilitary-fleet&id=<?php echo $city->cid;?>"><em>سفن</em></a></td>
      </tr>
     </table>
    </div>
    <div class="yui-navset yui-navset-top" id="demo">
     <div class="yui-content">
      <div class="contentBox01h">
       <h3 class="header"><span class="textLabel">موقع عسكري</span></h3>
       <div class="content">
        <table cellpadding="0" cellspacing="0">
         <tr>
         <th title="سفينة مزودة بقوة دفع"><img src="img/characters/fleet/60x60/ship_ram_faceright.gif" alt="سفينة مزودة بقوة دفع" /></th>
         <th title="سفينة اللهب"><img src="img/characters/fleet/60x60/ship_flamethrower_faceright.gif" alt="سفينة اللهب" /></th>
         <th title="جارفة آلية ضخمة"><img src="img/characters/fleet/60x60/ship_steamboat_faceright.gif" alt="جارفة آلية ضخمة" /></th>
         <th title="سفينة حاملة لسلاح المرجام"><img src="img/characters/fleet/60x60/ship_ballista_faceright.gif" alt="سفينة حاملة لسلاح المرجام" /></th>
         </tr>
         <tr class="count">
         <td><?php echo $ships->GetShipsNbr("210");?></td>
         <td><?php if($ships->IsShipBuildingAvailable(211))echo $ships->GetShipsNbr("211");else echo "-";?></td>
         <td><?php if($ships->IsShipBuildingAvailable(216))echo $ships->GetShipsNbr("216");else echo "-";?></td>
         <td><?php if($ships->IsShipBuildingAvailable(213))echo $ships->GetShipsNbr("213");else echo "-";?></td></tr>
        </table>
        <table cellpadding="0" cellspacing="0">
         <tr>
         <th title="سفينة مزودة بمنجنيق"><img src="img/characters/fleet/60x60/ship_catapult_faceright.gif" alt="سفينة مزودة بمنجنيق" /></th>
         <th title="سفينة هاون"><img src="img/characters/fleet/60x60/ship_mortar_faceright.gif" alt="سفينة هاون" /></th>
         <th title="غواصة"><img src="img/characters/fleet/60x60/ship_submarine_faceright.gif" alt="غواصة" /></th>
         </tr>
         <tr class="count">
          <td><?php if($ships->IsShipBuildingAvailable(214))echo $ships->GetShipsNbr("214");else echo "-";?></td>
          <td><?php if($ships->IsShipBuildingAvailable(212))echo $ships->GetShipsNbr("212");else echo "-";?></td>
          <td><?php if($ships->IsShipBuildingAvailable(215))echo $ships->GetShipsNbr("215");else echo "-";?></td></tr>
         </table>
        </div>
       <div class="footer"></div>
      </div>
      <div class="contentBox01h">
       <h3 class="header"><span class="textLabel">مدافعون</span></h3>
       <div class="content">
        <p style="text-align: center;">لا توجد هناك وحدات متحالفة مُتمركزة في هذه المدينة!</p>
       </div>
       <div class="footer"></div>
      </div>
      <div class="contentBox01h">
       <h3 class="header"><span class="textLabel">محتل</span></h3>
       <div class="content">
        <p style="text-align: center;">لا تتمركز في المدينة وحدات لقوة احتلال معادية.</p>
       </div>
       <div class="footer"></div>
      </div>
     </div>
    </div>
   </div>
<script type="text/javascript">
var tabView = new YAHOO.widget.TabView('demo');
</script>


<?php include("citynavigator.php");?>
<!-- Page footer  -->
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>
