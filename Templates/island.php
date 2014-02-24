<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/island.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>

<?php if(isset($_GET['cityId'])){/*?>
<script type="text/javascript">    
var transporterDisplay;
Event.onDOMReady(function() {selectCity(<?php echo $_GET['cityId'];?>, <?php echo $island->GetCityByPos($_GET['cityId']);?>, 0); selectGroup.activate(this, 'cities'); return false;});
</script>
<?php */}?>
<body id="island" dir="rtl">
<div id="container">
 <div id="container2">
  <div id="header">
   <h1>إيكارياما ikariam</h1>
   <h2>عش في العصور القديمة!</h2>
  </div>
  <div id="avatarNotes"></div>
  <div id="breadcrumbs">
  <h3>أنت هنا:</h3>
  <a href="?view=worldmap_iso&amp;islandX=<?php echo $island->x;?>&amp;islandY=<?php echo $island->y;?>" class="world" title="عودة إلى خارطة العالم">عالم
  </a>
  <span>&nbsp;&gt;&nbsp;</span>
  <span class="island"><?php echo $island->name;?>[<?php echo $island->y;?>:<?php echo $island->x;?>]</span>
  </div>
  <div id="infocontainer" class="dynamic">
   <h3 class="header">معلومات</h3>
   <div id="information" class="content">
   <div class="accesshint">انتباه: سيتم تحديث هذا الجزء من الصفحة بمجرد اختيار مدينة ما!
   </div>
   </div>
   <div class="footer"></div>
  </div>
  <div id="actioncontainer" class="dynamic">
   <h3 class="header">تحركات</h3>
   <div id="actions" class="content">
   <div class="accesshint">انتباه: سيتم تحديث هذا الجزء من الصفحة بمجرد اختيار مدينة ما!
   </div>
   </div>
   <div class="footer"></div>
  </div>
  <div id="mainview" class="island<?php echo $island->maptype;?>">
   <h3>المدن في <?php echo $island->name;?></h3>
   <ul id="cities">
