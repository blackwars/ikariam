<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$session->changeChecker();
if(!isset($_GET['islandId'])||!isset($_GET['position']))
 header("Location: index.php");
if(!$city->capital||($research->GetResearchStatus("R1")<3)||($city->getBuildingLevel2(8)<1))
 header("Location: action.php?view=error");
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/colonize.css" rel="stylesheet" type="text/css" media="screen">
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
<script type="text/javascript" src="templates/js/transportController.js"></script>
<script type="text/javascript">    
var transporterDisplay;
Event.onDOMReady(function() {transporterDisplay = new transportController(<?php echo $city->aships;?>, 500, Dom.get("transporterCount"), parseInt(Dom.get("peopleInput").value)+1250);});
</script>
   <div id="breadcrumbs">
    <h3>أنت هنا:</h3>
    <a href="?view=worldmap_iso&amp;islandX=<?php echo $island->x;?>&amp;islandY=<?php echo $island->y;?>" title="عودة إلى خارطة العالم"><img src="img/resource/icon-world.gif" alt="عالم" /></a><span>&nbsp;&gt;&nbsp;</span>
    <a href="?view=island&amp;id=<?php echo $island->iid;?>" title="عودة إلى الجزيرة"><img src="img/resource/icon-island.gif" alt="<?php echo $island->name?>" /><?php echo $island->name?>[<?php echo $island->y;?>:<?php echo $island->x;?>]</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="building">استعمار</span>
   </div>
   <div id="backTo" class="dynamic">
    <h3 class="header">استعمار</h3>
    <div class="content">
     <a href="?view=island&amp;id=<?php echo $island->iid;?>" title="عودة إلى الجزيرة">
     <img src="img/action_back.gif" width="160" height="100" />
     <span class="textLabel">&lt;&lt; عودة إلى الجزيرة</span></a>
    </div>
    <div class="footer"></div>
   </div>
   <div id="mainview">
    <div class="buildingDescription">
     <h1>استعمار</h1>
     <p>إن هذا المكان مناسب جداً لتأسيس مدينة! قطعة ساحلية سهلة تؤمن الوصول للمحيط والتلال الخضراء المثمرة المحيطة يمكن أن توفر ما يكفي من الغذاء للعديد من البشر.</p>
    </div>
    <div id="moveCity" class="contentBox01h" style="z-index:55">
     <h3 class="header">نقل المدينة نحو <?php echo $island->name?></h3>
      <div class="content" id="relatedCities">
       <p>يمكنك مقابل أمبروزيا نقل إحدى مدنك القائمة بجميع سكانها وبناياتها إلى هذا المكان الخالي لهذه المستعمرة.</p>
       <div style="padding:5px 10px 10px 10px;">
        <form action="action.php" method="post">
         <input type="hidden" name="action" value="Premium" />
         <input type="hidden" name="function" value="moveCity" />
         <input type="hidden" name="actionRequest" value="<?php echo $session->checker;?>" />
         <input type="hidden" name="desiredIslandId" value="<?php echo $island->iid;?>" />
         <input type="hidden" name="desiredPosition" value="<?php echo $_GET['position'];?>" />
         <div style="height:100px">
          <img src="img/premium/movecity.jpg" style="float:left;">
          <table style="width:400px;background-color:#FFFBEC;border:1px solid #FBE7C0;margin-top:45px;">
           <tr>
           <td  style="width:250px;">
           <select id="moveCitySelect"class="citySpecialSelect smallFont"name="cityId" tabindex="1" >
            <option>-- اختيار المدينة --</option>
<?php 
for($i=0; $i<count($session->cities); $i++){
$cid = $session->cities[$i];
$cname =  $database->getCityField($cid,"name");
$isCapital = $database->getCityField($cid,"capital");
$iid = $database->getCityField($cid,"iid");
$islandNameCoor = " [".$database->getIslandField($iid,"x")
				.":".$database->getIslandField($iid,"y")."]";
?>    
            <option class="coords" <?php if($isCapital){?> selected="selected"<?php }?> value="<?php echo $cid;?>"  title="سلعة: <?php echo $city->GetIslandTGArMerch($cid);?>" ><?php echo $islandNameCoor;?>&nbsp;<?php echo $cname;?></option>
<?php }?>             
           </select>
           </td>
           <td>200<img height="20" width="24" title="Ambrosia" alt="Ambrosia" src="img/premium/ambrosia_icon.gif"/></td>
           <td style="padding-bottom:10px;">
           <a class="notenough" style="color:#999;font-weight:normal;font-size:11px;text-decoration:none" href="?view=premiumPayment&oldView=premium">ستحتاج لــ 200 أمبروزيا!<br><span class="buyNow" style="text-decoration:underline">إشتر الآن!</span></a>
           </td>
           </tr>
          </table>
         </div>
        </form>
       </div>
      </div>
      <div class="footer"></div>
     </div>  
