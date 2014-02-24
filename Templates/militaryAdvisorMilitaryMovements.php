<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$session->changeChecker();
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/militaryAdvisorMilitaryMovements.css" rel="stylesheet" type="text/css" media="screen" />
<?php include("js/js1.php");?>
</head>
<body id="militaryAdvisorMilitaryMovements" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariam</h1>
    <h2>عش في العصور القديمة!</h2>
   </div>
  <div id="breadcrumbs">
    <h3>أنت هنا:</h3>
    <a href="?view=worldmap_iso&amp;islandX=<?php echo $city->x;?>&amp;islandY=<?php echo $city->y;?>" class="world" title="عودة إلى خارطة العالم">عالم</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="building">مستشار الجيش</span>
  </div>
  <div class="dynamic" id="viewMilitaryImperium">
   <h3 class="header">نظرة عامة عسكرية</h3>
   <div class="content">
    <img src="img/premium/sideAd_premiumMilitaryAdvisor.jpg" width="203" height="85" />
    <p>عندما يتقدم جناح جيشك الأيمن من الجهة اليسرى، فإن الوقت سيكون قد حان لنظرة عامة أوضح. هذه النظرة العامة هي مكانك الشخصي لتحافظ على السيطرة على رجل الميدان.</p>
    <div class="centerButton">
     <a href="?view=premiumDetails" class="button">أنظر الآن</a>
    </div>
   </div>
   <div class="footer"></div>
  </div>
  <div id="mainview">
   <div class="buildingDescription">
    <h1>جيش</h1>
    <p></p>
   </div>
   <div class="yui-navset">
    <ul class="yui-nav">
    <li  class="selected"><a
        href="?view=militaryAdvisorMilitaryMovements"
        title="تحركات القوات"><em>تحركات القوات (<?php echo $transport->getTransportsCount();?>)</em></a></li>
    <li ><a
        href="?view=militaryAdvisorCombatReports"
        title="تقارير القتال"><em>تقارير القتال (0)</em></a></li>
    <li><a href="?view=militaryAdvisorCombatReportsArchive"
        title="أرشيف"><em>أرشيف</em></a></li>
    </ul>
   </div>
   <div id="combatsInProgress" class="contentBox">
    <h3 class="header">أحداث حالية</h3>
    <div class="content">
     <ul>
     </ul>
    </div>
    <div class="footer"></div>
   </div>
   <div id="fleetMovements" class="contentBox">
    <h3 class="header"><span class="textLabel">تحركات الجيوش / الأساطيل</span></h3>
    <div class="content">
     <table width="100%" cellpadding="0" cellspacing="0"class="locationEvents">
      <tr style="font-weight: bold; background-color: #faeac6; background-repeat: repeat-x;">
       <td style="background-repeat: repeat-x; width: 35px; padding: 0"></td>
       <td style="width: 50px;"></td>
       <td style="width: 150px;">وحدات</td>
       <td>أصل</td>
       <td colspan="3" style="width: 80px; text-align: center;">مهمة</td>
       <td>الهدف</td>
       <td style="width: 42px">تحرك</td>
      </tr>
      <?php /*
      <tr >
       <td><img src="img/resource/icon_time.gif" /></td>
       <td id="fleetRow492309391" title="ساعة الوصول">
       9د 55ث
       </td>
       <td title="عدد" style="cursor: pointer" onMouseOut="this.firstChild.nextSibling.style.display = 'none'" onMouseOver="this.firstChild.nextSibling.style.display = 'block'">
       8 سفن
       <div class="tooltip2" style="z-index: 2000"><h5>أسطول / وحدات / الشحن</h5>
        <div class="info">يمكنك إيجاد معلومات إضافية عن الأسطول باستعمال 1 أمبروزيا.<a href="?action=transportOperations&function=getFleetInfoForPremium&id=49230939&occupier=1&oldview=militaryAdvisorMilitaryMovements&actionRequest=21bacd7ee829fea4edc40cecff6a7fdd">اضغط هنا.</a>
        </div>
       </div>
       </td>
       <td title="أصل">
        <a href="?view=island&cityId=572718">محافظة</a> (zgoum)
       </td>
       <td style='width: 12px; padding-left: 0px; padding-right: 0px'>
       </td>
       <td style="text-align: center; width: 35px" title="نقل (يتم التحميل)"><img src="img/interface/mission_transport.gif" />
       </td>
       <td style='width: 12px; padding-left: 0px; padding-right: 0px'></td>
       <td title="الهدف"><a href="?view=island&cityId=560388">? Donien ?</a> (Alocardo)</td>
       <td title="تحركات" style="text-align: center; "></td>
      </tr>
	  */?>
