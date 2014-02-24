<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$session->changeChecker();
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/renameCity.css" rel="stylesheet" type="text/css" media="screen" />
<?php include("js/js1.php");?>
</head>
<body id="renameCity" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariam</h1>
    <h2>عش في العصور القديمة!</h2>
   </div>
   <div id="avatarNotes"></div>
   <div id="breadcrumbs">
    <h3>أنت هنا:</h3><a href="?view=worldmap_iso&amp;islandX=<?php echo $city->x;?>&amp;islandY=<?php echo $city->y;?>" title="عودة إلى خارطة العالم"><img src="img/resource/icon-world.gif" alt="عالم"><span>&nbsp;&gt;&nbsp;</span></a><a href="?view=island&amp;id=<?php echo $city->iid;?>" class="island" title="عودة إلى الجزيرة" dir="rtl"><?php echo $island->name?>[<?php echo $city->x;?>:<?php echo $city->y;?>]</a><span>&nbsp;&gt;&nbsp;</span><span class="city"><?php echo $city->cname;?></span><span>&nbsp;&gt;&nbsp;</span><span class="building">دار البلدية</span><span>&nbsp;&gt;&nbsp;</span><span class="building">إعادة تسمية المدن</span>
   </div>
   <div id="backTo" class="dynamic">
    <h3 class="header">دار البلدية</h3>
    <div class="content">
     <a href="?view=townHall&amp;id=<?php echo $city->cid;?>&amp;position=0" title="العودة إلى دار البلدية">
     <img src="img/buildings/y100/townHall.gif" width="160" height="100" />
     <span class="textLabel">&lt;&lt; العودة إلى دار البلدية</span></a>
    </div>
    <div class="footer"></div>
   </div>     
   <div id="mainview">
    <h1 style="text-align:center">دار البلدية</h1>
    <form action="action.php"  method="POST">
     <div id="renameCity" class="contentBox01h">
     <h3 class="header">إعادة تسمية المدن</h3>
     <div class="content">
      <input type="hidden" name="action" value="CityScreen" />
      <input type="hidden" name="function" value="rename" />
      <input type="hidden" name="actionRequest" value="<?php echo $session->checker;?>" />
      <input type="hidden" name="id" value="<?php echo $city->cid?>" />
      <div class="oldCityName"><span class="textLabel">اسم المدينة القديم: </span><?php echo $city->cname;?></div>
      <div class="newCityName"><label for="newCityName">اسم جديد للمدينة: </label><input type="text" class="textfield" id="newCityName" name="name" size="30" maxlength="15"/> <input type="submit" class="button" value="قبول اسم المدينة" /></div>
      </div><!--end .content -->
      <div class="footer"></div>
     </div><!-- end .contentBox01 -->
    </form>
   </div><!-- end #mainview -->
<?php include("citynavigator.php");?>
<!-- Page footer  -->
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>