<script type="text/javascript">
Event.onDOMReady( function() {
 replaceSelect(Dom.get("moveCitySelect"));
});
</script>
<?php 
$colonizingAvilable = ($city->aships>2)&&($city->awood>1249)&&($city->citizens>39)&&($city->getBuildingLevel2(8)>=count($session->cities));
?>
      <?php if($colonizingAvilable){?>
      <form id="transport" onSubmit="checkTransporters()"  action="action.php"  method="POST">
       <input type="hidden" name="action" value="transportOperations" />
       <input type="hidden" name="function" value="startColonization" />
       <input type="hidden" name="actionRequest" value="<?php echo $session->checker;?>" />
       <input type="hidden" name="id" value="<?php echo $island->iid;?>" />
       <input type="hidden" name="from_cid" value="<?php echo $city->cid;?>" />
       <input type="hidden" name="LoadSpeed" value="<?php echo $city->getLoadSpeed();?>" />
       <input type="hidden" id="peopleInput" name="cargo_people" value="40" />
       <input type="hidden" id="goldInput" name="cargo_gold" value="9000" />
       <input type="hidden" id="positionInput" name="desiredPosition" value="<?php echo $_GET['position'];?>" />
       <input type="hidden" id="resourceInput" name="cargo_resource" value="1250" />
       <input type="hidden" id="tradegood1Input" name="cargo_tradegood1" value="0" />
       <input type="hidden" id="tradegood2Input" name="cargo_tradegood2" value="0" />
       <input type="hidden" id="tradegood3Input" name="cargo_tradegood3" value="0" />
       <input type="hidden" id="tradegood4Input" name="cargo_tradegood4" value="0" />
      <?php }?>
       <div id="createColony" class="contentBox01h"  style="z-index:50">
        <h3 class="header">إنشاء مستعمرة على <?php echo $island->name?></h3>
        <div class="content">
         <p>يمكنك هنا <em>تأسيس مستعمرة</em>.
