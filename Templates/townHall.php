<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$building = new CBuilding;
$session->changeChecker();
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/townHall.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<body id="townHall" dir="rtl">
<div id="container">
 <div id="container2">
  <div id="header">
   <h1>إيكارياما ikariam</h1>
   <h2>عش في العصور القديمة!</h2>
  </div>
  <div id="avatarNotes"></div>
  <div id="breadcrumbs">
  <h3>أنت هنا:</h3>
  <a href="?view=worldmap_iso&amp;islandX=<?php echo $city->x;?>&amp;islandY=<?php echo $city->y;?>" title="عودة إلى خارطة العالم"><img src="img/resource/icon-world.gif" alt="عالم"><span>&nbsp;&gt;&nbsp;</span>
  </a>
  <a href="?view=island&amp;id=<?php echo $city->iid;?>" class="island" title="عودة إلى الجزيرة" dir="rtl"><?php echo $island->name?>[<?php echo $city->x;?>:<?php echo $city->y;?>]
  </a>
  <span>&nbsp;&gt;&nbsp;</span>
  <span class="city"><?php echo $city->cname;?></span>
  <span>&nbsp;&gt;&nbsp;</span>
  <span class="building">دار البلدية</span>
  </div>
  <!------------ header end-------------->
<!-------------- dynamic side-boxes.-->
  <div id="buildingUpgrade" class="dynamic">
    <h3 class="header">تطوير <a class="help" href="?view=buildingDetail&buildingId=xxx" title="مساعدة"><span class="textLabel">هل تحتاج لمساعدة؟</span></a>
    </h3>
    <div class="content">
     <div class="buildingLevel"><span class="textLabel">مستوى </span><?php echo $building->currentLevel;?>
     </div><?php if($building->currentLevel<18){?>
     <h4>ضروري للمستوى <?php echo $building->getBuildingNextLevel($_GET["position"]);?>:</h4>
      <ul class="resources">
      <?php if($building->nextLevelRes["wood"] != 0){?>
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية: </span><?php echo number_format($building->nextLevelRes["wood"]);?>
      </li>
      <?php }if($building->nextLevelRes["marble"] != 0){?>
	  <li class="marble alt" title="رخام"><span class="textLabel">رخام: </span><?php echo number_format($building->nextLevelRes["marble"]);?>
      </li>
      <?php }if($building->nextLevelRes["crystal"] != 0){?>
      	  <li class="crystal alt" title="بلور"><span class="textLabel">رخام: </span><?php echo number_format($building->nextLevelRes["crystal"]);?>
      </li>
      <?php }if($building->nextLevelRes["sulfur"] != 0){?>
      	  <li class="sulfur alt" title="كبريت"><span class="textLabel">رخام: </span><?php echo number_format($building->nextLevelRes["sulfur"]);?>
      </li>
      <?php }if($building->nextLevelRes["wine"] != 0){?>
      <li class="wine alt" title="عنب"><span class="textLabel">رخام: </span><?php echo number_format($building->nextLevelRes["wine"]);?>
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
  <?php if(($building->currentLevel<18)&&$building->canBuild()&&$building->checkResource(0,$building->currentLevel+1)){?>  
       <a href="?action=CityScreen&function=upgradeBuilding&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"]?>&level=<?php echo $building->currentLevel;?>&actionRequest=<?php echo $session->checker;?>" title="في لائحة البناء!"><span class="textLabel">تحسين</span></a>
  <?php  }else{?>
       <a class="disabled" href="#" title="إكمال الإنشاء غير ممكن حالياً"></a>
  <?php  }?>
      </li>
      <li class="downgrade">
  <?php  if(($building->currentLevel > 1)&& !$building->AmIUpgrading($_GET["position"])){?>
       <a href="?view=buildings_demolition&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"]?>&actionRequest=<?php echo $session->checker;?>" title="تدمير المبنى"><span class="textLabel">تدمير</span></a>
  <?php }else{?>
      <a class="disabled" href="#" title="التدمير غير ممكن حالياً!"></a>
   <?php }?>
      </li>
      </ul><?php }?>
     </div>
    <div class="footer"></div>
   </div>
   <!--Link zur Gesamtbilanz -->
  <div class="dynamic" id="finances">
    <h3 class="header">تحول إلى النظرة العامة للمالية</h3>
        <div class="content">
            <p>يمكنك هنا التطلع وبتفصيل تام على وضعيتك المالية.</p>
            <a href="?view=finances" class="button">تحول إلى النظرة العامة للمالية</a>
        </div>
    <div class="footer"></div>
 </div>
