<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$building = new CBuilding;
$session->changeChecker();
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/workshop.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<body id="workshop" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariama</h1>
    <h2>عش في العصور القديمة!</h2>
   </div>
   <div id="avatarNotes"></div>
   <div id="breadcrumbs">
    <h3>أنت هنا:</h3>
    <a href="?view=worldmap_iso&amp;islandX=<?php echo $island->x;?>&amp;islandY=<?php echo $island->y;?>" title="عودة إلى خارطة العالم">
    <img src="img/resource/icon-world.gif" alt="عالم" />
    </a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="?view=island&amp;id=<?php echo $island->iid;?>" title="عودة إلى الجزيرة">
    <img src="img/resource/icon-island.gif" alt="<?php echo $island->name?>" /><?php echo $island->name?>[<?php echo $island->x;?>:<?php echo $island->y;?>]</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="?view=city&amp;id=<?php echo $city->cid;?>" class="city" title="عودة إلى المدينة"><?php echo $city->cname;?></a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="building">مكان عمل المخترعين</span>
   </div>
   <div id="buildingUpgrade" class="dynamic">
    <h3 class="header">تطوير <a class="help" href="?view=buildingDetail&buildingId=19" title="مساعدة"><span class="textLabel">هل تحتاج لمساعدة؟</span></a></h3>
    <div class="content">
     <div class="buildingLevel">
      <span class="textLabel">مستوى </span>
	  <?php echo $building->currentLevel;?>
     </div><?php if($building->currentLevel<18){?>
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
  <?php if(($building->currentLevel<18)&&$building->canBuild()&&$building->checkResource(20,$building->currentLevel+1)){?>  
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
   <div id="mainview">
    <div id="reductionBuilding">
     <div class="buildingDescription">
      <h1>مكان عمل المخترعين</h1>
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
	  location.href="?view=architect&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>";
	 },2000);
	 });
	});
   </script>
 </div>
<?php }?>  
      <p>يسهر أفضل حرفيي ومخترعي المدينة في الورشة على تجهيز جنودنا وسفننا الحربية بالاختراعات الحديثة التي تجعلهم أفضل وتعطيهم قوة ضرب أكبر.
كل مستوى إضافي يسمح لك بتحسينات إضافية للوحدات والسفن.</p>
     </div>
     <div class="yui-navset yui-navset-top" id="demo">
      <ul class="yui-nav"><li class="selected" title="active"><a href="#tab1"><em>وحدات</em></a></li><li><a href="#tab2"><em>سفن</em></a></li></ul>
      <div class="yui-content">
       <div id="tab1" style="display: block;">
        <div class="contentBox01h">
         <h3 class="header"><span class="textLabel">وحدات</span></h3>
         <div class="content">
          <table cellpadding="0" class="units">
