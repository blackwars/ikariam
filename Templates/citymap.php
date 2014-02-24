<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");

function GetBuildingArabicName($pos){
	 if($pos==14)
	  return "سور المدينة";
	 global $city;
	 switch($city->buildingsLevels["b".$pos."t"]){
	  case 1:return "أكاديمية";break;
	  case 2:return "ثكنة";break;
	  case 3:return "مرفأ تجاري";break;
	  case 4:return "حوض بناء السفن الحربية";break;
	  case 5:return "سور المدينة";break;
	  case 6:return "منزل التخزين";break;
	  case 7:return "متجر";break;
	  case 8:return "قصر";break;
	  case 9:return "إستراحة";break;
	  case 10:return "مخبأ";break;
	  case 11:return "مركز";break;
	  case 12:return "بيت الحطاب";break;
	  case 13:return "برج الكيميائي";break;
	  case 14:return "";break;
	  case 15:return "";break;
	  case 16:return "";break;
	  case 17:return "مكان عمل المخترعين";break;
	  case 18:return "ساحة تجارب الألعاب النارية";break;
	  case 19:return "متحف";break;
	  case 20:return "مكتب المهندس";break;
	  case 21:return "صانع البصريات";break;
	  case 22:return "سفارة";break;
	  case 23:return "مبنى النجارة";break;
	  case 24:return "عصارة العنب";break;
	 }
}
?>
<!-- the main view. take care that it stretches. -->
  <div id="mainview" class="phase<?php echo $city->GetBuildingLevel(0);?>">
   <ul id="locations">
  <?php if($city->IsBuildingReady(0)){?> 
    <li id="position0" class="townHall">
    <div class="buildingimg"></div>
    <a href="?view=townHall&amp;id=<?php echo $city->cid;?>&amp;position=0" title="دار البلدية مستوى <?php echo $city->GetBuildingLevel(0);?>"><span class="textLabel">دار البلدية مستوى <?php echo $city->GetBuildingLevel(0);?></span></a>
    </li>
  <?php }else{?>
    <li id="position0" class="townHall">
    <div class="constructionSite"></div>
    <a href="?view=townHall&amp;id=<?php echo $city->cid;?>&amp;position=0" title="دار البلدية مستوى <?php echo $city->GetBuildingLevel(0);?>"><span class="textLabel">دار البلدية مستوى<?php echo $city->GetBuildingLevel(0);?> (في إكمال الإنشاء)</span>
    </a>
    <div class="timetofinish">
     <span class="before"></span>
     <span class="textLabel">الوقت حتى الإنجاز: </span>
     <span id="cityCountdown">
     <?php $time = $generator->getTimeFormat($city->GetBuildingFinishTime()-time());
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
     </span>
     <span class="after"></span>
    </div>
    <script type="text/javascript">
		var tmpCnt =    getCountdown({
        enddate: <?php echo $city->GetBuildingFinishTime()?>,
        currentdate: <?php echo time();?>,
        el: "cityCountdown"
        });
    	tmpCnt.subscribe("finished", function() {
        top.document.title = "إيكارياما ikariama" + " - عالم Alpha";
        setTimeout(function() {
         location.href="?view=city&id=<?php echo $city->cid;?>";
        },2000);
        });
	</script>
	</li>
  <?php }?>  
<?php for($i=1; $i<15; $i++){?>
  <?php if($city->IsSiteEmpty($i)){?>
    <?php if(($i==13)&&($research->GetResearchStatus("R2")<12)){?>
    <li id="position13" class="buildingGround land">
    <div></div>
    <a href="#" title="لكي تبني هنا عليك أن تكتشف البيروقراطية."><span class="textLabel">لكي تبني هنا عليك أن تكتشف البيروقراطية.</span></a>
    </li>
 <?php continue;}?>
    <?php if($i==1 || $i==2){?>    
    <li id="position<?php echo $i;?>"class="buildingGround shore">
    <?php }else if($i==14){?> 
    <li id="position<?php echo $i;?>" class="buildingGround wall">
    <?php }else{?> 
    <li id="position<?php echo $i;?>"class="buildingGround land">
    <?php }?> 
    <div class="flag"></div>
    <a href="?view=buildingGround&amp;id=<?php echo $city->cid;?>&amp;position=<?php echo $i;?>" title="مكان بناء فارغ"><span class="textLabel">مكان بناء فارغ</span></a>
    </li>
    
  <?php }else{?> 
   <?php if($city->IsBuildingReady($i)){?>
    <li id="position<?php echo $i;?>" class="<?php echo $city->GetBuildingNameFromPos($i);?>">
    <div class="buildingimg"></div>
    <a href="?view=<?php echo $city->GetBuildingNameFromPos($i);?>&amp;id=<?php echo $city->cid;?>&amp;position=<?php echo $i;?>" title="<?php echo GetBuildingArabicName($i);?> مستوى <?php echo $city->GetBuildingLevel($i);?>"><span class="textLabel"><?php echo GetBuildingArabicName($i);?> مستوى <?php echo $city->GetBuildingLevel($i);?></span></a>
    </li>   
   <?php }else{?>
    <li id="position<?php echo $i;?>" class="<?php echo $city->GetBuildingNameFromPos($i);?>">
    <div class="constructionSite"></div>
    <a href="?view=<?php echo $city->GetBuildingNameFromPos($i);?>&amp;id=<?php echo $city->cid;?>&amp;position=<?php echo $i;?>" title="<?php echo GetBuildingArabicName($i);?> مستوى <?php echo $city->GetBuildingLevel($i);?>"><span class="textLabel"><?php echo GetBuildingArabicName($i);?> مستوى <?php echo $city->GetBuildingLevel($i);?> (في إكمال الإنشاء)</span>
    </a>
    <div class="timetofinish">
     <span class="before"></span>
     <span class="textLabel">الوقت حتى الإنجاز: </span>
     <span id="cityCountdown">
     <?php $time = $generator->getTimeFormat($city->GetBuildingFinishTime()-time());
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
     </span>
     <span class="after"></span>
    </div>
    <script type="text/javascript">
		var tmpCnt =    getCountdown({
        enddate: <?php echo $city->GetBuildingFinishTime()?>,
        currentdate: <?php echo time();?>,
        el: "cityCountdown"
        });
    	tmpCnt.subscribe("finished", function() {
        top.document.title = "إيكارياما ikariama" + " - عالم Alpha";
        setTimeout(function() {
         location.href="?view=city&id=<?php echo $city->cid;?>";
        },2000);
        });
	</script>
	</li>
   <?php }?>
  <?php }?>
<?php }?>       
    <li class="transporter"></li>
    <li class="beachboys"></li>
    <?php if($units->GetAllUnitsNbr()){?>
    <li class="garnison"></li><?php }?>
    
   </ul>
  </div>
  <!-- END mainview -->