<?php for($i=0; $i<$transport->getTransportsCount(); $i++){?>
      <tr  class='own own'><?php /* hostile*/ ?>
       <td><img src="img/resource/icon_time.gif" /></td>
       <td id="fleetRow<?php echo $i;?>" title="ساعة الوصول">
<?php 
$isLoading = $transport->getTransportInfo($i, "loadingEndTime")>time();
?>
       <?php
	if($isLoading)
	 $t = $transport->getTransportInfo($i, "loadingEndTime");
	else
	 $t = $transport->getTransportInfo($i, "endTime");
	    $time = $generator->getTimeFormat($t-time());
	    if($time["d"]) echo $time["d"]."يوم ";
	    if($time["h"] && $time["d"]) echo $time["h"]."س ";
	    else if($time["h"]) echo $time["h"]."ساعة ";
	    if($time["m"] && $time["h"]) echo $time["m"]."د ";
	    else if($time["m"]) echo $time["m"]."دقيقة ";
	    if($time["s"]) echo $time["s"]."ث ";
       ?>
       </td>
       <td title="عدد" style="cursor: pointer" onMouseOut="this.firstChild.nextSibling.style.display = 'none'" onMouseOver="this.firstChild.nextSibling.style.display = 'block'">
       <?php echo $transport->getTransportInfo($i, "ships");?> سفن <?php /* / 16 وحدات */?>
       <div class="tooltip2" style="z-index: 2000">
         <h5>أسطول / وحدات / الشحن</h5>
         <div class="unitBox" title="سفن تجارية">
          <div class="icon"><img src="img/characters/fleet/40x40/ship_transport_r_40x40.gif" /></div>
          <div class="count"><?php echo $transport->getTransportInfo($i, "ships");?></div>
         </div>
         <?php for($u=7; $u<12; $u++){?>
          <?php if($transport->getTransportInfo2($i,$u)){?>
          <div class="unitBox" title="<?php echo $transport->getUnitArName($u);?>">
           <div class="iconSmall"><img src="<?php echo $transport->getUnitImgPath($u);?>" /></div>
           <div class="count"><?php echo number_format($transport->getTransportInfo2($i, $u));?></div>
          </div>
          <?php }}?>
       </div>
       </td>
       <td title="أصل"><a href="?view=island&cityId=<?php echo $transport->getTransportInfo($i, "from_cid");?>"><?php echo $transport->getTransportInfo($i, "from_cname");?></a> (<?php echo $transport->getTransportInfo($i, "from_uname");?>)</td>
       <td style='width: 12px; padding-left: 0px; padding-right: 0px'></td>
       <td style="text-align: center; width: 35px" title="<?php echo $transport->getTransTypeArName($i);?> (<?php echo $transport->getTransStatusArName($i);?>)"><img src="<?php echo $transport->getTransImgLink($i);?>" /></td>
       <td style='width: 12px; padding-left: 0px; padding-right: 0px'></td>
       <td title="الهدف"><a href="?view=island&cityId=<?php echo $transport->getTransportInfo($i, "to_cid");?>"><?php echo $transport->getTransportInfo($i, "to_cname");?></a> (<?php echo $transport->getTransportInfo($i, "to_uname");?>)</td>
       <td title="تحركات" style="text-align: center; ">
       <?php echo $transport->getTransAction($i);?>
       </td>
      </tr>
<?php }?>
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
<script type="text/javascript">
Event.onDOMReady(function() {
<?php for($i=0; $i<$transport->getTransportsCount(); $i++){?>
getCountdown({enddate: <?php echo $t;?>, currentdate: <?php echo time();?>, el: "fleetRow<?php echo $i;?>"});
<?php }?>
})
</script>