<?php for($u=301; $u<316; $u++){?>  
  <?php if($units->IsUnitBuildingAvailable($u)){?>
           <tr><td class="object" title="<?php echo $units->getUnitInfo("$u","name");?>"><img src="img/characters/military/x60_y60/y60_<?php echo $units->GetUnitHTMLClass($u)?>_faceright.gif" /></td><td><table cellpadding="0" cellspacing="0" class="inside" title="تحسين القوة الهجومية"><tr><td><img name="austausch1slinger" onMouseOver="austausch1slinger.src='img/workshop/angriff_bronze_highlight.gif';"onmouseout="austausch1slinger.src='img/workshop/angriff_bronze.gif';"src="img/workshop/angriff_bronze.gif" title="تحسين القوة الهجومية" /></td><td class="res"><ul class="resources"><li class="gold" title="تكاليف: 750 ذهب"><span class="textLabel">ذهب: </span>750</li><li class="glass" title="تكاليف: 500 بلّور"><span class="textLabel">بلّور: </span>500</li><li class="time" title="مدة: 1ساعة"><span class="textLabel">مدة: </span>1ساعة</li></ul></td><td class="upgrade">كرات برونزية<br /><span class="effect">ضرر +1</span><br /><div class="leftButton"><a class="button"href="?action=CityScreen&function=buyUpgrade&actionRequest=<?php echo $session->checker;?>&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>&militaryTypeId=222&unitTypeId=301&upgradeTypeId=1050">تحسين!</a></div></td></tr></table></td><td class="empty"></td><td><table cellpadding="0" class="inside"><tr><td><img name="austausch2slinger"onmouseover="austausch2slinger.src='img/workshop/verteidigung_silber_highlight.gif';"onmouseout="austausch2slinger.src='img/workshop/verteidigung_silber.gif';"src="img/workshop/verteidigung_silber.gif" title="تحسين القوة الدفاعية" /></td><td class="res"><ul class="resources"><li class="gold" title="تكاليف: 1,500 ذهب"><span class="textLabel">ذهب: </span>1,500</li><li class="glass" title="تكاليف: 1,000 بلّور"><span class="textLabel">بلّور: </span>1,000</li><li class="time" title="مدة: 2ساعة"><span class="textLabel">مدة: </span>1ساعة</li></ul></td><td class="upgrade">ثياب جلدية<br /><span class="effect">تصفيح +1</span><br /><div class="leftButton"><a class="button" href="?action=CityScreen&function=buyUpgrade&actionRequest=<?php echo $session->checker;?>&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>&militaryTypeId=222&unitTypeId=301&upgradeTypeId=1061">تحسين!</a></div></td></tr></table></td></tr>
<?php }}?>
</table></div><div class="footer"></div></div><!--contentBox01h--></div><!--tab1 -->
<div id="tab2" style="display: block;">
<div class="contentBox01h">
 <h3 class="header"><span class="textLabel">وحدات</span></h3>
 <div class="content">
 <table cellpadding="0" cellspacing="0" class="units">
<?php for($s=210; $s<217; $s++){ 
    if($ships->IsShipBuildingAvailable($s)){ ?> 
 <tr><td class="object" title="<?php echo $ships->getShipInfo("$s","name");?>"><img src="img/characters/fleet/60x60/<?php echo $ships->GetShipHTMLClass($s);?>_faceright.gif" /></td><td><table cellpadding="0" cellspacing="0" class="inside" title="تحسين القوة الهجومية"><tr><td><img name="austausch1ship_ram"onmouseover="austausch1ship_ram.src='img/workshop/angriff_gold_highlight.gif';"onmouseout="austausch1ship_ram.src='img/workshop/angriff_gold.gif';"src="img/workshop/angriff_gold.gif" title="تحسين القوة الهجومية" /></td><td class="res"><ul class="resources"><li class="gold" title="تكاليف: 9,000 ذهب"><span class="textLabel">ذهب: </span>9,000</li><li class="glass" title="تكاليف: 6,000 بلّور"><span class="textLabel">بلّور: </span>6,000</li><li class="time" title="مدة: 3ساعة"><span class="textLabel">مدة: </span>3ساعة</li></ul></td><td class="upgrade">مهماز فولاذي<br /><span class="effect">ضرر +6</span><br /><p>وصل إلى أعلى مستوى للتوسع</p></td></tr></table></td><td class="empty"></td><td><table cellpadding="0" cellspacing="0" class="inside"><tr><td><img name="austausch2ship_ram"onmouseover="austausch2ship_ram.src='img/workshop/verteidigung_gold_highlight.gif';"onmouseout="austausch2ship_ram.src='img/workshop/verteidigung_gold.gif';"src="img/workshop/verteidigung_gold.gif" title="تحسين القوة الدفاعية" /></td><td class="res"><ul class="resources"><li class="gold" title="تكاليف: 6,000 ذهب"><span class="textLabel">ذهب: </span>6,000</li><li class="glass" title="تكاليف: 4,000 بلّور"><span class="textLabel">بلّور: </span>4,000</li><li class="time" title="مدة: 3ساعة"><span class="textLabel">مدة: </span>3ساعة</li></ul></td><td class="upgrade">تصفيح بالفولاذ<br /><span class="effect">تصفيح +6</span><br /><p>وصل إلى أعلى مستوى للتوسع</p></td></tr></table></td></tr>
<?php }}?>
</table>
</div><div class="footer"></div></div><!--contentBox01h-->
</div><!--tab2 -->
</div><!-- end YUI Content -->
</div><!-- end demo -->
<script type="text/javascript">var tabView = new YAHOO.widget.TabView('demo');</script>
</div></div>
<?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>