<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$building = new CBuilding;
$session->changeChecker();
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/safehouse.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<body id="safehouse" dir="rtl">
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
    <span class="building">مخبأ</span>
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
  <?php if(($building->currentLevel<18)&&$building->canBuild()&&$building->checkResource(10,$building->currentLevel+1)){?>    
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
   <div class="dynamic" id="reportInboxLeft">
    <h3 class="header">معلومات</h3>
     <div class="content">
      <p>يمكنك تدريب <?php echo $building->currentLevel;?>.</p>
      <ul>
      <li>0 ينتظرون دورهم في التدريب.</li>
      <li>0 يعملون حاليا في الدفاع.</li>
      <li>0 مستخدم في الوقت الحالي.</li>
      </ul>
     </div>
    <div class="footer"></div>
   </div>
   <div id="unitConstructionList" class="dynamic">
    <h3 class="header">لائحة بناء <a class="help" href="?view=informations&articleId=10021&mainId=10021" title="مساعدة">
    <span class="textLabel">مساعدة</span></a></h3>
    <div class="content">
    </div>
    <div class="footer">&nbsp;</div>
   </div>
   <div id="mainview">
    <div class="buildingDescription">
    <h1>مخبأ</h1>
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
	  location.href="?view=safehouse&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>";
	 },2000);
	 });
	});
   </script>
 </div>
<?php }?> 
    <p>يقوم الحاكم الحكيم بمراقبة أصدقاءه وأعداءه بشكل دائم ومستمر. يمكنك أن تشغل في  المخبأ جواسيس يخبرونك عن مدن أخرى.
مخبأً أكبر يتسع لعدد أكبر من الجواسيس.</p>
    </div>
    <div class="yui-navset">
     <ul class="yui-nav">
      <li class="selected"><a href="?view=safehouse&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>" title="مخبأ"><em>مخبأ</em></a></li>
      <li><a href="?view=safehouse&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>&tab=reports" title="تقارير التجسس"><em>تقارير التجسس</em></a></li>
      <li><a href="?view=safehouse&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>&tab=archive"><em>أرشيف</em></a></li>
     </ul>
    </div>
    <form id="buildForm"  action="action.php" method="POST">
     <input type="hidden" name="action" value="Espionage">
     <input type="hidden" name="function" value="buildSpy">
     <input type="hidden" name="actionRequest" value="<?php echo $session->checker;?>" />
     <input type="hidden" name="id" value="<?php echo $city->cid;?>">
     <input type="hidden" name="position" value="<?php echo $_GET["position"];?>">
     <div class="contentBox01h">
      <h3 class="header">
      <span class="textLabel">تدريب جاسوس</span></h3>
      <div class="content">
       <ul id="units">
       <li class="unit">
        <div class="unitinfo">
         <h4>تدريب جاسوس</h4>
        <img src="img/characters/military/120x100/spy_120x100.gif" />
         <p>إن هذا المواطن وفيٌّ وكتوم للأسرار. إنه مرشح مثالي ليكون جاسوساً.وقت تدريب جاسوس :</p>
        </div>
        <div class="sliderinput">
         <div class="sliderbg" id="sliderbg_spy">
         <div class="actualValue" id="actualValue_spy"></div>
         <div class="sliderthumb" id="sliderthumb_spy"></div>
         </div>
<script type="text/javascript">
create_slider({dir : 'rtl',id : "slider_spy",
maxValue : <?php echo $building->currentLevel;?>,
overcharge : 0,
iniValue : 0,
bg : "sliderbg_spy",thumb : "sliderthumb_spy",topConstraint: -10,bottomConstraint: 326,bg_value : "actualValue_spy",textfield:"textfield_spy"});
var slider = sliders["slider_spy"];
this.activateButton = function() {document.getElementById('buttonBuildSpy').disabled=false;document.getElementById('buttonBuildSpy').setAttribute("class","button");}
this.deactivateButton = function() {document.getElementById('buttonBuildSpy').disabled=true;document.getElementById('buttonBuildSpy').setAttribute("class", "button_inactive");}
Event.onDOMReady( function() {if(sliders["slider_spy"].actualValue == 0) {deactivateButton();} else {activateButton(); }sliders["slider_spy"].subscribe("change", function() {if(sliders["slider_spy"].actualValue == 0) {deactivateButton(); } else { activateButton();}})})
</script>
<a class="setMin" href="#reset" onClick="sliders['slider_spy'].setActualValue(0); return false;" title="إعادة الإدخال للبداية"><span class="textLabel">أدنى</span></a><a class="setMax" href="#max" onClick="sliders['slider_spy'].setActualValue(<?php echo $building->currentLevel;?>); return false;" title="تدريب أكبر عدد ممكن"><span class="textLabel">أقصى</span></a>
        </div>
         <div class="forminput">
          <input id="textfield_spy" class="textfield" type="text" maxlength="3" size="4" value="0" name="textfield_spy">
          <input class="button_inactive" type="submit" disabled="disabled" value="تدريب جاسوس" id="buttonBuildSpy">
          <?php /* وصل عدد الجواسيس إلى الحد الأقصى! */?>
         </div>
        <div class="costs">
         <h5>تكاليف:</h5>
         <ul class="resources">
         <li class="gold"><span class="textLabel">منشرة: </span>150</li>
         <li class="glass"><span class="textLabel">منشرة: </span>80</li>
         <li class="time">
         <?php $time = $generator->getTimeFormat(780-$building->currentLevel*10);
	           echo $time["m"]."د ";
	           if($time["s"]) echo $time["s"]."ث ";
	     ?>
         </li>
        </ul>
       </div>
       </li>
       </ul>
      </div>
      <div class="footer">&nbsp;</div>
     </div>
    </form>
    <div class="contentBox01h">
     <h3 class="header">
     <span class="textLabel">الجاسوس في العمل</span></h3>
     <div class="content">
      <?php /* <div class="spyinfo">
       <ul>
       <li title="مكان المكوث" class="city">
       <a title="kosaki" href="?view=city&id=36921" >kosaki (69,21)</a>
       </li>
       <li title="Status" class="status">جواسيسك ينتظرون أوامر جديدة</li>
       <li class="risk"><span class="textLabel">خطر الاكتشاف</span>:<br />
       <div class="statusBar">
        <div style="width: 5%;" class="bar"></div>
       </div>
       <div class="percentage">5%</div>
       </li>
       </ul>
       <div class="missionButton">
       <a title="أرسل مهمة من المهام إلى جاسوسك." href="?view=safehouseMissions&id=64113&position=4&spy=322597">مهمة</a>
       </div>
       <div class="missionAbort">
       <a title="مناداة الجاسوس ليعود إلى الوطن" href="?action=Espionage&function=executeMission&actionRequest=7061e21a9f25d161a08e86b144065bc8&id=64113&position=4&spy=322597&mission=8">نداء بالانسحاب</a>
       </div>
      </div> */?>
     </div>
     <div class="footer"></div>
    </div><br/>
   </div>
<?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>