<?php for($i=0;$i<16;$i++){?>
<?php  if($island->IsCityOccupied($i)){?>
   <li id="cityLocation<?php echo $i;?>" class="cityLocation city level<?php  echo $island->GetCityLevel($i);?>">
  <?php if($island->IsMyCity($i) && $island->GetCityLevel($i)){?>
    <div class="ownCityImg"></div>
  <?php }else if(!$island->GetCityLevel($i)){?> 
    <div class="buildCityImg"></div>
  <?php }else{?> 
    <div class="cityimg"></div>
  <?php }?> 
    <div class="selectimg"></div>
    <a href="#" id="city_<?php echo $island->GetCityByPos($i);?>" onClick="selectCity(<?php echo $i;?>, <?php echo $island->GetCityByPos($i);?>, 0); selectGroup.activate(this, 'cities'); return false;">
    <?php if($island->GetCityLevel($i)){?> 
    <span class="textLabel">
     <span class="before"></span>
      <?php echo $island->GetCityName($i);?>
     <span class="after"></span>
    </span>
    <?php }?> 
    </a>
    <ul class="cityinfo">
    <li class="name"><span class="textLabel">اسم: </span>
    <?php echo $island->GetCityName($i);?>
    </li>
    <li class="citylevel"><span class="textLabel">قياس: </span>
    <?php echo $island->GetCityLevel($i);?>
    </li>
    <li class="owner">
     <span class="textLabel">لاعب: </span>
	 <?php echo $island->GetCityOwnerName($i);?>
  <?php if(!$island->IsMyCity($i)){?>
     <a href="?view=sendIKMessage&receiverId=<?php echo $island->GetCityOwnerID($i);?>" class="messageSend" title="إرسال رسالة">
     <img src="img/icon_message_write.gif" alt="إرسال رسالة"/>
     </a>
     <a href="?view=reportPlayer&avatarName=<?php echo $island->GetCityOwnerName($i);?>&avatarId=<?php echo $island->GetCityOwnerID($i);?>&target=74678&oldView=island" class="reportPlayer" title="التبليغ بهذا اللاعب لذى مشرف عن اللعبة">
     <img src="img/icon-kick.gif" alt="التبليغ عن لاعب" />
     </a>
  <?php }?>
    </li>
    <li class="name"><span class="textLabel">نقاط: </span>
    <?php echo number_format($island->GetCityOwnerPoints($i));?>
    </li>
    <li class="ally">
     <span class="textLabel">تحالف: </span>
    <?php if($island->GetCityOwnerAllyID($i)!="0"){?>
     <a href="?view=allyPage&allyId=<?php echo $session->userinfo["allyid"];?>">
     <?php echo $island->GetCityOwnerAllyID($i);?>
     </a>
     <a href="?view=sendIKMessage&allyId=797&oldView=island" class="messageSend" title="إرسال رسالة">
     <img src="img/icon_message_write.gif" alt="إرسال رسالة"/>
     </a>
    <?php }else echo "-";?>
    </li>
    </ul>
    <ul class="cityactions">
<?php if($island->GetCityByPos($i) != $city->cid){?>
  <?php if(!$island->IsMyCity($i)){?> 
    <li class="diplomacy">
     <a href="?view=sendIKMessage&receiverId=<?php echo $island->GetCityOwnerID($i);?>" title="دبلوماسية">
     <span class="textLabel">دبلوماسية</span>
     </a>
    </li>          
  <?php }?>  
<?php 
$ActionMeetReqtransport = $city->ActionMeetReq("transport");
$ActionMeetReqdefend_city = $city->ActionMeetReq("defend_city");
$ActionMeetReqdefend_port = $city->ActionMeetReq("defend_port");
$ActionMeetReqplunder = $city->ActionMeetReq("plunder");
$ActionMeetReqblockade = $city->ActionMeetReq("blockade");
$ActionMeetReqoccupy = $city->ActionMeetReq("occupy");
$ActionMeetReqespionage = $city->ActionMeetReq("espionage");
$ActionMeetReqdeploy_army = $city->ActionMeetReq("deploy_army");
$ActionMeetReqdeploy_fleet = $city->ActionMeetReq("deploy_fleet");
?>  
  <?php if($city->canAction("transport")){?>
    <li class="transport <?php if(!$ActionMeetReqtransport)echo "disabled";?>">
    <?php if($ActionMeetReqtransport){?>
     <a href="?view=transport&amp;destinationCityId=<?php echo $island->GetCityOwnerID($i);?>" title="نقل البضائع">
     <span class="textLabel">نقل البضائع</span>
     </a>
    <?php }?>
    <?php if(!$ActionMeetReqtransport)echo "<span class='textLabel'>نقل البضائع</span>";?>
    </li>
  <?php }?> 
  <?php if(!$island->IsMyCity($i)){?> 
   <?php if($city->canAction("defend_city")){?>
    <li class="defend_city <?php if(!$ActionMeetReqdefend_city)echo "disabled";?>">
     <?php if($ActionMeetReqdefend_city){?>
     <a href="?view=defendCity&amp;destinationCityId=<?php echo $island->GetCityOwnerID($i);?>" title="دافع عن المدينة!">
     <span class="textLabel">دافع عن المدينة!</span>
     </a>
    <?php }?>
    <?php if(!$ActionMeetReqdefend_city)echo "<span class='textLabel'>دافع عن المدينة!</span>";?>
    </li>  
   <?php }?>  
   <?php if($city->canAction("defend_port")){?>                 
    <li class="defend_port <?php if(!$ActionMeetReqdefend_port)echo "disabled";?>">
    <?php if($ActionMeetReqdefend_port){?>
     <a href="?view=defendPort&amp;destinationCityId=<?php echo $island->GetCityOwnerID($i);?>" title="دافع عن المرفأ!">
     <span class="textLabel">دافع عن المرفأ!</span>
     </a>
     <?php }?>
     <?php if(!$ActionMeetReqdefend_port)echo "<span class='textLabel'>دافع عن المرفأ!</span>";?>
    </li>       
   <?php }?>   
   <?php if($island->IsMyCity($i)){?>                 
    <li class="deploy_army <?php if(!$ActionMeetReqdeploy_army)echo "disabled";?>">
    <?php if($ActionMeetReqdeploy_army){?>
     <a href="?view=deployment&amp;deploymentType=army&amp;destinationCityId=<?php echo $island->GetCityOwnerID($i);?>" title="مركزَةُ القوات">
     <span class="textLabel">مركزَةُ القوات</span>
     </a>
     <?php }?>
     <?php if(!$ActionMeetReqdeploy_army)echo "<span class='textLabel'>مركزَةُ القوات</span>";?>
    </li>       
   <?php }?>
   <?php if($island->IsMyCity($i)){?>                 
    <li class="deploy_army <?php if(!$ActionMeetReqdeploy_fleet)echo "disabled";?>">
    <?php if($ActionMeetReqdeploy_fleet){?>
     <a href="?view=deployment&amp;deploymentType=fleet&amp;destinationCityId=<?php echo $island->GetCityOwnerID($i);?>" title="مركزَةُ الأساطيل">
     <span class="textLabel">مركزَةُ الأساطيل</span>
     </a>
     <?php }?>
     <?php if(!$ActionMeetReqdeploy_fleet)echo "<span class='textLabel'>مركزَةُ الأساطيل</span>";?>
    </li>       
   <?php }?>  
   <?php if($city->canAction("plunder")){?>          
    <li class="plunder <?php if(!$ActionMeetReqplunder)echo "disabled";?>">
     <?php if($ActionMeetReqplunder){?>
     <a href="?view=plunder&amp;destinationCityId=<?php echo $island->GetCityOwnerID($i);?>" title="نهب">
     <span class="textLabel">نهب</span>
     </a>
     <?php }?>
     <?php if(!$ActionMeetReqplunder)echo "<span class='textLabel'>نهب</span>";?>
    </li>   
   <?php }?> 
   <?php if($city->canAction("blockade")){?>                    
    <li class="blockade <?php if(!$ActionMeetReqblockade)echo "disabled";?>">
     <?php if($ActionMeetReqblockade){?>
     <a href="?view=blockade&amp;destinationCityId=<?php echo $island->GetCityOwnerID($i);?>" title="محاصرة">
     <span class="textLabel">محاصرة المرفأ</span>
     </a>
     <?php }?>
     <?php if(!$ActionMeetReqblockade)echo "<span class='textLabel'>محاصرة المرفأ</span>";?>
    </li>   
   <?php }?>  
   <?php if($city->canAction("occupy")){?>                   
    <li class="occupy <?php if(!$ActionMeetReqoccupy)echo "disabled";?>">
     <?php if($ActionMeetReqoccupy){?>
     <a href="?view=occupy&amp;destinationCityId=<?php echo $island->GetCityOwnerID($i);?>" title="احتلال">
     <span class="textLabel">احتلال المدينة</span>
     </a>
     <?php }?>
     <?php if(!$ActionMeetReqoccupy)echo "<span class='textLabel'>احتلال المدينة</span>";?>
    </li>  
   <?php }?>  
   <?php if($city->canAction("espionage")){?>                    
    <li class="espionage <?php if(!$ActionMeetReqespionage)echo "disabled";?>">
     <?php if($ActionMeetReqespionage){?>
     <a href="?view=sendSpy&amp;destinationCityId=<?php echo $island->GetCityOwnerID($i);?>&amp;islandId=<?php echo $island->iid;?>" title="إرسال جاسوس">
     <span class="textLabel">إرسال جاسوس</span>
     </a>
     <?php }?>
     <?php if(!$ActionMeetReqespionage)echo "<span class='textLabel'>إرسال جاسوس</span>";?>
    </li>
   <?php }?>
  <?php }?> 
<?php }?>
    </ul>
   </li>
<?php  }else{?>
   <li id="cityLocation<?php echo $i;?>" class="cityLocation buildplace">
    <div class="claim"></div>
    <a href="<?php if($city->capital&&($research->GetResearchStatus("R1")>2)&&($city->getBuildingLevel2(8)>0)){?>?view=colonize&amp;islandId=<?php echo $island->iid;?>&amp;position=<?php echo $i;}else echo "#";?>" title="أتريد أن تستعمر هنا؟">
    <span class="textLabel">
     <span class="before"></span>مكان بناء
     <span class="after"></span>
    </span>
    </a>
   </li>
<?php }}?>
<!--Barbarians-->
<?php if($island->IsBarbarianAllowed($island->iid)){?>
   <li id="barbarianVilliage"> 
    <a href="#" id="barbarianLink" onClick="selectBarbarianVillage(); selectGroup.activate(this, 'cities'); return false;">
    </a>
    <ul class="cityinfo" id="barbarianInformation">
     <li class="name">
      <span class="textLabel">اسم: </span>قرية المتوحشون
     </li>
     <li class="citylevel">
      <span class="textLabel">مستوى: </span><?php echo $session->barbarian["level"];?>
     </li>
     <li class="name">
      <span class="textLabel">متوحشون: </span><?php echo $session->barbarian["barbarians"];?>
     </li>
     <li class="name">
      <span class="textLabel">مستوى السور: </span><?php echo $session->barbarian["wall"];?>
     </li>
    </ul>
    <ul class="cityactions" id="barbarianActions">
    <?php if($city->canAction("plunder")){?>
    <li class="plunder <?php if(!$ActionMeetReqplunder)echo "disabled";?>">
     <?php if($ActionMeetReqplunder){?>
     <a href="?view=plunder&amp;destinationCityId=0&barbarianVillage=1" title="نهب">
     <span class="textLabel">نهب</span>
     </a>
     <?php }?>
     <?php if(!$ActionMeetReqplunder)echo "<span class='textLabel'>نهب</span>";?>
    </li> 
    <?php }?>
    </ul>
    </li>
<?php }?>
   </ul>
   <h3>أماكن خاصة على <?php echo $island->name;?></h3>
   <ul id="islandfeatures">
   <li class="wood level<?php echo $island->woodlevel."1";?>">
    <a href="<?php if($city->iid==$island->iid){?>?view=resource&amp;type=resource&amp;id=<?php echo $island->iid;}else echo "#";?>" title="غابة <?php echo $island->woodlevel;?>">
    <span class="textLabel">غابة</span>
    </a>
   </li>
   <li id="tradegood"  class="<?php echo $island->specialRes;?> level<?php echo $island->minelevel;?>">
  <?php if($island->specialRes=="crystal"){?>
    <a href="<?php if($city->iid==$_SESSION["iid"]){?>?view=tradegood&type=tradegood&id=<?php echo $_SESSION["iid"];}else echo "#";?>" title="منجم البلور <?php echo $island->woodlevel;?>">
    <span class="textLabel">منجم البلور</span>
    </a>
  <?php }else if($island->specialRes=="wine"){?>
    <a href="<?php if($city->iid==$_SESSION["iid"]){?>?view=tradegood&type=tradegood&id=<?php echo $_SESSION["iid"];}else echo "#";?>" title="حقل العنب <?php echo $island->woodlevel;?>">
    <span class="textLabel">حقل العنب</span>
    </a>
  <?php }else if($island->specialRes=="marble"){?>
    <a href="<?php if($city->iid==$_SESSION["iid"]){?>?view=tradegood&type=tradegood&id=<?php echo $_SESSION["iid"];}else echo "#";?>" title="منجم الرخام <?php echo $island->woodlevel;?>">
    <span class="textLabel">منجم الرخام</span>
    </a>
  <?php }else if($island->specialRes=="sulfur"){?>
    <a href="<?php if($city->iid==$_SESSION["iid"]){?>?view=tradegood&type=tradegood&id=<?php echo $_SESSION["iid"];}else echo "#";?>" title="حفرة الكبريت <?php echo $island->woodlevel;?>">
    <span class="textLabel">حفرة الكبريت</span>
    </a>
  <?php }?>
   </li>
   <li id="wonder" class="wonder<?php echo $island->wid;?>">
 <?php if($island->wid==1){?>
    <a href="?view=wonder&id=<?php echo $island->iid;?>" title="مركز أثينا">
    <span class="textLabel">مركز أثينا</span>
 <?php }else if($island->wid==2){?>
 <!----------Other wonders------------>
 <?php }?>
    </a>
   </li>
   <li class="forum">
    <a title="المنتدى العام" href="?view=islandBoard&id=<?php echo $island->iid;?>">
    <span class="textLabel">المنتدى العام</span>
    </a>
   </li>
   </ul>
  </div>
<!-- END mainview -->
<?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>