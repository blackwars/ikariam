<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$building = new CBuilding;
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/academy.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<body id="academy" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariama</h1>
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
    <span class="building">أكاديمية</span>
   </div>
   <div id="buildingUpgrade" class="dynamic">
    <h3 class="header">تطوير <a class="help" href="?view=buildingDetail&buildingId=4" title="مساعدة"><span class="textLabel">هل تحتاج لمساعدة؟</span></a></h3>
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
      <?php }if($building->nextLevelRes["crystal"] != 0){?>
      	  <li class="crystal alt" title="بلور"><span class="textLabel">بلور: </span><?php echo number_format($building->nextLevelRes["crystal"]);?>
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
  <?php if(($building->currentLevel<18)&&$building->canBuild()&&$building->checkResource(1,$building->currentLevel+1)){?>  
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
   <div id="researchLibrary" class="dynamic">
    <h3 class="header">مكتبة</h3>
    <div class="content">
     <img src="img/research/img_library.jpg" width="203" height="85" />
     <p>في  المكتبة تجد معلومات تخص جميع حقول المعرفة!</p>
     <div class="centerButton">
     <a href="?view=researchOverview&position=<?php echo $_GET["position"]?>&id=<?php echo $city->cid;?>" class="button">إلى المكتبة</a>
     </div>
    </div>
    <div class="footer"></div>
   </div>
   <!---the main view.-->
   <div id="mainview">
    <div class="buildingDescription">
     <h1>أكاديمية</h1>
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
	  location.href="?view=academy&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>";
	 },2000);
	 });
	});
   </script>
 </div>
<?php }?>
     <p>الأكاديمية هي مكان الحكمة الأعظم الذي يجمع بين المعرفة والتقاليد القديمة بأحدث التقنيات. أذكى الأدمغة في مدينتك ينتظرون السماح لهم بالدخول! لكن ليكن بعلمك أن كل باحث يحتاج إلى مختبر وهذا أمر سيكلفك بعض المصاريف.
كلما كانت الأكاديمية أكبر كلما استطعت تشغيل عدد أكبر من الباحثين في نفس الوقت.</p>
    </div>
    <form id="setScientists" action="action.php" method="POST">
     <input type="hidden" name="action" value="IslandScreen">
     <input type="hidden" name="function" value="workerPlan">
     <input type="hidden" name="actionRequest" value="<?php echo $session->checker;?>">
     <input type="hidden" name="view" value="academy">
     <input type="hidden" name="position" value=<?php echo $_GET["position"]?>>
     <div class="contentBox01h">
      <h3 class="header">
      <span class="textLabel">تعيين عمال</span>
      </h3>
      <div class="content">
      <ul>
      <li class="citizens">
       <span class="textLabel">مواطنون: </span>
        <span class="value" id="valueCitizens">
		<?php echo $city->citizens;?>
        </span>
      </li>
      <li class="scientists">
       <span class="textLabel">باحثون: </span>
       <span class="value" id="valueWorkers">
       <?php echo $city->scientists;?>
       </span>
      </li>
      <li class="gain">
       <span class="textLabel">إنجازات البحوث: </span>
       <div id="gainPoints">
        <img id="lightbulb" src="img/bulb-on.gif" width="14" height="21" />
       </div>
       <div style="position:absolute; top:22px; right:145px;">
        <span id="valueResearch" class="positive overcharged">
        +<?php echo $research->getResearchesPerHour();?></span>
        <span class="timeUnit">في الساعة</span>
       </div>
      </li>
      <li class="costs">
       <span class="textLabel">واردات المدينة: </span>
       <span id="valueWorkCosts" class="negative">
       <?php echo number_format($city->CalcIncomegold($city->cid));?>
       </span>
       <img src="img/resource/icon_gold.gif" title="ذهب" alt="ذهب" />
       <span class="timeUnit"> في الساعة</span>
      </li>
      </ul>
      <div id="overchargeMsg" class="status nooc ocready oced">محمّل زيادةً!</div>
      <div class="slider" id="sliderbg">
       <div class="actualValue" id="actualValue"></div>
       <div class="overcharge" id="overcharge"></div>
       <div id="sliderthumb"></div>
      </div>
      <a class="setMin" href="#reset" onClick="sliders['default'].setActualValue(0); return false;" title="لا باحثون"><span class="textLabel">أدنى</span></a>
      <a class="setMax" href="#max" onClick="sliders['default'].setActualValue(<?php echo $city->GetMaxScientists($building->currentLevel);?>); return false;" title="أقصى عدد من العلماء"><span class="textLabel">أقصى</span>
      </a>
      <input type="hidden" name="cityId" value="<?php echo $city->cid;?>">
      <input autocomplete="off" id="inputScientists" name="s" class="textfield" type="text" maxlength="4" />
      <div class="centerButton">
       <input type="submit" id="inputWorkersSubmit" class="button" value="تأكيد" />
      </div>
     </div>
      <div class="footer"></div>
     </div>
    </form>
