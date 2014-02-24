<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$building = new CBuilding;
$session->changeChecker();
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/tavern.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<body id="tavern" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariam</h1>
    <h2>عش في العصور القديمة!</h2>
   </div>
   <div id="avatarNotes"></div>
<script>
classValuePerSatisfaction = new Array();
classNamePerSatisfaction = new Array();
classValuePerSatisfaction[0] = 300; 
classNamePerSatisfaction[0] = 'ecstatic'; 
classValuePerSatisfaction[1] = 50; 
classNamePerSatisfaction[1] = 'happy'; 
classValuePerSatisfaction[2] = 0; 
classNamePerSatisfaction[2] = 'neutral'; 
classValuePerSatisfaction[3] = -50; 
classNamePerSatisfaction[3] = 'sad'; 
classValuePerSatisfaction[4] = -1000; 
classNamePerSatisfaction[4] = 'outraged'; 
satPerWine = new Array();
savedWine = new Array();
<?php for($i=0; $i<=$building->currentLevel; $i++){?>
satPerWine[<?php echo $i;?>] = <?php echo $i*60;?>;
savedWine[<?php echo $i;?>] = '&nbsp;';
<?php }?>
</script>
   <div id="breadcrumbs">
    <h3>أنت هنا:</h3>
    <a href="?view=worldmap_iso&amp;islandX=<?php echo $island->x;?>&amp;islandY=<?php echo $island->y;?>" title="عودة إلى خارطة العالم"><img src="img/resource/icon-world.gif" alt="عالم" /></a><span>&nbsp;&gt;&nbsp;</span>
    <a href="?view=island&amp;id=<?php echo $city->iid;?>" title="عودة إلى الجزيرة"><img src="img/resource/icon-island.gif" alt="<?php echo $island->name?>" /><?php echo $island->name?>[<?php echo $island->x;?>:<?php echo $island->y;?>]</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="?view=city&amp;id=<?php echo $city->cid;?>" class="city" title="عودة إلى المدينة"><?php echo $city->cname;?></a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="building">استراحة</span>
   </div>
   <div id="buildingUpgrade" class="dynamic">
    <h3 class="header">تطوير
    <a class="help" href="?view=buildingDetail&buildingId=9" title="مساعدة">
    <span class="textLabel">هل تحتاج لمساعدة؟</span>
    </a>
    </h3>
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
  <?php if(($building->currentLevel<18)&&$building->canBuild()&&$building->checkResource(9,$building->currentLevel+1)){?>    
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
     <h1>استراحة</h1>
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
	  location.href="?view=tavern&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>";
	 },2000);
	 });
	});
   </script>
 </div>
<?php }?>  
     <p>بعد إنجاز عمل ما، ليس هناك شيء أمتع من شرب عصير العنب البارد. لذلك يجتمع مواطنوك بكل سرور في أماكن الاستراحة حيث يسقى مشروب العنب. وبعد انتهاء النهار الطويل، وابتعاد أنغام الأناشيد مع ريح المساء يتوجهون إلى بيوتهم وهم سعداء وفرحين.
كل مستوى إضافي للاستراحة يعنى سقي كمية أكبر من الشراب.</p>
    </div><!-- ende .buildingDescription -->
    <div class="contentBox01h">
     <h3 class="header"><span class="textLabel">سقي شراب</span></h3>
     <div class="content">
      <form id="wineAssignForm" action="action.php" method="POST">
       <input type="hidden" name="action" value="CityScreen">
       <input type="hidden" name="function" value="assignWinePerTick">
       <input type="hidden" name="actionRequest" value="<?php echo $session->checker;?>" />
       <input type="hidden" name="id" value="<?php echo $city->cid;?>">
       <input type="hidden" name="position" value="<?php echo $_GET["position"]?>">
       <ul id="units">
        <li class="unit">
         <div class="unitinfo">
          <h4>تقديم مشروب العنب</h4>
           <img src="img/resource/wine-big.gif" style="margin-left:10px;" /><p>يمكنك أن تحدد بدقة كمية مشروب العنب التي تود أن تسقيها لسكانك. كلما وضعت مشروبا أكثر في الاستراحة، كلما كان مواطنوك أكثر سعادةً.انتبه: عند التموين يجب أن تعطي صاحب المكان حصته من المشروب في كل ساعة.</p>
          </div>
         <div class="sliderinput">
          <div id="sliderbg_wine" class="sliderbg" title="slider value = 0">
          <div id="actualValue_wine" class="actualValue" style="clip: rect(0px, 10px, auto, 0px);"></div>
          <div id="sliderthumb_wine" class="sliderthumb" style="left: 0px; top: 0px;"></div>
         </div>
