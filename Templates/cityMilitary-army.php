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
        <th title="محارب مدرع"><img src="img/characters/military/x60_y60/y60_phalanx_faceright.gif" alt="محارب مدرع" title="محارب مدرع" /></th>
        <th title="عملاق بخاري"><img src="img/characters/military/x60_y60/y60_steamgiant_faceright.gif" alt="عملاق بخاري" title="عملاق بخاري" /></th>
        <th title="رامي الرماح"><img src="img/characters/military/x60_y60/y60_spearman_faceright.gif" alt="رامي الرماح" title="رامي الرماح" /></th>
        <th title="مبارز"><img src="img/characters/military/x60_y60/y60_swordsman_faceright.gif" alt="مبارز" title="مبارز" /></th>
        <th title="مقلاع حجارة"><img src="img/characters/military/x60_y60/y60_slinger_faceright.gif" alt="مقلاع حجارة" title="مقلاع حجارة" /></th>
        <th title="رامي السهام"><img src="img/characters/military/x60_y60/y60_archer_faceright.gif" alt="رامي السهام" title="رامي السهام" /></th>
        <th title="قناصة بندقية البارود"><img src="img/characters/military/x60_y60/y60_marksman_faceright.gif" alt="قناصة بندقية البارود" title="قناصة بندقية البارود" /></th>
        </tr>
        <tr class="count">
        <td><?php if($units->IsUnitBuildingAvailable(303))echo $units->GetUnitsNbr("303");else echo "-";?></td>
        <td><?php if($units->IsUnitBuildingAvailable(308))echo $units->GetUnitsNbr("308");else echo "-";?></td>
        <td><?php echo $units->GetUnitsNbr("315");?></td>
        <td><?php if($units->IsUnitBuildingAvailable(302))echo $units->GetUnitsNbr("302");else echo "-";?></td>
        <td><?php echo $units->GetUnitsNbr("301");?></td>
        <td><?php if($units->IsUnitBuildingAvailable(313))echo $units->GetUnitsNbr("313");else echo "-";?></td>
        <td><?php if($units->IsUnitBuildingAvailable(304))echo $units->GetUnitsNbr("304");else echo "-";?></td></tr>
       </table>
       <table cellpadding="0" cellspacing="0">
       <tr>
       <th title="كاسر"><img src="img/characters/military/x60_y60/y60_ram_faceright.gif" alt="كاسر" title="كاسر" /></th>
       <th title="منجنيق"><img src="img/characters/military/x60_y60/y60_catapult_faceright.gif" alt="منجنيق" title="منجنيق" /></th>
       <th title="هاون"><img src="img/characters/military/x60_y60/y60_mortar_faceright.gif" alt="هاون" title="هاون" /></th>
       <th title="طائرة مروحية"><img src="img/characters/military/x60_y60/y60_gyrocopter_faceright.gif" alt="طائرة مروحية" title="طائرة مروحية" /></th>
       <th title="قاصف جوي"><img src="img/characters/military/x60_y60/y60_bombardier_faceright.gif" alt="قاصف جوي" title="قاصف جوي" /></th>
       <th title="طباخ"><img src="img/characters/military/x60_y60/y60_cook_faceright.gif" alt="طباخ" title="طباخ" /></th>
       <th title="طبيب"><img src="img/characters/military/x60_y60/y60_medic_faceright.gif" alt="طبيب" title="طبيب" /></th>
       </tr>
       <tr class="count">
       <td><?php if($units->IsUnitBuildingAvailable(307))echo $units->GetUnitsNbr("307");else echo "-";?></td>
       <td><?php if($units->IsUnitBuildingAvailable(306))echo $units->GetUnitsNbr("306");else echo "-";?></td>
       <td><?php if($units->IsUnitBuildingAvailable(305))echo $units->GetUnitsNbr("305");else echo "-";?></td>
       <td><?php if($units->IsUnitBuildingAvailable(312))echo $units->GetUnitsNbr("312");else echo "-";?></td>
       <td><?php if($units->IsUnitBuildingAvailable(309))echo $units->GetUnitsNbr("309");else echo "-";?></td>
       <td><?php if($units->IsUnitBuildingAvailable(310))echo $units->GetUnitsNbr("310");else echo "-";?></td>
       <td><?php if($units->IsUnitBuildingAvailable(311))echo $units->GetUnitsNbr("311");else echo "-";?></td></tr>
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