<?php if($research->GetResearchStatus("R3")>9){?>
    <form id="accelResearchForm" action="action.php" method="POST">
     <input type=hidden name="action" value="CityScreen">
     <input type=hidden name="function" value="buyResearch">
     <input type="hidden" name="actionRequest" value="<?php echo $session->checker;?>">
     <input type=hidden name="id" value="<?php echo $city->cid;?>">
     <input type=hidden name="position" value="<?php echo $_GET["position"]?>">
     <div id="accelerateResearch" class="contentBox01h">
      <h3 class="header">تنفيذ التجربة</h3>
      <p>بعد بحث طويل واجتهاد مستمر توصل علمائنا إلى اختراع طريقة تمكن من إنتاج <?php echo round($city->getReqExprCrystal()/2);?> نقاط البحث. لتنفيذ هذا ستحتاج إلى <?php echo $city->getReqExprCrystal();?> من البلور.
كن حذراً! أثناء إنتاج هذه النقاط يمكن أن تقع تفاعلات خارقة ومدوية. لذى فغالباً ما يحتاج العلماء بعدها إلى 4ساعة لإعادة النظام في المختبر وترتيبه من جديد من الفوضى الكبيرة، قبل أن يتمكن استعماله من جديد للمزيد من التجارب.</p>
      <?php if($city->getReqReExprTime()>time()){?>
      <p class="notice">ستتم إعادة ترتيب المختبر بعد 
      <?php $time = $generator->getTimeFormat($city->getReqReExprTime()-time());
	  if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?></p>
	  <?php }else if($city->getReqExprCrystal()>$city->acrystal){?>
       <p class="notice">لا زالت تنقصك 0 من البلور لكي تقوم بهذه التجربة.</p>
	  <?php }else{?>
      <div class="centerButton">
       <input type="submit" class="button" value="تنفيذ التجربة" /></div><?php }?>
      <div class="footer"></div>
     </div>
    </form>
<?php }?>
   </div><!-- mainview -->
     
<?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>
<script type="text/javascript">
create_slider({
 id : "default",
 dir : 'rtl',
 maxValue : <?php echo $city->GetMaxScientists($building->currentLevel);?>,
 overcharge : 0,
 iniValue : <?php echo $city->scientists;?>,
 bg : "sliderbg",
 thumb : "sliderthumb",
 topConstraint: -10,
 bottomConstraint: 344,
 bg_value : "actualValue",
 bg_overcharge : "overcharge",
 textfield:"inputScientists"});

Event.onDOMReady(function() {
    var resIconDisplay;
    var slider = sliders["default"];
    resIconDisplay = new resourceStack({
        container : "gainPoints",
        resourceicon : "lightbulb",
        width : 140
        });
    resIconDisplay.setIcons(Math.floor(slider.actualValue*1.02));
    var startSlider = slider.actualValue;
    slider.subscribe("valueChange", function() {
        resIconDisplay.setIcons(Math.floor(slider.actualValue*1.02));
        var startCitizens = <?php echo $city->citizens;?>;
        var startScientists = <?php echo $city->scientists;?>;
        var startIncomePerTimeUnit = <?php echo $city->CalcIncomegold($city->cid);?>;
        flagSliderMoved = 1;   //res.setIcons(Math.round(slider.actualValue/(1+0.05*slider.actualValue)));
        Dom.get("valueWorkers").innerHTML = locaNumberFormat(slider.actualValue);
        Dom.get("valueCitizens").innerHTML = locaNumberFormat(startCitizens+startScientists - slider.actualValue);
        var valRes = 1.02*slider.actualValue;
        Dom.get("valueResearch").innerHTML = '+' + Math.floor(valRes);
		<?php 
		 $rp = 9;
		 if($research->GetResearchStatus("R3")>12)
		  $rp = 6;
		?>
        Dom.get("valueWorkCosts").innerHTML = startIncomePerTimeUnit  - <?php echo $rp;?>*(slider.actualValue-startSlider);
    });
    var flagSliderMoved =0;
    slider.subscribe("slideEnd", function() {
        if (flagSliderMoved) {
            Dom.get('inputWorkersSubmit').className = 'buttonChanged';
        }
     });
    });
</script>