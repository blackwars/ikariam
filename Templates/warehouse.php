<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$building = new CBuilding;
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/warehouse.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<?php 
$whl = $city->GetWarehousesLevelSum();
$secure = $whl*480;
$capacity = $whl*32000 + 1500;
$iwood=$city->awood-$whl*480;
$iwood>0?$iwood:$iwood=0;
$iwine=$city->awine-$whl*480;
$iwine>0?$iwine:$iwine=0;
$imarble=$city->amarble-$whl*480;
$imarble>0?$imarble:$imarble=0;
$icrystal=$city->acrystal-$whl*480;
$icrystal>0?$icrystal:$icrystal=0;
$isulfur=$city->asulfur-$whl*480;
$isulfur>0?$isulfur:$isulfur=0;
?>
<body id="warehouse" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariam</h1>
    <h2>عش في العصور القديمة!</h2>
   </div>
   <div id="avatarNotes"></div>
   <div id="breadcrumbs">
    <h3>أنت هنا:</h3>
    <a href="?view=worldmap_iso&amp;islandX=<?php echo $city->x;?>&amp;islandY=<?php echo $city->y;?>" title="عودة إلى خارطة العالم">
    <img src="img/resource/icon-world.gif" alt="عالم" />
    </a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="?view=island&amp;id=<?php echo $city->iid;?>" title="عودة إلى الجزيرة">
    <img src="img/resource/icon-island.gif" alt="<?php echo $island->name?>" /><?php echo $island->name?>[<?php echo $city->x;?>:<?php echo $city->y;?>]</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="?view=city&amp;id=<?php echo $city->cid;?>" class="city" title="عودة إلى المدينة"><?php echo $city->cname;?></a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="building">منزل التخزين</span>
   </div>
   <div id="buildingUpgrade" class="dynamic">
    <h3 class="header">تطوير <a class="help" href="?view=buildingDetail&buildingId=4" title="مساعدة"><span class="textLabel">هل تحتاج لمساعدة؟</span></a></h3>
    <div class="content">
     <div class="buildingLevel">
      <span class="textLabel">مستوى </span>
	  <?php echo $building->currentLevel;?>
     </div>
<?php if($building->currentLevel<18){?>
     <h4>ضروري للمستوى <?php echo $building->getBuildingNextLevel($_GET["position"]);?>:</h4>
     <ul class="resources">
     <?php if($building->nextLevelRes["wood"] != 0){?>
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية: </span><?php echo number_format($building->nextLevelRes["wood"]);?>
      </li>
      <?php }if($building->nextLevelRes["marble"] != 0){?>
      	  <li class="marble alt" title="رخام"><span class="textLabel">رخام: </span><?php echo number_format($building->nextLevelRes["marble"]);?>
      </li>
      <?php }?>
      <li class="time" title="وقت البناء"><span class="textLabel">وقت البناء: </span>
	  <?php 
	  $time = $generator->getTimeFormat($building->nextLevelRes["time"]);
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
      </ul>
     <ul class="actions">
      <li class="upgrade">
  <?php if(($building->currentLevel<18)&&$building->canBuild()&&$building->checkResource(6,$building->currentLevel+1)){?>  
      <a href="?action=CityScreen&function=upgradeBuilding&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"]?>&level=<?php echo $building->currentLevel;?>&actionRequest=<?php echo $session->checker;?>" title="في لائحة البناء!">
      <span class="textLabel">تحسين</span>
      </a>
  <?php  }else{?>
       <a class="disabled" href="#" title="إكمال الإنشاء غير ممكن حالياً"></a>
  <?php  }?>
      </li>
      <li class="downgrade">
  <?php  if(($building->currentLevel > 1)&& !$building->AmIUpgrading($_GET["position"])){?>
      <a href="?view=buildings_demolition&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"]?>&actionRequest=<?php echo $session->checker;?>" title="تدمير المبنى"><span class="textLabel">تدمير</span>
      </a>
  <?php }else{?>
      <a class="disabled" href="#" title="التدمير غير ممكن حالياً!"></a>
   <?php }?>
      </li>
      </ul><?php }?> 
    </div>
    <div class="footer"></div>
   </div>
   <div id="information" class="dynamic">
    <h3 class="header">المزيد من الأمن ضد السرقة</h3>
    <div class="content">
     <img src="img/premium/safecapacity.gif" />
     <p>بعض المداخل الخفية هنا وبعض الجدران المقواة هناك، وستحصل على 100% من الأمن من السرقة!</p>
     <div class="centerButton">
      <a href="?view=premium" class="button">أنظر الآن</a>
     </div>
    </div>
    <div class="footer"></div>
   </div>
   <div id="information" class="dynamic">
    <h3 class="header">في مستوى 5</h3>
    <div class="content">
     <table class="safeinnextlevel">
     <tr><th>مادة أولية</th><th>بأمان</th><th>السعة</th></tr>
     <tr><td class="resource"><img src="img/resource/icon_wood.gif" title="مادة البناء" alt="مادة البناء" /></td><td class="amount">+480</td><td class="amount">+32,000</td></tr><tr><td class="resource"><img src="img/resource/icon_wine.gif" title="مشروب العنب" alt="مشروب العنب" /></td><td class="amount">+480</td><td class="amount">+32,000</td></tr><tr><td class="resource"><img src="img/resource/icon_marble.gif" title="رخام" alt="رخام" /></td><td class="amount">+480</td><td class="amount">+32,000</td></tr><tr><td class="resource"><img src="img/resource/icon_glass.gif" title="بلور" alt="بلور" /></td><td class="amount">+480</td><td class="amount">+32,000</td></tr><tr><td class="resource"><img src="img/resource/icon_sulfur.gif" title="كبريت" alt="كبريت" /></td><td class="amount">+480</td><td class="amount">+32,000</td></tr></table>
    </div>
    <div class="footer"></div>
   </div>
   <div id="mainview">
    <div class="buildingDescription">
     <h1>منزل التخزين</h1>
