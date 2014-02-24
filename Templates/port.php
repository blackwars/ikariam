<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$building = new CBuilding;
$session->changeChecker();
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/port.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<body id="port" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariam</h1>
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
    <span class="building">مرفأ تجاري</span>
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
  <?php if(($building->currentLevel<18)&&$building->canBuild()&&$building->checkResource(3,$building->currentLevel+1)){?>    
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
   <div class="dynamic">
    <h3 class="header">سعة الناقلة
    <a class="help" href="?view=shipdescription&shipId=201" title="مساعدة"><span class="textLabel">مساعدة?</span></a>
    </h3>
    <div class="content">
     <p>السفن التجارية متوافرة دائماً هناك حيثما الحاجة إليها.</p>
     <p><strong>سعة كل سفينة تجارية: </strong>
     <?php echo $city->getLoadSpeed();?></p>
    </div>
    <div class="footer"></div>
   </div>
   <div id="mainview">
    <div class="buildingDescription">
    <h1>مرفأ تجاري</h1>
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
	  location.href="?view=port&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>";
	 },2000);
	 });
	});
   </script>
 </div>
<?php }?>
    <p>المرفأ هو بوابتك على العالم. هنا تستطيع تشغيل العديد من السفن التجارية وتحضيرها لرحلات بعيدة. كما يمكنك استلام بضائع ثمينة من كل أنحاء العالم.
يتم شحن سفنك في المرافئ الكبيرة بشكلٍ أسرع.</p>
    </div>
    <div class="contentBox01h">
     <h3 class="header">
     <span class="textLabel">شراء سفينة تجارية</span>
     </h3>
     <div class="content">
      <ul id="units">
      <li class="unit">
       <div class="unitinfo">
        <h4>سفن تجارية</h4>
        <a title="تعلم اكثر عن سفن تجارية..." href="?view=shipdescription&shipId=201">
        <img src="img/characters/fleet/120x100/ship_transport_r_120x100.gif" /></a>
        <div class="unitcount">
         <span class="textLabel">متوفر: </span>
         <?php echo $city->ships;?>
        </div>
        <p>السفن التجارية هي الدعم الأهم لامبراطوريتك. سواء تعلق الأمر بنقل الوحدات، البضائع أو الأخبار فإن بحارتك سوف يحرصون على أن يصل كل شيء أرسلته بأمان وبسرعة إلى مكانه المقصود.</p>
       </div>
       <label for="textfield_">شراء سفينة تجارية:</label>
       <?php if((pow($city->ships,2)*20+600) <= $city->gold){?>
       <div class="forminput">حد أقصى: 160<br>
        <div class="leftButton">
         <a href="?action=CityScreen&function=increaseTransporter&actionRequest=<?php echo $session->checker;?>&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" class="button bigButton">شراء سفينة تجارية</a>
         </div>
        </div>
       <?php }else{?>
       <div class="forminput">حد أقصى: 160<br>
        لا يوجد ما يكفي من الذهب.
        </div>
       <?php }?> 
       <div class="costs">
         <ul class="resources">
         <li class="gold">
          <span class="textLabel">ذهب: </span>
          <?php echo pow($city->ships,2)*20+600;?>
         </li>
         </ul>
        </div> 
      </li>
      </ul>
     </div><!-- end .content -->
     <div class="footer"></div>
    </div><!-- contentBox01h -->
    <div class="contentBox01h">
        <h3 class="header">
        <span class="textLabel">إرسال سفينة نقل تجارية</span>
        </h3>
        <div class="content">
         <ul class="cities">
         <!--<li>
          <a title="نقل إلى ޒ kilea ޒ" href="?view=transport&destinationCityId=557486">(77:47) ޒ kilea ޒ</a> 
         </li>-->
         </ul>
        </div>
        <div class="footer"></div>
      </div><!-- contentBox01h -->
    <div class="contentBox01h" style="z-index:100">
      <h3 class="header">
      <span class="textLabel">جاري شحن الأساطيل</span>
      </h3>
      <div class="content master">
       <div class="tcap">سفنك التجارية</div>
       <p>لم يتم بعد تسجيل أي سفينة عند مدير المرفأ</p>
       <div class="tcap">سفن غريبة</div>
       <p>لم يتم بعد تسجيل أي سفينة عند مدير المرفأ</p>
      </div>
      <div class="footer"></div>
     </div><!-- contentBox01h -->
    <div class="contentBox01h" style="z-index:50;">
      <h3 class="header">
      <span class="textLabel">تجار قادمون</span></h3>
      <div class="content master">
       <p>لم يتم بعد تسجيل أي سفينة عند مدير المرفأ</p>
      </div>
      <div class="footer"></div>
     </div><!-- contentBox01h -->
   </div><!-- end #mainview -->

<?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>