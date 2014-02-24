<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$building = new CBuilding;
$session->changeChecker();
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/palace.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<body id="palace" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariam</h1>
    <h2>عش في العصور القديمة!</h2>
   </div>
   <div id="avatarNotes"></div>
   <div id="breadcrumbs">
    <h3>أنت هنا:</h3>
    <a href="?view=worldmap_iso&amp;islandX=<?php echo $island->x;?>&amp;islandY=<?php echo $island->y;?>" title="عودة إلى خارطة العالم"><img src="img/resource/icon-world.gif" alt="عالم" /></a><span>&nbsp;&gt;&nbsp;</span>
    <a href="?view=island&amp;id=<?php echo $city->iid;?>" title="عودة إلى الجزيرة"><img src="img/resource/icon-island.gif" alt="<?php echo $island->name?>" /><?php echo $island->name?>[<?php echo $island->x;?>:<?php echo $island->y;?>]</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="?view=city&amp;id=<?php echo $city->cid;?>" class="city" title="عودة إلى المدينة"><?php echo $city->cname;?></a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="building">قصر</span>
   </div>
   <div id="buildingUpgrade" class="dynamic">
    <h3 class="header">تطوير
    <a class="help" href="?view=buildingDetail&buildingId=8" title="مساعدة">
    <span class="textLabel">هل تحتاج لمساعدة؟</span>
    </a>
    </h3>
    <div class="content">
     <div class="buildingLevel">
      <span class="textLabel">مستوى </span>
      <?php echo $building->currentLevel;?>
     </div><?php if($building->currentLevel<10){?>
     <h4>ضروري للمستوى <?php echo $building->getBuildingNextLevel($_GET["position"]);?>:</h4>
     <ul class="resources">
     <?php if($building->nextLevelRes["wood"] != 0){?>
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية: </span><?php echo number_format($building->nextLevelRes["wood"]);?>
      </li>
      <?php }if($building->nextLevelRes["marble"] != 0){?>
	  <li class="marble alt" title="رخام"><span class="textLabel">رخام: </span><?php echo number_format($building->nextLevelRes["marble"]);?>
      </li>
     <?php }if($building->nextLevelRes["wine"] != 0){?>
	  <li class="wine alt" title="عنب"><span class="textLabel">رخام: </span><?php echo number_format($building->nextLevelRes["wine"]);?>
      </li>
     <?php }if($building->nextLevelRes["crystal"] != 0){?>
	  <li class="crystal alt" title="بلور"><span class="textLabel">رخام: </span><?php echo number_format($building->nextLevelRes["crystal"]);?>
      </li>
     <?php }if($building->nextLevelRes["sulfur"] != 0){?>
	  <li class="sulfur alt" title="كبريت"><span class="textLabel">رخام: </span><?php echo number_format($building->nextLevelRes["sulfur"]);?>
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
  <?php if(($building->currentLevel<10)&&$building->canBuild()&&$building->checkResource(8,$building->currentLevel+1)){?>    
      <a href="?action=CityScreen&function=upgradeBuilding&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"]?>&level=<?php echo $building->currentLevel;?>&actionRequest=<?php echo $session->checker;?>" title="في لائحة البناء!">
      <span class="textLabel">تحسين</span>
      </a>
  <?php }else{?>
      <a class="disabled" href="#" title="إكمال الإنشاء غير ممكن حالياً"></a>
  <?php }?>
      </li>
      <li class="downgrade">
   <?php if(!$building->AmIUpgrading($_GET["position"]) && ($building->currentLevel > 1)){?>   
      <a href="?view=buildings_demolition&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"]?>&actionRequest=<?php echo $session->checker;?>" title="تدمير المبنى"><span class="textLabel">تدمير</span></a>
   <?php }else{?>
      <a class="disabled" href="#" title="التدمير غير ممكن حالياً!"></a>
   <?php }?>
      </li>
      </ul><?php }?>
    </div>
    <div class="footer"></div>
   </div>
   <div id="mainview">
    <div class="buildingDescription">
     <h1>قصر</h1>
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
	  location.href="?view=palace&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>";
	 },2000);
	 });
	});
   </script>
 </div>
<?php }?>  
     <p>تستطيع انطلاقاً من قصرك أن تتحكم في أقدار إمبراطوريتك. كما أنك ستتمتع في القصر بمنظر رائع على البحر.
سيسمح لك كل مستوى إضافي في إنشاء القصر بعاصمتك بتأسيس مستعمرة إضافية.</p>
    </div><!--buildingDescription -->
    <div class="contentBox01h">
     <h3 class="header"><span class="textLabel">مدن امبراطوريتك</span></h3>
     <div class="content">
      <table cellpadding="0" cellspacing="0" class="table01">
      <thead>
      <tr><th class="crown"></th>
      <th>مدينة</th><th>مستوى</th><th>قصر</th><th>جزيرة</th><th>مادة أولية</th></tr></thead>
      <tbody>
<?php 
//echo "(".count($session->cities).")";
for($i=0; $i<count($session->cities); $i++){
$cid = $session->cities[$i];
$cname =  $database->getCityField($cid,"name");
$isCapital = $database->getCityField($cid,"capital");
$darray = $database->getBuildingsLevels($cid);
$clevel =  $darray["b0"];
if($clevel<0){
 $barray = $database->GetCityBuildingOp($cid);
 $clevel=$barray["levelfrom"];
}
$palacelevel = 0;
for($j=1; $j<14; $j++)
 if($darray["b".$j."t"] == 8)
  $palacelevel =  $darray["b".$j];
if($palacelevel<0){
 $barray = $database->GetCityBuildingOp($cid);
 $palacelevel=$barray["levelfrom"];
}
$iid = $database->getCityField($cid,"iid");
$islandNameCoor = $database->getIslandField($iid,"name")
                ." [".$database->getIslandField($iid,"x")
				.":".$database->getIslandField($iid,"y")."]";
$islandResName = $database->getIslandField($iid,"rtype");
$islandResArName = $island->GetIslandTGArType();
?>      
      <tr>
      <td>
      <?php if($isCapital){?> 
       <img src="img/crown.gif" width="20" height="20" alt="عاصمة" title="عاصمة" />
      <?php }?> 
      </td>
      <td><?php echo $cname;?></td>
      <td><?php echo $clevel;?></td>
      <td><?php echo $palacelevel;?></td>
      <td><?php echo $islandNameCoor;?></td>
      <td>
       <img src="img/resource/icon_<?php echo $islandResName;?>.gif"  title="<?php echo $islandResArName;?>" alt="<?php echo $islandResArName;?>" />
      </td>
      </tr>
<?php }?>
      </tbody>
     </table>
    </div><!--content -->
    <div class="footer"></div>
   </div><!-- contentbox01h -->
    <div class="contentBox01h">
     <h3 class="header"><span class="textLabel">المدن المحتلة</span></h3>
     <div class="content">
      <table cellpadding="0" cellspacing="0" class="table01">
       <thead>
       <tr><th class="crown"></th><th>مدينة</th><th>مستوى</th><th>جزيرة</th><th>مادة أولية</th><th>تحرك</th></tr>
       </thead>
       <tbody>
        <tr><td colspan="6">لم تحتل أي مدينة.</td></tr>
       </tbody>
      </table>
     </div><!--content -->
     <div class="footer"></div>
    </div><!-- contentbox01h -->
   </div><!-- end #mainview -->
<?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>