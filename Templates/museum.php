<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$building = new CBuilding;
$session->changeChecker();
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/museum.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<body id="museum" dir="rtl">
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
    <span class="building">متحف</span>
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
  <?php if(($building->currentLevel<18)&&$building->canBuild()&&$building->checkResource(19,$building->currentLevel+1)){?>  
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
   <div class="dynamic" id="assignCulturalGoods">
    <h3 class="header">ابحث عن شريك للمعالم ثقافية</h3>
    <div class="content">
     <p>يمكنك في أمبروزيا القيام ببحث محدد على لاعبين لهم معاهدة معالم ثقافية فارغة.</p>
     <div class="centerButton">
     <a class="button" href="?view=culturalPossessions_search">البحث عن شريك لمعاهد</a>
     </div>
    </div>
    <div class="footer"></div>
   </div>
   <div class="dynamic" id="assignCulturalGoods">
    <h3 class="header">توزيع معالم الثقافة بشكل جديد</h3>
    <div class="content">
     <img src="img/museum/culturalgoods.gif" width="203" height="85" />
     <div class="totalCulturalGoods"><span class="textLabel">مجموع المعالم الثقافة المتوفرة: </span>0</div>
     <p>وزّع معالم الثقافة على متاحف إمبراطوريتك ليسعد بذلك مواطنوك!</p>
     <div class="centerButton">
     <a class="button" href="?view=culturalPossessions_assign">توزيع معالم الثقافة بشكل جديد</a>
     </div>
    </div>
    <div class="footer"></div>
   </div>
   <div id="mainview">
    <div class="buildingDescription">
     <h1>متحف</h1>
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
	  location.href="?view=museum&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>";
	 },2000);
	 });
	});
   </script>
 </div>
<?php }?>  
     <p>في المتحف يمكن لسكان مدينتك أن ينبهروا بالإنجازات الثقافية للشعوب الأخرى. فل يتعلم كل منهم من الآخر، لتعم الفائدة الجميع. عليك توسيع متاحفك لاستقبال معارض أكبر.
إن كل توسيع لمتحفك يسمح لك بعرض معلم ثقافي إضافي.</p>
    </div>
    <div id="culturalGoods" class="contentBox01h">
     <h3 class="header"><span class="textLabel">سلع ثقافية في متحف <?php echo $city->cname;?></span></h3>
     <div class="content">
      <p class="desc">عرضك لمعالم ثقافية من شعوب أخرى سيسعد شعبك المثقف. اعقد المزيد من معاهدات المعالم الثقافية مع لاعبين آخرين لتحصل على قطع أخرى تعرضها في متحفك.</p>
      <div class="goods"><p>المعالم الثقافية في هذا المتحف:<span class="value"><span id="val_culturalGoodsDeposit"></span>0/<?php echo $building->currentLevel;?></span></p></div>
      <p class="result">مواطنوك منبهرون بالمحتويات الغنية والكثيرة في المتحف!<br />سترتفع السعادة في هذه المدينة بنسبة: <span class="value"><?php echo $building->currentLevel*20;?></span>
      </p>
     </div><!-- .content -->
     <div class="footer"></div>
    </div>
    <div class="contentBox01h">
     <h3 class="header">
     <span class="textLabel">شريك المعاهدة</span></h3>
     <div class="content">
      <table cellpadding="0" cellspacing="0">
       <thead><tr><th class="empty"></th><th class="player" scope="col">اسم اللاعب</th><th class="player" scope="col">تحالف</th><th class="capital" scope="col">عاصمة</th><th class="actions" scope="col">تحركات</th><th class="empty"></th></tr></thead>
       <tbody>
        <?php /* <tr >
        <td class="empty"></td>
        <td class="player" >abid-550</td>
        <td class="ally" >صقؤر3</td>
        <td class="capital" >إمبراطورية شمس</td>
        <td class="actions">
         <a class="writeMsg" href="?view=sendIKMessage&receiverId=256730" title="كتابة رسالة"><img src="skin/interface/icon_message_write.gif" alt="كتابة رسالة" /></a>
         <a class="cancelTreaty" href="?view=sendIKMessage&receiverId=256730&msgType=81" title="إلغاء المعاهدة"><img src="skin/interface/icon_treaty_cancel.gif" alt="إلغاء المعاهدة" /></a>
        </td>
        <td class="empty"></td>
        </tr> */?>
       </tbody>
      </table>
     </div><!-- .content -->
     <div class="footer"></div>
    </div><!-- #contentBox01h -->
   </div><!-- end #mainview -->
  
<?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>