<?php if($building->AmIUpgrading($_GET["position"])){?> 
 <div id="upgradeInProgress">
  <div class="buildingLevel">
   <span class="textLabel">مستوى </span>
   <?php echo $building->currentLevel;?>
  </div>
  <div class="nextLevel">
   <span class="textLabel">المستوى التالي </span>
   <?php echo $building->currentLevel+1;?>
  </div>
  <div class="isUpgrading">جاري إكمال الإنشاء</div>
  <div class="progressBar">
   <div class="bar" id="upgradeProgress" title="<?php echo $building->GetBUpPercent2Finish();?>%" style="width:<?php echo $building->GetBUpPercent2Finish();?>%;">
   </div>
  </div>
  <a class="cancelUpgrade" href="?view=buildings_demolition&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>&actionRequest=<?php echo $session->checker;?>" title="إلغاء"><span class="textLabel">إلغاء</span>
  </a>
  <script type="text/javascript">
  Event.onDOMReady(function() {
   var tmppbar = getProgressBar({
   startdate: <?php echo $building->GetBUpgradingStartTime();?>,
   enddate: <?php echo $building->GetBUpgradingTime();?>,
   currentdate: <?php echo time();?>,
   bar: "upgradeProgress"});
   tmppbar.subscribe("update", function(){
    this.barEl.title=this.progress+"%";});
   tmppbar.subscribe("finished", function(){
    this.barEl.title="100%";});
	});
   </script>
   <div class="time" id="upgradeCountDown">
    <?php $time = $generator->getTimeFormat($building->GetBUpgradingTime()-time());
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
   </div>
   <script type="text/javascript">
   Event.onDOMReady(function() {
    var tmpCnt = getCountdown({
	 enddate: <?php echo $building->GetBUpgradingTime();?>,
	 currentdate: <?php echo time();?>,
	 el: "upgradeCountDown"}, 2, " ", "", true, true);
	 tmpCnt.subscribe("finished", function() {
	 setTimeout(function() {
	  location.href="?view=warehouse&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>";
	 },2000);
	 });
	});
   </script>
 </div>
<?php }?>
     <p>يمكنك خزن جزء من المواد الأولية التابعة لك في منزل التخزين، محمية من النهب كما من المطر والطيور والحشرات. سيكون المسؤول عن المخزن دائماً على اطلاع على كمية مخزونك. 

