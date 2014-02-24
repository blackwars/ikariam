<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$building = new CBuilding;
$session->changeChecker();
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/researchOverview.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<body id="researchOverview" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariam</h1>
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
    <span class="building">أكاديمية</span><span>&nbsp;&gt;&nbsp;</span><span class="building">مكتبة</span>
   </div>
   <div id="backTo" class="dynamic">
    <h3 class="header">أكاديمية</h3>
    <div class="content">
     <a href="#" title="العودة إلى أكاديمية">
     <img src="img/buildings/y100/academy.gif" width="160" height="100" />
     <span class="textLabel">&lt;&lt; العودة إلى أكاديمية</span></a>
    </div>
    <div class="footer"></div>
   </div>
   <div id="mainview">
    <div class="buildingDescription">
     <h1>الأبحاث حتى الآن</h1>
     <p>في المكتبة قام باحثونا بأرشفة كل الإنجازات حتى الآن. الزائر المهتم يمكنه هنا أن يطلع على كل الأبحاث بهدوء.</p>
    </div><!-- end buildingDescription -->
    <div class="contentBox01h">
     <h3 class="header"><span class="textLabel">البحوث المنجزة حتّى الآن</span></h3>
     <div class="content">
      <h4>إبحار</h4>
      <ul>
      <?php /*  <li class="<?php if($research->GetResearchStatus("R1")>0)echo"explored";else echo"unexplored";?>"><a href="?view=researchDetail&id=64113&position=9&researchId=2150"title="حِرفة النجارة">حِرفة النجارة</a></li>  */?>
      <li class="<?php if($research->GetResearchStatus("R1")>0)echo"explored";else echo"unexplored";?>"><a href="?view=researchDetail&id=64113&position=9&researchId=1010"title="أسلحة تغطية">أسلحة تغطية</a></li>
      <li class="<?php if($research->GetResearchStatus("R1")>1)echo"explored";else echo"unexplored";?>"><a href="?view=researchDetail&id=64113&position=9&researchId=1020"title="صيانة سفينة">صيانة سفينة</a></li>
      <li class="<?php if($research->GetResearchStatus("R1")>2)echo"explored";else echo"unexplored";?>"><a href="?view=researchDetail&id=64113&position=9&researchId=1030"title="توسيع">توسيع</a></li>
      <li class="<?php if($research->GetResearchStatus("R1")>3)echo"explored";else echo"unexplored";?>"><a href="?view=researchDetail&id=64113&position=9&researchId=1040"title="ثقافات أجنبية" >ثقافات أجنبية</a></li>
      <li class="<?php if($research->GetResearchStatus("R1")>4)echo"explored";else echo"unexplored";?>"><a href="?view=researchDetail&id=64113&position=9&researchId=1050"title="زفت">زفت</a></li>
      <li class="<?php if($research->GetResearchStatus("R1")>5)echo"explored";else echo"unexplored";?>"><a href="?view=researchDetail&id=64113&position=9&researchId=2070"title="سوق">سوق</a></li>
      <li class="<?php if($research->GetResearchStatus("R1")>6)echo"explored";else echo"unexplored";?>"><a href="?view=researchDetail&id=64113&position=9&researchId=1060"title="نار يونانية">نار يونانية</a></li>
      <li class="<?php if($research->GetResearchStatus("R1")>7)echo"explored";else echo"unexplored";?>"><a href="?view=researchDetail&id=64113&position=9&researchId=1070"title="وزن مضاد">وزن مضاد</a></li>
      <li class="<?php if($research->GetResearchStatus("R1")>8)echo"explored";else echo"unexplored";?>"><a href="?view=researchDetail&id=64113&position=9&researchId=1080"title="ديبلوماسية">ديبلوماسية</a></li>

        <li class="<?php if($research->GetResearchStatus("R1")>9)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=1090"       title="خرائط بحرية"    >خرائط بحرية</a>    </li>

        <li class="<?php if($research->GetResearchStatus("R1")>10)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=1100"       title="محرك طارة السفينة"    >محرك طارة السفينة</a>    </li>

        <li class="<?php if($research->GetResearchStatus("R1")>11)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=1110"       title="مثبت الهاون"    >مثبت الهاون</a>    </li>

        <li class="<?php if($research->GetResearchStatus("R1")>12)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=1999"       title="مستقبل الإبحار"    >مستقبل الإبحار</a>    </li>
        </ul><br/>
        <hr /><h4>اقتصاد</h4>
        <ul>
        <li class="<?php if($research->GetResearchStatus("R2")>0)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=2010"       title="حفظ"    >حفظ</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R2")>1)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=2020"       title="رافعة"    >رافعة</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R2")>2)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=2030"       title="الرفاهية"    >الرفاهية</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R2")>3)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=2040"       title="معصرة العنب"    >معصرة العنب</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R2")>4)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=2130"       title="تحسين طريقة جمع الموارد"    >تحسين طريقة جمع الموارد</a>    </li>        <li class="<?php if($research->GetResearchStatus("R2")>5)echo"explored";else echo"unexplored";?>">
    <a href="?view=researchDetail&id=64113&position=9&researchId=2060"       title="هندسة"    >هندسة</a>    </li>        
    <li class="<?php if($research->GetResearchStatus("R2")>6)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=1120"       title="الهندسة المعمارية"    >الهندسة المعمارية</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R2")>7)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=2080"       title="عطلة استجمام"    >عطلة استجمام</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R2")>8)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=2050"       title="مذاق مميز"    >مذاق مميز</a>
    </li>
        <li class="<?php if($research->GetResearchStatus("R2")>9)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=2090"       title="أعمال مساعدة"    >أعمال مساعدة</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R2")>10)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=2100"       title="ميزان الماء"    >ميزان الماء</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R2")>11)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=2140"       title="معصرة العنب"    >معصرة العنب</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R2")>12)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=2110"       title="بيروقراطية"    >بيروقراطية</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R2")>13)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=2120"       title="يوتوبيا"    >يوتوبيا</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R2")>14)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=2999"       title="مستقبل الاقتصاد"    >مستقبل الاقتصاد</a>    </li>
        </ul>
        <br/><hr /><h4>معرفة</h4>
        <ul>
        <li class="<?php if($research->GetResearchStatus("R3")>0)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3010"       title="بناء البئر"    >بناء البئر</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>1)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3020"       title="ورق"    >ورق</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>2)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3030"       title="تجسس"    >تجسس</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>3)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3040"       title="الملكية"    >الملكية</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>4)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3050"       title="حبر"    >حبر</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>5)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3140"       title="اختراع"    >اختراع</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>6)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3060"       title="تبادل ثقافي"    >تبادل ثقافي</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>7)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3070"       title="تشريح"    >تشريح</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>8)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3080"       title="البصريات"    >البصريات</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>9)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3081"       title="تجارب"    >تجارب</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>10)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3090"       title="قلم ميكانيكي"    >قلم ميكانيكي</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>11)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3100"       title="طيران الطائر"    >طيران الطائر</a>
    </li>        <li class="<?php if($research->GetResearchStatus("R3")>12)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3110"       title="بريد أنبوب"    >بريد أنبوب</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>13)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3120"       title="حُجرات الضغط"    >حُجرات الضغط</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>14)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3130"       title="قانون أرخميدوس"    >قانون أرخميدوس</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R3")>15)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=3999"       title="مستقبل العلوم"    >مستقبل العلوم</a>    </li>
        </ul>
        <br/><hr /><h4>جيش</h4>
        <ul>
        <li class="<?php if($research->GetResearchStatus("R4")>0)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4010"       title="حوض سفن جاف"    >حوض سفن جاف</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R4")>1)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4020"       title="خرائط"    >خرائط</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R4")>2)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4030"       title="جيش محترف"    >جيش محترف</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R4")>3)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4040"       title="محاصرة"    >محاصرة</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R4")>4)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4050"       title="قانون الشرف"    >قانون الشرف</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R4")>5)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4060"       title="عِلم المقذوفات"    >عِلم المقذوفات</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R4")>6)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4070"       title="قانون الرفع"    >قانون الرفع</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R4")>7)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4080"       title="حاكم"    >حاكم</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R4")>8)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4130"       title="تقنية الألعاب النارية"    >تقنية الألعاب النارية</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R4")>9)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4090"       title="نقل الإمدادات"    >نقل الإمدادات</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R4")>10)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4100"       title="بارود"    >بارود</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R4")>11)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4110"       title="علم الإنسان الآلي"    >علم الإنسان الآلي</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R4")>12)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4120"       title="صب المدافع"    >صب المدافع</a>    </li>
        <li class="<?php if($research->GetResearchStatus("R4")>13)echo"explored";else echo"unexplored";?>">    <a href="?view=researchDetail&id=64113&position=9&researchId=4999"       title="مستقبل الجيش"    >مستقبل الجيش</a>    </li>
    </ul>
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