المستعمرات مدن كعاصمتك بالضبط، غير أنك تديرها إنطلاقاً من عاصمتك.
يحدد <em>مستوى قصرك في عاصمتك</em>  عدد المستعمرات المسموح لك بتملكها في نفس الوقت. لكي تأسس العديد من المدن عليك بتوسيع قصرك!</p>
         <div class="costs">
          <img src="img/colony_build.jpg" />
          <p>تأسيس مستعمرة يحتاج:</p>
          <ul class="resources">
           <li class="citizens"><span class="textLabel">مواطنون: </span>40</li>
           <li class="gold"><span class="textLabel">ذهب: </span>9000</li>
           <li class="wood"><span class="textLabel">مواد البناء: </span>1250</li>
          </ul>
         </div>
         <?php if(!$colonizingAvilable){?>
          <div class="errors">
           <h4>لا زالت للأسف تنقصك بعد الشروط للتمكن من تأسيس مستعمرة: </h4>
           <ul>
           <?php if($city->getBuildingLevel2(8)<count($session->cities)){?>
           <li><span>إنك تمتلك بالفعل <?php echo count($session->cities)-1;?> مستعمرة، ومستوى قصرك هو <?php echo $city->getBuildingLevel2(8);?>! قم بتطوير مستوى قصرك في عاصمتك!</span></li><?php }?>
           <?php if($city->citizens<40){?><li><span>مازال ينقصك <?php echo 40-$city->citizens;?> سكان.</span></li><?php }?>
           <?php if($city->awood<1250){?><li><span>مازال ينقصك <?php echo 1250-$city->awood;?> من الخشب.</span></li><?php }?>
           <?php if($city->aships<3){?><li><span>مازال ينقصك <?php echo 3-$city->aships;?> سفن تجارية.</span></li><?php }?>
           </ul>
          </div>
         <?php }?>
        <?php if($colonizingAvilable){?>
         <p>يمكنك في نفس الوقت أن ترسل المزيد من المواد الأولية، إذا كنت ترغب في منح مستعمرتك الجديدة المزيد من <em> رأس مال</em>:</p>
         <ul class="resourceAssign">
         <li class="wood">
          <label for="textfield_resource">إرسال خشب بناء مع::</label>
          <div class="sliderinput">
           <div class="sliderbg" id="sliderbg_resource">
          <div class="actualValue" id="actualValue_resource"></div>
          <div class="sliderthumb" id="sliderthumb_resource"></div>
         </div>
<script type="text/javascript">
create_slider({
dir : 'rtl',
id : "slider_resource",
<?php 
$resmaxValue = $city->awood;
if(($resmaxValue/500) > ($city->aships*500))
 $resmaxValue = $city->aships*500;
?>
maxValue : <?php echo $resmaxValue;?>,
overcharge : 0,
iniValue : 0,
bg : "sliderbg_resource",
thumb : "sliderthumb_resource",
topConstraint: -10,
bottomConstraint: 326,
bg_value : "actualValue_resource",
textfield:"textfield_resource"
});
Event.onDOMReady(function() {
var slider = sliders["slider_resource"];
slider.UpdateField1 = Dom.get("resourceInput");
slider.subscribe("valueChange", function() {
updateColonizeSummary('resource', slider.actualValue);
});
slider.subscribe("slideEnd", function() {
slider.UpdateField1.value = 1250+slider.actualValue;
});
transporterDisplay.registerSlider(slider);
});
</script>
           <a class="setMin" href="#reset" onClick="setColonizeMinValue('slider_resource'); return false;" title="إعادة الإدخال للبداية"><span class="textLabel">أدنى</span></a>
           <a class="setMax" href="#max" onClick="setColonizeMaxValue('slider_resource'); return false;" title="إرسال كل شيء"><span class="textLabel">أقصى</span></a>
          </div>
          <input class="textfield" id="textfield_resource" type="text" name="sendresource" value="0" size="4" maxlength="9">
         </li>
<?php if($city->awine>0){?>
         <li class="wine"> 
          <label for="textfield_wine">إرسال مشروب العنب::</label>
          <div class="sliderinput">
           <div class="sliderbg" id="sliderbg_wine">
            <div class="actualValue" id="actualValue_wine"></div>
            <div class="sliderthumb" id="sliderthumb_wine"></div>
           </div>
<script type="text/javascript">
create_slider({
dir : 'rtl',
id : "slider_wine",
<?php 
$winemaxValue = $city->awine;
if(($winemaxValue/500) > ($city->aships*500))
 $winemaxValue = $city->aships*500;
?>
maxValue : <?php echo $winemaxValue;?>,
overcharge : 0,
iniValue : 0,
bg : "sliderbg_wine",
thumb : "sliderthumb_wine",
topConstraint: -10,bottomConstraint: 326, bg_value : "actualValue_wine",textfield:"textfield_wine"});
Event.onDOMReady(function() {
var slider = sliders["slider_wine"];slider.UpdateField1 = Dom.get("tradegood1Input");slider.subscribe("valueChange", function() {updateColonizeSummary('wine', slider.actualValue);});
slider.subscribe("slideEnd", function() {slider.UpdateField1.value = slider.actualValue; });
transporterDisplay.registerSlider(slider);});
</script>
           <a class="setMin" href="#reset" onClick="setColonizeMinValue('slider_wine'); return false;" title="إعادة الإدخال للبداية"><span class="textLabel">أدنى</span></a>
           <a class="setMax" href="#max" onClick="setColonizeMaxValue('slider_wine'); return false;" title="إرسال كل شيء"><span class="textLabel">أقصى</span></a>
          </div>
          <input class="textfield" id="textfield_wine" type="text" name="sendwine"  value="0" size="4" maxlength="9">
         </li>
<?php }if($city->amarble>0){?>
         <li class="marble"> 
          <label for="textfield_marble">إرسال رخام::</label>
          <div class="sliderinput">
           <div class="sliderbg" id="sliderbg_marble">
            <div class="actualValue" id="actualValue_marble"></div>
            <div class="sliderthumb" id="sliderthumb_marble"></div>
           </div>
<script type="text/javascript">
create_slider({
dir : 'rtl',
id : "slider_marble",
<?php 
$marblemaxValue = $city->amarble;
if(($marblemaxValue/500) > ($city->aships*500))
 $marblemaxValue = $city->aships*500;
?>
maxValue : <?php echo $marblemaxValue;?>,
overcharge : 0,
iniValue : 0,
bg : "sliderbg_marble",
thumb : "sliderthumb_marble",
topConstraint: -10,bottomConstraint: 326, bg_value : "actualValue_marble",textfield:"textfield_marble"});
Event.onDOMReady(function() {
var slider = sliders["slider_marble"];slider.UpdateField1 = Dom.get("tradegood1Input");slider.subscribe("valueChange", function() {updateColonizeSummary('marble', slider.actualValue);});
slider.subscribe("slideEnd", function() {slider.UpdateField1.value = slider.actualValue; });
transporterDisplay.registerSlider(slider);});
</script>
           <a class="setMin" href="#reset" onClick="setColonizeMinValue('slider_marble'); return false;" title="إعادة الإدخال للبداية"><span class="textLabel">أدنى</span></a>
           <a class="setMax" href="#max" onClick="setColonizeMaxValue('slider_marble'); return false;" title="إرسال كل شيء"><span class="textLabel">أقصى</span></a>
          </div>
          <input class="textfield" id="textfield_marble" type="text" name="sendmarble"  value="0" size="4" maxlength="9">
         </li>
<?php }if($city->acrystal>0){?>
         <li class="crystal"> 
          <label for="textfield_crystal">إرسال زجاج بلوري::</label>
          <div class="sliderinput">
           <div class="sliderbg" id="sliderbg_crystal">
            <div class="actualValue" id="actualValue_crystal"></div>
            <div class="sliderthumb" id="sliderthumb_crystal"></div>
           </div>
<script type="text/javascript">
create_slider({
dir : 'rtl',
id : "slider_crystal",
<?php 
$crystalmaxValue = $city->acrystal;
if(($crystalmaxValue/500) > ($city->aships*500))
 $crystalmaxValue = $city->aships*500;
?>
maxValue : <?php echo $crystalmaxValue;?>,
overcharge : 0,
iniValue : 0,
bg : "sliderbg_crystal",
thumb : "sliderthumb_crystal",
topConstraint: -10,bottomConstraint: 326, bg_value : "actualValue_crystal",textfield:"textfield_crystal"});
Event.onDOMReady(function() {
var slider = sliders["slider_crystal"];slider.UpdateField1 = Dom.get("tradegood1Input");slider.subscribe("valueChange", function() {updateColonizeSummary('crystal', slider.actualValue);});
slider.subscribe("slideEnd", function() {slider.UpdateField1.value = slider.actualValue; });
transporterDisplay.registerSlider(slider);});
</script>
           <a class="setMin" href="#reset" onClick="setColonizeMinValue('slider_crystal'); return false;" title="إعادة الإدخال للبداية"><span class="textLabel">أدنى</span></a>
           <a class="setMax" href="#max" onClick="setColonizeMaxValue('slider_crystal'); return false;" title="إرسال كل شيء"><span class="textLabel">أقصى</span></a>
          </div>
          <input class="textfield" id="textfield_crystal" type="text" name="sendcrystal"  value="0" size="4" maxlength="9">
         </li>
<?php }if($city->asulfur>0){?>
         <li class="sulfur"> 
          <label for="textfield_sulfur">إرسال كبريت::</label>
          <div class="sliderinput">
           <div class="sliderbg" id="sliderbg_sulfur">
            <div class="actualValue" id="actualValue_sulfur"></div>
            <div class="sliderthumb" id="sliderthumb_sulfur"></div>
           </div>
<script type="text/javascript">
create_slider({
dir : 'rtl',
id : "slider_sulfur",
<?php 
$sulfurmaxValue = $city->asulfur;
if(($sulfurmaxValue/500) > ($city->aships*500))
 $sulfurmaxValue = $city->aships*500;
?>
maxValue : <?php echo $sulfurmaxValue;?>,
overcharge : 0,
iniValue : 0,
bg : "sliderbg_sulfur",
thumb : "sliderthumb_sulfur",
topConstraint: -10,bottomConstraint: 326, bg_value : "actualValue_sulfur",textfield:"textfield_sulfur"});
Event.onDOMReady(function() {
var slider = sliders["slider_sulfur"];slider.UpdateField1 = Dom.get("tradegood1Input");slider.subscribe("valueChange", function() {updateColonizeSummary('sulfur', slider.actualValue);});
slider.subscribe("slideEnd", function() {slider.UpdateField1.value = slider.actualValue; });
transporterDisplay.registerSlider(slider);});
</script>
           <a class="setMin" href="#reset" onClick="setColonizeMinValue('slider_sulfur'); return false;" title="إعادة الإدخال للبداية"><span class="textLabel">أدنى</span></a>
           <a class="setMax" href="#max" onClick="setColonizeMaxValue('slider_sulfur'); return false;" title="إرسال كل شيء"><span class="textLabel">أقصى</span></a>
          </div>
          <input class="textfield" id="textfield_sulfur" type="text" name="sendsulfur"  value="0" size="4" maxlength="9">
         </li>
<?php }?>
         <li>
 <?php 
 $SumfreeCargo = $city->awood+$city->awine+$city->amarble+$city->acrystal+$city->asulfur;
 $t = $city->aships*500-1250;
 if($t<$SumfreeCargo) $SumfreeCargo = $t;
 ?>
 <script type="text/javascript">
 function setColonizeMinValue(sName) {
 sliders[sName].setActualValue(0);
 transporterDisplay.sliderEnd();
 }
 function setColonizeMaxValue(sName) {
 maxLoadableVal = transporterDisplay.getMaxLoadable(sliders[sName]);
 sliders[sName].setActualValue(maxLoadableVal);
 transporterDisplay.sliderEnd();
 }
 var colonizeSummaries =new Array();
 colonizeSummaries['resource'] = 0;
 colonizeSummaries['wine'] = 0;
 colonizeSummaries['marble'] = 0;
 colonizeSummaries['crystal'] = 0;
 colonizeSummaries['sulfur'] = 0;
 function updateColonizeSummary(sName, sVal) {
 colonizeSummaries[sName] = sVal;
 var sum =  colonizeSummaries['resource'];
 sum +=  colonizeSummaries['wine'];
 sum +=  colonizeSummaries['marble'];
 sum +=  colonizeSummaries['crystal'];
 sum +=  colonizeSummaries['sulfur'];
 Dom.get('sendSummary').innerHTML = sum + '/<?php echo $SumfreeCargo;?>';
}
</script>
          <div class="summaryText">سعة شحن حرة:</div>
          <div class="summary" id="sendSummary">0/<?php echo $SumfreeCargo; ?></div>
         </li>
         </ul>
         <hr />
         <div id="missionSummary">
          <div class="common">
           <div class="journeyTarget"><span class="textLabel">الوجهة:: </span><?php echo $island->name?></div>
           <div class="journeyTime"><span class="textLabel">وقت الرحلة: </span>
<input type="hidden" name="journeyTime" value="<?php echo $island->CalcDesIslandTime($city->iid,$island->iid);?>" />
<?php
	  $time = $generator->getTimeFormat($island->CalcDesIslandTime($city->iid,$island->iid));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
?>
           </div>
           </div>
           <div class="transporters">
            <span class="textLabel">سفن تجارية: </span>
            <span><input id="transporterCount" name="transporters" size="3" maxlength="3" readonly="readonly" value="3" /> / <?php echo $city->aships;?></span>
           </div>
          </div>
          <div class="centerButton">
          <input id="colonizeBtn" class="button" type="submit" value="أسِّس مستعمرة!">
          </div>
         </div>
         <div class="footer"></div>
        </div>
       </form>
        <?php }?>
        <?php if(!$colonizingAvilable){?></div><div class="footer"></div></div><?php }?>
      </div><!-- mainview -->
<?php include("citynavigator.php");?>
<!-- Page footer  -->
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>