<!--Link zum Aufgeben der Kolonie -->
<?php if(!$city->IsCapital()){?>
  <div class="dynamic" id="abandon">
     <h3 class="header">التخلي عن المستعمرة</h3>
     <div class="content">
       <p>يمكنك أن تتنازل عن مستعمرتك. ستضيع عندها كل موادها الأولية، مواطنوها ووحداتها.</p>
       <a href="?view=abolishColony&amp;id=<?php echo $city->cid;?>" class="button">التخلي عن المستعمرة</a>
     </div>
     <div class="footer"></div>
  </div>
<?php }?>
<!--the main view. take care that it stretches.-->
<div id="mainview">
 <h1 style="text-align:center">دار البلدية</h1>
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
	  location.href="?view=townHall&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>";
	 },2000);
	 });
	});
   </script>
 </div>
<?php }?>  
 <div id="CityOverview" class="contentBox">
  <h3 class="header">المستوطنة
  <a href="?view=renameCity&id=577685&position=0" title="إعادة تسمية المدن">إعادة تسمية</a>
  </h3>
  <div class="content">
   <img class="citizen" src="img/characters/y100_citizen_faceright.gif" width="42" height="100"/>
   <ul class="stats">
    <li class="space">
     <span class="textLabel">مكان سكن: </span>
     <span class="value occupied"><?php echo $city->pop;?></span>/
     <span class="value total"><?php echo $city->maxpop;?></span>
    </li>
    <li class="growth growth_positive">
     <span class="textLabel">نمو: </span>
     <span class="value"><?php echo $city->growingupPop;?> في الساعة</span>
    </li>
    <li class="actions">
     <span class="textLabel">نقاط التحرك: </span><?php echo $city->avMovpoints;?>/<?php echo $city->movpoints;?>
    </li>
    <?php if($city->CalcIncomegold($city->cid)>=0){?>
    <li class="incomegold incomegold_positive">
    <?php }else{?>
    <li class="incomegold incomegold_negative">
    <?php }?>
     <span class="textLabel">ذهب صاف ٍ: </span>
     <span class="value"><?php echo number_format($city->CalcIncomegold($city->cid));?></span>
    </li>
    <li class="garrisonLimit">
     <span class="textLabel">أقصى حد للقوات المعينة: </span>
     <span class="value occupied"><?php echo $city->maxtroops;?></span>
    </li>
    <li class="corruption">
     <span class="textLabel">فساد: </span>
     <span class="value positive">
      <span title="الفساد الحالي"><?php echo round($city->corruption,2);?>%
      </span> 
     </span>
    </li>
    <li class="happiness <?php echo $city->GetHappinessHTMLClass();?>">
     <span class="textLabel">السعادة: </span><?php echo $city->GetArHappiness();?>
    </li>                                 
   </ul>
   <div id="PopulationGraph">
    <h4>السكان والإنتاج:</h4>
    <div class="citizens" style="right:20px;width:266px">
     <span class="type">
      <span class="count"><?php echo $city->citizens;?></span>
      <img src="img/characters/40h/citizen_r.gif" title="مواطنون" alt="مواطنون" />
     </span>
     <span class="production">
      <span class="textLabel">إنتاج </span>
      <img src="img/resource/icon_gold.gif" alt="ذهب" />
      <?php echo "+".number_format($city->goldp);?>
     </span>
    </div>
    <div class="woodworkers" style="right:286px;width:125px">
     <span class="type">
      <span class="count"><?php echo $city->woodworkers;?></span>
      <img src="img/characters/40h/woodworker_r.gif" title="عمّال" alt="عمّال" />
     </span>
     <span class="production">
      <span class="textLabel">إنتاج </span>
      <img src="img/resource/icon_wood.gif" alt="مادة صناعية" /><?php echo "+".$city->woodp;?>
     </span>
    </div>
    <div class="specialworkers" style="right:411px;width:80px">
     <span class="type">
      <span class="count"><?php echo $city->specialp;?></span>
      <img src="img/characters/40h/luxuryworker_r.gif" title="عمّال" alt="عمّال" />
     </span>
     <span class="production">
      <span class="textLabel">إنتاج </span>
      <img src="img/resource/icon_<?php echo $island->specialRes?>.gif" /><?php echo "+".$city->specialp;?>
     </span>
    </div>
    <div class="scientists" style="right:491px;width:87px">
     <span class="type">
      <span class="count"><?php echo $city->scientists;?></span>
      <img src="img/characters/40h/scientist_r.gif" title="علماء" alt="علماء" />
     </span>
     <span class="production">
      <span class="textLabel">إنتاج </span>
      <img src="img/resource/icon_research.gif" alt="نقاط أبحاث" /><?php echo "+".$research->getResearchesPerHour();?>
     </span>
    </div>
    <div class="priests" style="right:578px;width:60px">
     <span class="type">
      <span class="count"><?php echo $city->priests;?></span>
      <img src="img/characters/40h/templer_r.gif" title="عظماء" alt="عظماء" />
     </span>
    </div>
   </div>
   <div id="notices">
    <h4>إشارات:</h4>
    <?php if($city->corruption){?>
    <div class="warning">
     <h5>يسود الفساد في المستعمرة!</h5>
     <p>إنجاز العمل والسعادة يتراجعان بشكل ملحوظ في مدينتك! أكمل إنشاء مقر الحاكم - يجب أن توازي عدد درجاته عدد مستوطناتك.</p>
    </div>
    <?php }else{?>
    <p>لا توجد إشكالات معينة! تهانينا، في مدينتك كل شيء يسير بشكل ممتاز</p>
    <?php }?>
   </div>
  </div>
  <div class="footer"></div>
 </div>
 <div class="contentBox">
  <h3 class="header">السعادة</h3>
  <div class="content">
   <p>تؤثر العديد من العوامل في سعادة مدينتك. ستساعدك هذه التشكيلة في التعرف على مشاكلك وإمكانياتك.</p>
   <div id="SatisfactionOverview">
    <div class="positives">
    <h4>علاوي</h4>
    <div class="cat basic">
     <h5>العلاوة الأساسية</h5>
