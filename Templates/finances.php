<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");

?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/finances.css" rel="stylesheet" type="text/css" media="screen" />
<?php include("js/js1.php");?>
</head>
<body id="finances" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariama</h1>
    <h2>عش في العصور القديمة!</h2>
   </div>
   <div id="avatarNotes"></div>
   <div id="breadcrumbs">
    <h3>أنت هنا:</h3>
    <span class="textLabel">موازنة كل التمويلات</span>
   </div>
   <div id="backTo" class="dynamic">
    <h3 class="header">عودة إلى المدينة</h3>
    <div class="content">
        <a href="?view=city&id=<?php echo $city->cid;?>" title="عودة إلى المدينة">
        <img src="img/action_back.gif" width="160" height="100" alt="" />
        <span class="textLabel">&lt;&lt; عودة إلى المدينة</span></a>
    </div>
    <div class="footer"></div>
   </div>
   <div id="mainview">
    <h1>موازنات</h1>
    <table cellspacing="0" id="balance" class="table01">
    <tr>
     <td class="sigma">كمية الذهب</td>
     <td class="value res"></td>
     <td class="value res"></td>
     <td class="value res"><?php echo number_format($city->gold);?></td>
    </tr>
    </table>
    <table cellspacing="0" id="balance" class="table01">
    <tr>
    <th class="city"><img src="img/icon-city2.gif" alt="مدينة" /></th><th>الدَّخل</th><th>علماء</th><th>نتيجة</th>
    </tr>
