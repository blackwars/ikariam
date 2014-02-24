<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
if(isset($_GET['position'])&&($_GET['position']==13)&&($research->GetResearchStatus("R2")<12))
 header("Location: action.php?view=error");
$building = new CBuilding;
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/buildingGround.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?></head>
<body id="buildingGround" dir="rtl">
<div id="container">
 <div id="container2">
<!------------ header-------------->
  <div id="header">
   <h1>إيكارياما ikariama</h1>
   <h2>عش في العصور القديمة!</h2>
  </div>
  <div id="avatarNotes"></div>
  <div id="breadcrumbs">
  <h3>أنت هنا:</h3>
  <a href="?view=worldmap_iso&amp;islandX=<?php echo $city->x;?>&amp;islandY=<?php echo $city->y;?>" title="عودة إلى خارطة العالم"><img src="img/resource/icon-world.gif" alt="عالم"><span>&nbsp;&gt;&nbsp;</span>
  </a>
  <a href="?view=island&amp;id=<?php echo $city->iid;?>" class="island" title="عودة إلى الجزيرة" dir="rtl">Jazeera[<?php echo $city->x;?>:<?php echo $city->y;?>]
  </a>
  <span>&nbsp;&gt;&nbsp;</span><span class="city"><?php echo $city->cname;?></span>
  <span>&nbsp;&gt;&nbsp;</span><span class="building">مكان بناء حر</span>
  </div>
  <!------------ header end-------------->

<!--the main view. take care that it stretches.-->
<div id="mainview">
  <div class="buildingDescription">
    <h1>مكان بناء فارغ</h1>
    <p>إنه مكانٌ كبير فارغ ينتظر منك القيام بأعمال وإنجازات رائعة. أي بناء عظيم تَودُّ مواطنيك تشييده هنا؟</p>
  </div>
  <div class="contentBox01h">
   <h3 class="header">بناء مبنى</h3>
   <div class="content">
    <ul id="buildings">
    <!-- WALL -->
