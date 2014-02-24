<?php 
if(!isset($_SESSION['sessid']))
	header("Location: index.php");
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/error.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<body id="error" dir="rtl">
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
    <a href="?view=island&amp;id=<?php echo $city->iid;?>" title="عودة إلى الجزيرة">
    <img src="img/resource/icon-island.gif" alt="<?php echo $island->name?>" /><?php echo $island->name?>[<?php echo $island->x;?>:<?php echo $island->y;?>]</a>
   </div>
   <div id="breadcrumbs">

    <h3>أنت هنا:</h3>

    <span class="textLabel">خطأ!</span>

</div>

<div id="information" class="dynamic"></div>

<div id="mainview">

    <div class="buildingDescription">

        <h1>خطأ!</h1>

    </div>

    <div class="contentBox01h">

        <h3 class="header"><span class="textLabel">رسائل خاطئة</span></h3>

        <div class="content">

            <ul class="error">

<li>كن حذرا: الإجراء الأخير غير صحيح. الرجاء عدم استخدام زر الرجوع إلى الخلف في متصفحك، ولا تقم بتحديث الصفحة من جديد.
اذا كنت قد استخدمت رابط في موقع آخر فعليك أن تستخدم زر الإلغاء في المتصفح للحيلولة دون فصل حسابك.</li>            </ul>

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