<?php 
$SUMincomegold = 0;
$SUMgold = 0;
$SUMcostSC = 0;
for($i=0; $i<count($session->cities); $i++){
$cid = $session->cities[$i];
$cname =  $database->getCityField($cid,"name");
$incomegold = $city->CalcIncomegold($cid);
$gold = $database->getCityField($cid,"citizens") * 3;
$unitsinsurance = $city->CalcUnitsInsurance($cid);
$shipsinsurance = $city->CalcShipsInsurance($cid);
$costSC = $database->getCityField($cid,"scientists")*9;
$SUMincomegold += $incomegold;
$SUMgold += $gold;
$SUMcostSC += $costSC;
?>
    <tr >
     <td class="city"><?php echo $cname;?></td>
     <td class="value res"><?php echo number_format($gold);?></td>
     <td class="value res"><?php echo number_format($costSC);?></td>
     <td class="value res"><?php echo number_format($gold - $costSC);?></td>
    </tr>
<?php }?>
    <tr class="result">
     <td class="sigma"><img src="img/sigma.gif" alt="مجموع" /></td>
     <td class="value res"><?php echo number_format($SUMgold);?></td>
     <td class="value res"><?php echo number_format($SUMcostSC);?></td>
     <td class="value res"><?php echo number_format($SUMgold-$SUMcostSC);?></td>
    </tr>
    </table>
    <table cellspacing="0" cellpadding="0" id="upkeepReductionTable" class="table01" border="0px">
    <tr>
    <th colspan="4">الأسعار الأساسية</th>
    </tr>
    <tr >
     <td class="reason">قوات</td>
     <?php $UnitsAllUpkeep = $units->CalcUpkeep();?>
     <td class="costs"><?php echo number_format($UnitsAllUpkeep);?></td>
     <td class="bar"><div class="greenBarDiv barBorder" style="width:99%" title="تكاليف">
     <div class="brownBarDiv" style="width:100%" title="تكاليف">
     </div></div>
     </td>
     <td class="hidden"></td>
    </tr>
    <tr class="altbottomLine">
     <td class="reason">- البحث (<?php echo $units->UpkeepDiscount;?>%)</td>
     <?php $Unitsboldcosts=round($UnitsAllUpkeep-$UnitsAllUpkeep*$units->UpkeepDiscount/100);?>
     <td class="boldcosts"><?php echo number_format($Unitsboldcosts);?></td>
     <td class="bar"><div class="greenBarDiv barBorder" style="width:99%" title="تكاليف">
     <div class="brownBarDiv" style="width:<?php echo 100-$units->UpkeepDiscount;?>%" title="تكاليف">
     </div></div>
     </td>
     <td class="hidden"><?php echo number_format($Unitsboldcosts);?></td>
    </tr>
    <tr>
     <td class="reason">أساطيل</td>
     <?php $ShipsAllUpkeep = $ships->CalcUpkeep();?>
     <td class="costs"><?php echo number_format($ShipsAllUpkeep);?></td>
     <td class="bar"><div class="greenBarDiv barBorder" style="width:99%" title="تكاليف">
     <div class="brownBarDiv" style="width:100%" title="تكاليف">
     </div></div>
     </td>
     <td class="hidden"></td>
    </tr>
    <tr class="altbottomLine">
     <td class="reason">- البحث (<?php echo $ships->UpkeepDiscount;?>%)</td>
     <?php $Shipsboldcosts=round($ShipsAllUpkeep-$ShipsAllUpkeep*$ships->UpkeepDiscount/100);?>
     <td class="boldcosts"><?php echo number_format($Shipsboldcosts);?></td>
     <td class="bar"><div class="greenBarDiv barBorder" style="width:99%" title="تكاليف">
     <div class="brownBarDiv" style="width:<?php echo 100-$ships->UpkeepDiscount;?>%" title="تكاليف">
     </div></div>
     </td>
     <td class="hidden"><?php echo number_format($Shipsboldcosts);?></td>
    </tr>
    <tr class="result">
     <td class="reason"><img src="img/sigma.gif" alt="مجموع" /></td>
     <td class="costs"></td>
     <td class="bar"></td>
     <td class="hidden"><?php echo number_format($Unitsboldcosts+$Shipsboldcosts);?></td>
    </tr>
    </table>
    <table cellspacing="0" cellpadding="0" id="upkeepReductionTable" class="table01" border="0px">
    <tr>
    <th colspan="4">تكاليف التأمين</th>
    </tr>
    <tr >
     <td class="reason">قوات</td>
     <td class="costs">0</td>
     <td class="bar"><div class="greenBarDiv barBorder" style="width:99%" title="تكاليف">
     <div class="brownBarDiv" style="width:100%" title="تكاليف">
     </div></div>
     </td>
     <td class="hidden"></td>
    </tr>
    <tr class="altbottomLine">
     <td class="reason">- البحث (<?php echo $units->UpkeepDiscount;?>%)</td>
     <td class="boldcosts">0</td>
     <td class="bar"><div class="greenBarDiv barBorder" style="width:99%" title="تكاليف">
     <div class="brownBarDiv" style="width:<?php echo 100-$units->UpkeepDiscount;?>%" title="تكاليف">
     </div></div>
     </td>
     <td class="hidden">0</td>
    </tr>
    <tr >
     <td class="reason">أساطيل</td>
     <td class="costs">0</td>
     <td class="bar"><div class="greenBarDiv barBorder" style="width:99%" title="تكاليف">
     <div class="brownBarDiv" style="width:100%" title="تكاليف">
     </div></div>
     </td>
     <td class="hidden"></td>
    </tr>
    <tr class="altbottomLine">
     <td class="reason">- البحث (<?php echo $ships->UpkeepDiscount;?>%)</td>
     <td class="boldcosts">0</td>
     <td class="bar"><div class="greenBarDiv barBorder" style="width:99%" title="تكاليف">
     <div class="brownBarDiv" style="width:<?php echo 100-$ships->UpkeepDiscount;?>%" title="تكاليف">
     </div></div>
     </td>
     <td class="hidden">0</td>
    </tr>
    <tr class="result">
     <td class="reason"><img src="img/sigma.gif" alt="مجموع" /></td>
     <td class="costs"></td>
     <td class="bar"></td>
     <td class="hidden">0</td>
    </tr>
    </table>
    <table cellspacing="0" cellpadding="0" id="upkeepReductionTable" class="table01" border="0px">
    <tr><th colspan="4">مجموع</th></tr>
    <tr>
     <td class="reason">الدَّخل</td>
     <td class="costs"></td>
     <td class="bar">
     <div class="greenBarDiv barBorder" style="width:99%" title="الدَّخل">
     <div class="brownBarDiv" style="width: 100%" title="الدَّخل">
     </div></div>
     </td>
     <td class="hidden"><?php echo number_format($SUMgold-$SUMcostSC);?></td>
    </tr>
    <tr>
     <td class="reason"> - تأمين</td>
     <td class="costs"></td>
     <td class="bar">
     <div class="redBarDiv barBorder" style="width:99%" title="تكاليف">
     <div class="brownBarDiv" style="width: <?php echo 100-($Unitsboldcosts+$Shipsboldcosts)*100/($SUMincomegold);?>%" title="الدَّخل">
     </div></div>
     </td>
     <td class="hidden"><?php echo number_format($Unitsboldcosts+$Shipsboldcosts);?></td>
    </tr>
    <tr class="result">
     <td class="reason"><img src="img/sigma.gif" alt="مجموع" /></td>
     <td class="costs"></td>
     <td class="bar"></td>
     <td class="hidden"><?php echo number_format($SUMincomegold);?></td>
    </tr>
    </table>
   </div>
<?php include("citynavigator.php");?>
<!-- Page footer  -->
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>