<?php if($_GET['position'] == 14){?>
    <?php if($city->newBuiListChekBuild(5)){?>
    <li class="building wall">
     <div class="buildinginfo">
      <h4>سور المدينة</h4>
      <a href="?view=buildingDetail&buildingId=7"><img src="img/buildings/y100/wall.gif" /></a>
      <p>إن سور المدينة لا يحمي سكانك فقط من العدو بل وكذلك من أشعة الشمس الحارقة. انتبه! فإن الأعداء سيحاولون فتح ثغرات في السور أو تسلقه. كل مستوى إضافي لسور مدينتك يمنح الوحدات المدافعة قوة أكبر.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(5,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=14&building=5&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=14" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(5,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(5,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
     <?php }?>
     <!-- PORT -->
<?php }else if(($_GET['position']==1)||($_GET['position']==2)){?>
 <?php if($city->newBuiListChekBuild(3) && $building->meetRequirement(3)){?>  
     <li class="building port">
     <div class="buildinginfo">
      <h4>مرفأ تجاري</h4>
      <a href="?view=buildingDetail&buildingId=3"><img src="img/buildings/y100/port.gif" /></a>
      <p>المرفأ هو بوابتك على العالم. هنا تستطيع تشغيل العديد من السفن التجارية وتحضيرها لرحلات بعيدة. كما يمكنك استلام بضائع ثمينة من كل أنحاء العالم. يتم شحن سفنك في المرافئ الكبيرة بشكلٍ أسرع.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(3,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=3&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(3,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(3,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
 <?php }?>
     <!-- SHIPYARD -->
 <?php if($city->newBuiListChekBuild(4) && $building->meetRequirement(4)){?>
     <li class="building shipyard">
     <div class="buildinginfo">
      <h4>حوض بناء السفن الحربية</h4>
      <a href="?view=buildingDetail&buildingId=4"><img src="img/buildings/y100/shipyaed.gif" /></a>
      <p>ما الفائدة من إمبراطورية جزيرة من دون أسطولها؟ في حوض بناء السفن الحربية يتم الدفع بالسفن إلى الماء وتحضيرها للقيام برحلات طويلة. فلترتجف منها البحار السبعة! أحواض بناء السفن الأكبر يمكنها إعداد السفن بشكل أسرع.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(4,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=4&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(4,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(4,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
 <?php }?>
     <!-- ACADEMY -->
<?php }else{?>
     <?php if($city->newBuiListChekBuild(1) && $building->meetRequirement(1)){?>
     <li class="building academy">
     <div class="buildinginfo">
      <h4>أكاديمية</h4>
      <a href="?view=buildingDetail&buildingId=7"><img src="img/buildings/y100/academy.gif" /></a>
      <p>الأكاديمية هي مكان الحكمة الأعظم الذي يجمع بين المعرفة والتقاليد القديمة بأحدث التقنيات. أذكى الأدمغة في مدينتك ينتظرون السماح لهم بالدخول! لكن ليكن بعلمك أن كل باحث يحتاج إلى مختبر وهذا أمر سيكلفك بعض المصاريف. كلما كانت الأكاديمية أكبر كلما استطعت تشغيل عدد أكبر من الباحثين في نفس الوقت.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(4,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=1&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(1,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(1,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
     <?php }?>
     <!-- BARRAKS -->
     <?php if($city->newBuiListChekBuild(2) && $building->meetRequirement(2)){?>
     <li class="building barracks">
     <div class="buildinginfo">
      <h4>ثكنة</h4>
      <a href="?view=buildingDetail&buildingId=6"><img src="img/buildings/y100/barracks.gif" /></a>
      <p>في الثكنة يُجعل من الشباب المندفع مقاتلين شجعانا.جنودك يعرفون كيفية استعمال السيف والرمح والمنجنيق ويستطيعون بأنفسهم قيادة الأسلحة الثقيلة إلى أرض المعركة. عندما يتم توسيع الثكنة يصبح باستطاعتك تكوين قواتك بشكل أسرع.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(4,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=2&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(1,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(2,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
     <?php }?>
     <!-- WAREHOUSE -->
     <?php if($building->meetRequirement(6)){?>
     <li class="building warehouse">
     <div class="buildinginfo">
      <h4>منزل التخزين</h4>
      <a href="?view=buildingDetail&buildingId=6"><img src="img/buildings/y100/warehouse.gif" /></a>
      <p>يمكنك خزن جزء من المواد الأولية التابعة لك في منزل التخزين، محمية من النهب كما من المطر والطيور والحشرات. سيكون المسؤول عن المخزن دائماً على اطلاع على كمية مخزونك. إذا قمت بتطوير وتوسيع منزل التخزين فإنك ستتمكن من حماية المزيد من الموارد.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(6,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=6&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(6,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(6,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
     <!-- branchOffice -->
     <?php if($city->newBuiListChekBuild(7) && $building->meetRequirement(7)){?>
     <li class="building branchOffice">
     <div class="buildinginfo">
      <h4>متجر</h4>
      <a href="?view=buildingDetail&buildingId=7"><img src="img/buildings/y100/branchOffice.gif" /></a>
      <p>البائعون والتجار الكبار يقومون بممارسة تجارتهم في المتجر. هناك يمكن القيام بهذا البيع أو ذاك أو تحقيق سعر ممتاز. التجار من بلدان بعيدة يفضلون المرور بالمتاجر الكبيرة والمشهورة! بعد كل درجتي إكمال تطوير يزداد امتداد المتجر</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(7,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=7&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(7,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(7,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
     <!-- PALACE -->
     <?php if($city->newBuiListChekBuild(8) && $building->meetRequirement(8)){?>
     <li class="building palace">
     <div class="buildinginfo">
      <h4>قصر</h4>
      <a href="?view=buildingDetail&buildingId=8"><img src="img/buildings/y100/palace.gif" /></a>
      <p>تستطيع انطلاقاً من قصرك أن تتحكم في أقدار إمبراطوريتك. كما أنك ستتمتع في القصر بمنظر رائع على البحر. سيسمح لك كل مستوى إضافي في إنشاء القصر بعاصمتك بتأسيس مستعمرة إضافية.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(8,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=8&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(8,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(8,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
<?php }?>
     <!-- TAVERN -->
     <?php if($city->newBuiListChekBuild(9) && $building->meetRequirement(9)){?>
     <li class="building tavern">
     <div class="buildinginfo">
      <h4>استراحة</h4>
      <a href="?view=buildingDetail&buildingId=8"><img src="img/buildings/y100/tavern.gif" /></a>
      <p>بعد إنجاز عمل ما، ليس هناك شيء أمتع من شرب عصير العنب البارد. لذلك يجتمع مواطنوك بكل سرور في أماكن الاستراحة حيث يسقى مشروب العنب. وبعد انتهاء النهار الطويل، وابتعاد أنغام الأناشيد مع ريح المساء يتوجهون إلى بيوتهم وهم سعداء وفرحين. كل مستوى إضافي للاستراحة يعنى سقي كمية أكبر من الشراب..</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(9,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=9&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(9,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(9,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
     <!-- SAFEHOUSE -->
<?php if($city->newBuiListChekBuild(10) && $building->meetRequirement(10)){?>
     <li class="building safehouse">
     <div class="buildinginfo">
      <h4>مخبأ</h4>
      <a href="?view=buildingDetail&buildingId=8"><img src="img/buildings/y100/safehouse.gif" /></a>
      <p>يقوم الحاكم الحكيم بمراقبة أصدقاءه وأعداءه بشكل دائم ومستمر. يمكنك أن تشغل في المخبأ جواسيس يخبرونك عن مدن أخرى. مخبأً أكبر يتسع لعدد أكبر من الجواسيس.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(10,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=10&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(10,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(10,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
     <!-- TEMPLE -->
<?php if($city->newBuiListChekBuild(11) && $building->meetRequirement(11)){?>
     <li class="building temple">
     <div class="buildinginfo">
      <h4>مركز</h4>
      <a href="?view=buildingDetail&buildingId=8"><img src="img/buildings/y100/temple.gif" /></a>
      <p>إن المركز مكان للتأمل والاطمئنان. يعيش فيه العظماء، الذين يتبعون وصايا الملوك وينشرون أفكارهم في الجزيرة. يمكنك حتى أنت أن تطلب منهم مكافأة كبيرة، إذا أظهرت لهم احتراما كافياً.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(11,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=11&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(11,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(11,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
     <!-- FORESTER -->
<?php if($city->newBuiListChekBuild(12) && $building->meetRequirement(12)){?>
     <li class="building forester">
     <div class="buildinginfo">
      <h4>بيت الحطاب</h4>
      <a href="?view=buildingDetail&buildingId=8"><img src="img/buildings/y100/forester.gif" /></a>
      <p>إن حطَّابي الخشب الأقوياء يستطيعون إسقاط أضخم الأشجار وأعلاها. كما أن يعلمون تماما أن الغابات يجب أن تكون مزروعة بالأشجار، وأن الأشجار الجديدة تحتاج إلى عناية لكي تنموا، لكي يتعذر استخدامها في بناء المنازل. تزداد كمية إنتاجك لمواد البناء مع كل تطوير لمستوى منزل عمال الغابة بنسبة 2% من القيمة الأساسية.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(12,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=12&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(12,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(12,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
     <!-- WORKSHOP -->
<?php if($city->newBuiListChekBuild(17) && $building->meetRequirement(17)){?>
     <li class="building workshop">
     <div class="buildinginfo">
      <h4>مكان عمل المخترعين</h4>
      <a href="?view=buildingDetail&buildingId=8"><img src="img/buildings/y100/workshop.gif" /></a>
      <p>يسهر أفضل حرفيي ومخترعي المدينة في الورشة على تجهيز جنودنا وسفننا الحربية بالاختراعات الحديثة التي تجعلهم أفضل وتعطيهم قوة ضرب أكبر. كل مستوى إضافي يسمح لك بتحسينات إضافية للوحدات والسفن.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(17,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=17&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(17,1);?>
      </li>
      <li class="marble" title="رخام"><span class="textLabel">رخام</span><?php echo $building->GetBuildingReqMarble(17,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(17,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
     <!-- FIREWORKER -->
<?php if($city->newBuiListChekBuild(18) && $building->meetRequirement(18)){?>
     <li class="building fireworker">
     <div class="buildinginfo">
      <h4>ساحة تجارب الألعاب النارية</h4>
      <a href="?view=buildingDetail&buildingId=8"><img src="img/buildings/y100/fireworker.gif" /></a>
      <p>إن الإضاءة التي تصدر عن الألعاب النارية لا تضيء السماء ليلاً فحسب، بل تضيء أيضاً المباني القريبة من مكان صدورها. لن يتمكن باحثونا من تحسين استهلاك الكبريت إلاّ إذا قاموا بتجريب أنواع مختلفة وجديدة من الخليط. ستتقلص الحاجة لكمية الكبريت لكل مستوى بناء في المدينة بقيمة 1% من القيمة الأساسية.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(18,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=18&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(18,1);?>
      </li>
      <li class="marble" title="رخام"><span class="textLabel">رخام</span><?php echo $building->GetBuildingReqMarble(18,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(18,1));
	  echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
     <!-- MUSEUM -->
<?php if($city->newBuiListChekBuild(19) && $building->meetRequirement(19)){?>
     <li class="building museum">
     <div class="buildinginfo">
      <h4>متحف</h4>
      <a href="?view=buildingDetail&buildingId=8"><img src="img/buildings/y100/museum.gif" /></a>
      <p>في المتحف يمكن لسكان مدينتك أن ينبهروا بالإنجازات الثقافية للشعوب الأخرى. فل يتعلم كل منهم من الآخر، لتعم الفائدة الجميع. عليك توسيع متاحفك لاستقبال معارض أكبر. إن كل توسيع لمتحفك يسمح لك بعرض معلم ثقافي إضافي.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(19,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=19&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(19,1);?>
      </li>
     <li class="marble" title="رخام"><span class="textLabel">رخام</span><?php echo $building->GetBuildingReqMarble(19,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(19,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
     <!-- ARCHITECT -->
<?php if($city->newBuiListChekBuild(20) && $building->meetRequirement(20)){?>
     <li class="building architect">
     <div class="buildinginfo">
      <h4>مكتب المهندس</h4>
      <a href="?view=buildingDetail&buildingId=8"><img src="img/buildings/y100/architect.gif" /></a>
      <p>مسطرة، منقلة وبركار: يتوفر مكتب المهندس على جميع الأدوات التي يمكن احتياجها لبناء سور مستقيم وثابت. كما أن بناء بيت ما بشكل جيد ومتوازن يحتاج إلى كمية أقل من الرخام منه من بناء بيت مائل. ستتقلص الحاجة لكمية الرخام لكل مستوى بناء في المدينة بقيمة 1% من القيمة الأساسية.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(20,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=20&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(20,1);?>
      </li>
     <li class="marble" title="رخام"><span class="textLabel">رخام</span><?php echo $building->GetBuildingReqMarble(20,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(20,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
     <!-- OPTICIAN -->
<?php if($city->newBuiListChekBuild(21) && $building->meetRequirement(21)){?>
     <li class="building optician">
     <div class="buildinginfo">
      <h4>صانع البصريات</h4>
      <a href="?view=buildingDetail&buildingId=8"><img src="img/buildings/y100/optician.gif" /></a>
      <p>إن العدسات والزجاج المكبر لا يساعد فقط علمائنا على الرؤية بوضوح والعثور على الوثائق المهمة الضائعة، بل إنها أيضاً جد مهمة في القيام ببحث التقنيات الجديدة، التي تملئنا افتخاراً. يحتفظ صانع البصريات بكل ما يحتاجه علمائنا ويخزنه بعناية فائقة. هذا يقلل من احتمال تضييع أي شيء كما أنه يقلص من الحاجة إلى البلور مع كل مستوى تطوير لكل مبنى بقيمة 1% من القيمة الأساسية.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(21,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=21&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(21,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(22,1));
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
     <!-- EMBASSY -->
<?php if($city->newBuiListChekBuild(22) && $building->meetRequirement(22)){?>
     <li class="building embassy">
     <div class="buildinginfo">
      <h4>سفارة</h4>
      <a href="?view=buildingDetail&buildingId=8"><img src="img/buildings/y100/embassy.gif" /></a>
      <p>السفارة مكان نشط للغاية: يقوم فيه الدبلوماسيون من جميع أنحاء العالم بالتفاوض حول معاهدات، عقد تحالفات وتأسيس اتحادات. لكي تقوم بتوسيع تحالفك يتوجب عليك توسيع السفارة. ترتفع نقاطك من الدبلوماسية مع كل مستوى إضافي. يمكنك ابتداءً من المستوى 3 تأسيس تحالف..</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(22,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=22&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(2,1);?>
      </li>
      <li class="marble" title="رخام"><span class="textLabel">رخام</span><?php echo $building->GetBuildingReqMarble(22,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(21,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
     <!-- CARPENTERING -->
<?php if($city->newBuiListChekBuild(23) && $building->meetRequirement(23)){?>
     <li class="building carpentering">
     <div class="buildinginfo">
      <h4>مبنى النجارة</h4>
      <a href="?view=buildingDetail&buildingId=8"><img src="img/buildings/y100/carpentering.gif" /></a>
      <p>في ورشة النجارة لا تستعمل سوى الأخشاب ذات الجودة العالية، مما يُمكن حرفيونا المهرة من بناء أسس متينة لبيوتنا. مما سيوفر علينا إصلاحها بشكل مستمر. ستنخفض احتياجات مباني مدينتك لمواد البناء مع كل مستوى من مستويات النجارة بنسبة 1% من القيمة الأساسية.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(23,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=23&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(2,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(23,1));
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
     <!-- VINEYARD -->
<?php if($city->newBuiListChekBuild(24) && $building->meetRequirement(24)){?>
     <li class="building vineyard">
     <div class="buildinginfo">
      <h4>عصارة العنب</h4>
      <a href="?view=buildingDetail&buildingId=8"><img src="img/buildings/y100/vineyard.gif" /></a>
      <p>يتم تخزين أحلى وأطيب عصير عنب في أعماق القبو البارد ليكتسب نكهته ومذاقه اللذيذين. يقوم مالك القبو بالحرص على عدم تضييع أي قطرة منه وعلى توفيره للمواطنين ليطفؤوا به ظمئهم. ستتقلص الحاجة لكمية عصير العنب مع كل مستوى بناء لمبنى حفظ العنب في المدينة بقيمة 1% من القيمة الأساسية.</p>
     </div>
     <hr />
   <?php if($building->canBuild()){?>
     <?php if($building->checkResource(24,1)){?>
     <div class="centerButton">
       <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=CityScreen&function=build&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>&building=24&actionRequest=<?php echo $session->checker;?>">
       <span class="textLabel">نعم! ابدأ البناء!</span></a>
     </div>
     <?php }else{?>
     <p class="cannotbuild">مواد أولية قليلة!<br /><a class="premiumExchange" href="?view=premiumTrader&oldView=buildingGround&id=<?php echo $city->cid;?>&position=<?php echo $_GET['position'];?>" title="مبادلة الموارد"><img src="img/premium/ambrosia_icon.gif" alt="">هل ترغب حقا في المبادلة؟</a></p>
     <?php }}else{?>
     <p class="cannotbuild">يوجد مبنى في مرحلة  البناء!(<a href="?view=premiumDetails">متابعة البناء؟</a>)</p>
   <?php }?>
     <div class="costs">
     <h5>التكاليف</h5>
     <ul class="resources">
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية</span><?php echo $building->GetBuildingReqWood(24,1);?>
      </li>
     <li class="marble" title="رخام"><span class="textLabel">رخام</span><?php echo $building->GetBuildingReqMarble(24,1);?>
      </li>
      <li class="time" title="وقت البناء: "><span class="textLabel">وقت البناء: </span>
      <?php $time = $generator->getTimeFormat($building->GetBuildingReqTime(24,1));
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
     </div>
     </li>
<?php }?>
<?php }?>
    </ul>
   </div>
   <div class="footer"></div>
  </div> 
</div><!-- end #mainview -->
<?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>