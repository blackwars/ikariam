<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/city.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?></head>
<body id="city" dir="rtl">
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
  <a href="?view=island&amp;id=<?php echo $city->iid;?>" class="island" title="عودة إلى الجزيرة" dir="rtl"><?php echo $island->name;?>[<?php echo $island->y;?>:<?php echo $island->x;?>]
  </a>
  <span>&nbsp;&gt;&nbsp;</span><span class="city"><?php echo $city->cname;?></span>
  </div>
  <!-- dynamic side-boxes -->
  <div id="information" class="dynamic" style="z-index:1;">
   <h3 class="header"><?php echo $city->cname;?></h3>
   <div class="content">
    <ul class="cityinfo">
     <div class="centerButton">
      <a href="?view=cityMilitary-army&id=<?php echo $city->cid;?>" class="button">القوات في المدينة</a>
     </div>
    </ul>
   </div>
   <!-- end content -->
   <div class="footer"></div>
  </div>
  <div class="dynamic" id="reportInboxLeft">
   <h3 class="header">لائحة بناء المباني</h3>
   <div class="content">
    <img src="img/area_economy.jpg" height="85" width="203">
    <p>لاستعمال لائحة البناء، يجب الحصول على حساب مُمتاز وتفعيله.</p>
    <div class="centerButton">
    <a href="?view=premium" class="button">إيكارياما بلاس</a>
    </div>
   </div>
   <div class="footer"></div>
  </div>
  <div class="dynamic" id="reportInboxLeft">
  <h3 class="header">دعوة الأصدقاء</h3>
  <div class="content">
  <p>هل ترغب أن يبدأ أصدقائك اللعب بالقرب منك؟ بإمكانك دعوتهم انطلاقا من هنا.</p>
  <div class="centerButton">
   <a href="?view=optionsInviteFriends" class="button">دعوة الأصدقاء</a>
  </div>
  </div>
  <div class="footer"></div>
  </div>
  <?php include("citymap.php");?>
  <?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>