إذا قمت بتطوير وتوسيع منزل التخزين فإنك ستتمكن من حماية المزيد من الموارد.</p>
    </div>
    <div class="contentBox01h">
     <h3 class="header"><span class="textLabel">البضائع في منزل التخزين</span></h3>
     <div class="content">
      <p style="padding-top:10px;padding-left:18px;padding-right:10px;padding-bottom:0px;"></p>
      <table class="table01">
      <thead>
      <tr><th>آمن من السرقة</th><th>صالح للنهب</th><th>المجموع</th> <th>السعة</th></tr>
      </thead>
      <tbody>
      <tr>
      <td class="sicher">
       <table cellpadding="0" cellspacing="0">
       <tr><td>
        <img src="img/resource/icon_wood.gif" title="مادة البناء" alt="مادة البناء" /></td>
        <td><span class="secure"><?php echo number_format($secure);?></span></td></tr>
       <tr><td>
        <img src="img/resource/icon_wine.gif" title="مشروب العنب" alt="مشروب العنب" /></td>
        <td><span class="secure"><?php echo number_format($secure);?></span></td></tr>
       <tr><td>
        <img src="img/resource/icon_marble.gif" title="رخام" alt="رخام" /></td>
        <td><span class="secure"><?php echo number_format($secure);?></span></td></tr>
       <tr><td>
        <img src="img/resource/icon_glass.gif" title="بلور" alt="بلور" /></td>
        <td><span class="secure"><?php echo number_format($secure);?></span></td></tr>
       <tr><td>
        <img src="img/resource/icon_sulfur.gif" title="كبريت" alt="كبريت" /></td>
        <td><span class="secure"><?php echo number_format($secure);?></span></td></tr>
       </table>
      </td>
      <td class="klaubar">
       <table cellpadding="0" cellspacing="0">
       <tr><td><img src="img/resource/icon_wood.gif" title="مادة البناء" alt="مادة البناء" /></td>
       <td><span class="insecure"><?php echo number_format($iwood);?></span></td></tr>
       <tr><td><img src="img/resource/icon_wine.gif" title="مشروب العنب" alt="مشروب العنب" /></td>
       <td><span class="insecure"><?php ;echo number_format($iwood);?></span></td></tr>
       <tr><td><img src="img/resource/icon_marble.gif" title="رخام" alt="رخام" /></td>
       <td><span class="insecure"><?php echo number_format($iwood);?></span></td></tr>
       <tr><td><img src="img/resource/icon_glass.gif" title="بلور" alt="بلور" /></td>
       <td><span class="insecure"><?php echo number_format($iwood);?></span></td></tr>
       <tr><td><img src="img/resource/icon_sulfur.gif" title="كبريت" alt="كبريت" /></td>
       <td><span class="insecure"><?php echo number_format($iwood);?></span></td></tr>
       </table>
      </td>
      <td class="gesamt">
       <table cellpadding="0" cellspacing="0">
       <tr><td><img src="img/resource/icon_wood.gif" title="مادة البناء" alt="مادة البناء" /></td>
       <td><?php echo number_format($city->awood);?></td></tr>
       <tr><td><img src="img/resource/icon_wine.gif" title="مشروب العنب" alt="مشروب العنب" /></td>
       <td><?php echo number_format($city->awine);?></td></tr>
       <tr><td><img src="img/resource/icon_marble.gif" title="رخام" alt="رخام" /></td>
       <td><?php echo number_format($city->amarble);?></td></tr>
       <tr><td><img src="img/resource/icon_glass.gif" title="بلور" alt="بلور" /></td>
       <td><?php echo number_format($city->acrystal);?></td></tr>
       <tr><td><img src="img/resource/icon_sulfur.gif" title="كبريت" alt="كبريت" /></td>
       <td><?php echo number_format($city->asulfur);?></td></tr>
       </table>
      </td>
      <td class="capacity">
       <table cellpadding="0" cellspacing="0">
       <tr><td><img src="img/resource/icon_wood.gif" title="مادة البناء" alt="مادة البناء" /></td>
       <td><?php echo number_format($capacity);?></td></tr>
       <tr><td><img src="img/resource/icon_wine.gif" title="مشروب العنب" alt="مشروب العنب" /></td>
       <td><?php echo number_format($capacity);?></td></tr>
       <tr><td><img src="img/resource/icon_marble.gif" title="رخام" alt="رخام" /></td>
       <td><?php echo number_format($capacity);?></td></tr>
       <tr><td><img src="img/resource/icon_glass.gif" title="بلور" alt="بلور" /></td>
       <td><?php echo number_format($capacity);?></td></tr>
       <tr><td><img src="img/resource/icon_sulfur.gif" title="كبريت" alt="كبريت" /></td>
       <td><?php echo number_format($capacity);?></td></tr>
       </table>
      </td>
      </tr>
      </tbody>
      </table>
     </div>
     <div class="footer"></div>
    </div>
   </div>
<?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>