<script type="text/javascript">
create_slider({dir : 'rtl',id : "slider_wine",
maxValue : <?php echo $building->currentLevel;?>,
overcharge : 0,
iniValue : <?php echo $city->tavernWine/4;?>,
bg : "sliderbg_wine",thumb : "sliderthumb_wine",topConstraint: -10,bottomConstraint: 326,bg_value : "actualValue_wine",textfield:"wineAmount"});
Event.onDOMReady(function() {
var slider = sliders["slider_wine"];
var startSatisfaction = <?php echo $city->happiness-$city->tavernWine*60;?>;
slider.subscribe("valueChange", function() {
var val = classValuePerSatisfaction.length-1;
for (n=0;n<5;n++) {
 if (classValuePerSatisfaction[n] <= (startSatisfaction + 60*slider.actualValue)) {
 val = n;
 break;
 }
}
window.status = startSatisfaction + 60*slider.actualValue;
Dom.get('citySatisfaction').className = classNamePerSatisfaction[val];if(satPerWine[slider.actualValue]) {slider.UpdateField1.innerHTML = satPerWine[slider.actualValue];slider.UpdateField2.innerHTML = savedWine[slider.actualValue];}else{slider.UpdateField1.innerHTML = "0";slider.UpdateField2.innerHTML = "&nbsp;"}});slider.UpdateField1 = Dom.get("bonus");slider.UpdateField1.innerHTML = satPerWine[slider.actualValue];slider.UpdateField2 = Dom.get("savedWine");slider.UpdateField2.innerHTML = savedWine[slider.actualValue];});
</script>
         <a class="setMin" href="#reset" onClick="sliders['slider_wine'].setActualValue(0); return false;" title="إعادة الإدخال للبداية"><span class="textLabel">أدنى</span></a>
         <a class="setMax" href="#max" onClick="sliders['slider_wine'].setActualValue(<?php echo $building->currentLevel;?>); return false;" title="سَقيُ أكبر كمية ممكنة"><span class="textLabel">أقصى</span></a>
        </div><!-- end .sliderinput -->
        <div class="forminput">
        <a title="سَقيُ أكبر كمية ممكنة" onClick="sliders['slider_wine'].setActualValue(<?php echo $building->currentLevel;?>); return false;" href="#max" class="setMax"><span class="textLabel">أقصى</span></a>
        <div class="centerButton"><input type="submit" value="عشتم!" class="button"/></div>
        <div id="citySatisfaction"  class="<?php echo $city->GetHappinessHTMLClass();?>">
       </div>
      </div>
      <div id="serve" class="textfield">
      <select id="wineAmount" name="amount" size="1">
       <option value="0" >لا يوجد عصير عنب</option>
       <?php for($i=1; $i<=$building->currentLevel; $i++){?>
       <option value="<?php echo $i;?>"><?php echo $i*4;?> مشروب العنب في الساعة </option>
       <?php }?>
      </select>
      <span class="bonus">+<span id="bonus" class="value"><?php echo $city->tavernWine/4;?></span> مواطنون سعداء</span>
      <br/>
      <span class="savedWine"><span id="savedWine"></span></span>
      </div>
      </li>
     </ul>
    </form>
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