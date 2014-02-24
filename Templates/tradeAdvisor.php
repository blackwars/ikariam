<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");

?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/tradeAdvisor.css" rel="stylesheet" type="text/css" media="screen" />
<?php include("js/js1.php");?>
</head>
<body id="tradeAdvisor" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariam</h1>
    <h2>عش في العصور القديمة!</h2>
   </div>
   <div id="avatarNotes"></div>
   <div id="breadcrumbs">
    <h3>أنت هنا:</h3>
    <a href="?view=worldmap_iso&amp;islandX=<?php echo $city->x;?>&amp;islandY=<?php echo $city->y;?>" class="world" title="عودة إلى خارطة العالم">عالم</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="building">رئيس البلدية</span>
   </div>
   <div class="dynamic" id="viewCityImperium">
    <h3 class="header">نظرة مُعلم البناء</h3>
    <div class="content">
     <img src="img/premium/sideAd_premiumTradeAdvisor.jpg" width="203" height="85" />
     <p>إدارة العديد من المستعمرات؟ ستمنحك</strong> نظرة رئيس عمال البناء <strong> إمكانية  السيطرة على كل مدنك!</p>
     <div class="centerButton">
     <a href="?view=premiumDetails" class="button">أنظر الآن</a>
     </div>
    </div>
    <div class="footer"></div>
   </div>
   <div id="mainview">
    <div class="buildingDescription">
     <h1>رئيس البلدية</h1>
     <p></p>
    </div>
    <div class="yui-navset">
     <ul class="yui-nav"  >
     <li  class="selected">
      <a href="?view=tradeAdvisor"title="أخبار المدينة"><em>أخبار المدينة</em></a>
     </li>
     <li >
      <a href="?view=tradeAdvisorTradeRoute"title="الطرق التجارية"><em>الطرق التجارية</em></a>
     </li>
     </ul>
    </div>
    <div class="contentBox01h">
     <h3 class="header">أحداث حالية (<?php echo $log->getAvatarLogCount();?>)</h3>
     <div class="content">
     <table cellpadding="0" cellspacing="0" class="table01" id="inboxCity">
      <thead>
      <tr>
      <th></th><th colspan="2">موقع</th><th>تاريخ</th><th>موضوع</th><th></th></tr>
      </thead>
      <tbody>
       <?php 
	   if(isset($_GET["offset"]))
	    $log->getAvatarLog($_GET["offset"]);
	   else
	    $log->getAvatarLog(0);
	   ?>
      </tbody>
     </table>
     </div>
     <div class="footer"></div>
    </div>
   </div>
<?php include("citynavigator.php");?>
<!-- Page footer  -->
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>