<?php $right = 213;?>
     <div class="base" style="right:100px;width:113px">
      <span class="value">+196</span>
      <img src="img/icons/city_30x30.gif" width="30" height="30" title="العلاوة الأساس" alt="العلاوة الأساس" />
     </div>
<?php if($research->GetHappinessByResearches()){?>
     <div class="research1" style="right:213px;width:66px"><span class="value">+<?php echo $research->GetHappinessByResearches();?></span> <img src="img/icons/researchbonus_30x30.gif" width="30" height="30" title="عبر البحوث" alt="عبر البحوث" />
     </div>
<?php $right = 280;}?>
<?php if($city->IsCapital() && $research->GetResearchStatus("R3")>0){?>
     <div class="capital" style="right: <?php echo $right;?>px; width: 92px;"><span class="value">+50</span> <img src="img/icons/crown.gif" title="علاوة العاصمة" alt="علاوة العاصمة" width="20" height="20">
     </div>
<?php }?>
    </div>
    <div class="cat wine">
     <h5>مشروب العنب</h5>
     <?php if($city->GetBuildingLevel2(9)){?>
     <?php  $width = 290; $temp = $city->tavernWine*15;
	  if($temp < 290) $width = $temp;?>
     <div class="tavern" style="right:100px;width:109px"><span class="value">+<?php echo $city->GetBuildingLevel2(9)*12;?></span> <img src="img/buildings/tavern_30x30.gif" width="30" height="30" title="من خلال مستوى الاستراحة" alt="من خلال مستوى الاستراحة" />
     </div>
     <div class="serving" style="right:209px;width:<?php echo $width;?>px"><span class="value">+<?php echo $temp;?></span> <img src="img/resource/icon_wine.gif" width="24" height="20" title="عبر تقديم عصير العنب" alt="عبر تقديم عصير العنب" />
    </div>
    <?php }else{?><p>لا تتوفر أي استراحة في المدينة بعد!</p><?php }?>
    </div>
    <div class="cat culture">
     <h5>ثقافة</h5>
     <?php if($city->GetBuildingLevel2(19)){?>
     <?php  $width = 290; $temp = 0;
	  if($temp < 290) $width = $temp;?>
     <div class="museum" style="right:100px;width:81px"><span class="value">+<?php echo $city->GetBuildingLevel2(19)*20;?></span> <img src="img/buildings/museum_30x30.gif" width="30" height="30" title="خلال مستوى المتحف" alt="خلال مستوى المتحف" />
   </div>
   <div class="treaties" style="right:181px;width:<?php echo $width;?>px"><span class="value">+<?php echo $temp;?></span> <img src="img/interface/icon_message_write.gif" width="24" height="20" title="عبر معاهدات المعالم الثقافية" alt="عبر معاهدات المعالم الثقافية" />
   </div>
     <?php }else{?><p>لا يتوفر أي متحف في المدينة بعد!</p><?php }?>
    </div>
   </div>
    <div class="negatives">
    <h4>تنقيصات</h4>
    <div class="cat overpopulation" >
     <h5>سكان:</h5>
     <?php  $width = 350;
	  if($city->pop<350)$width = $city->pop;?>
     <div class="bar" style="right:100px;width:<?php echo $width;?>px;">
      <span class="value">-<?php echo $city->pop;?></span>
     </div>
    </div>
    <?php if($city->corruption){?>
    <div class="cat corruption" >
     <h5>فساد:</h5>
      <?php  
	  $corruption = $city->corruption/100*196;
	  $width = 350;
	  if($corruption<350)$width = $corruption;?>
     <div class="bar" style="right:100px;width:200px;"><span class="value"><?php echo "-".$corruption;?></span></div>
    </div>
    <?php }?>
    </div>
     <div class="happiness <?php echo $city->GetHappinessHTMLClass();?>">
     <h4>مجموع السعادة:</h4>
     <div class="value"><?php echo $city->happiness;?></div>
     <div class="text"><?php echo $city->GetArHappiness();?></div>
   </div>
   </div>
  </div><!-- end content -->
  <div class="footer"></div>
 </div><!-- end .contentBox -->
</div><!-- end #mainview -->
<?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>