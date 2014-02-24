<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");

$session->changeChecker();
include("core/research.php");
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/researchAdvisor.css" rel="stylesheet" type="text/css" media="screen" />
<?php include("js/js1.php");?>
</head>
<body id="researchAdvisor" dir="rtl">
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
    <span class="building">مستشار الأبحاث</span>
   </div>
   <div class="dynamic" id="">
    <h3 class="header">نظرة عامة</h3>
    <div class="content">
     <ul class="researchLeftMenu">
     <li class="scientists">علماء: <?php echo $research->CountScientists();?></li>
     <li class="points">نقاط أبحاث: <?php echo number_format($research->CountResearches());?></li>
     <li class="time">في الساعة: <?php echo $research->getAllResearchesPerHour();?></li>
     </ul>
    </div>
    <div class="footer"></div>
   </div>
   <div class="dynamic" id="viewResearchImperium">
    <h3 class="header">نظرة عامة للأبحاث</h3>
    <div class="content">
     <img src="img/premium/sideAd_premiumResearchAdvisor.jpg" width="203" height="85" />
     <p>المعرفة قوة. و من يعرف أكثر، سيمتلك قوة أكبر. هل تريد أن تعرف المزيد؟ انقر هنا الآن!</p>
     <div class="centerButton">
      <a href="?view=premiumDetails" class="button">أنظر الآن</a>
     </div>
    </div>
    <div class="footer"></div>
   </div>
   <div id="researchLibrary" class="dynamic">
    <h3 class="header">مكتبة</h3>
    <div class="content">
     <img src="img/research/img_library.jpg" width="203" height="85" />
     <p>في  المكتبة تجد معلومات تخص جميع حقول المعرفة!</p>
     <div class="centerButton">
      <a href="?view=researchOverview&id=<?php echo $city->cid;?>" class="button">إلى المكتبة</a>
     </div>
    </div>
    <div class="footer"></div>
   </div>
   <div id="mainview">
    <div class="buildingDescription">
     <h1>مستشار الأبحاث</h1>
     <p></p>
    </div>
    <div class="contentBox01h" id="currentResearch">
     <h3 class="header">
     <span class="textLabel">بحوث حالية</span>
     </h3>
     <div class="content">
      <ul class="researchTypes">
      <li class="researchType ">
       <div class="researchInfo" style="width:100px; min-height:120px;">
        <h4><a href="?view=researchDetail&researchId=<?php echo "R1".$research->GetNextResearch("R1");?>">
         <?php echo $research->GetResearchName("R1",$research->GetNextResearch("R1"));?>
        </a></h4>
        <div class="leftBranch">
         <img src="img/changeResearchSeafaring.jpg" />
         <div class="researchTypeLabel">
          <div class="unitcount">
           <span class="textLabel">
           <span class="before"></span>إبحار
           <span class="after"></span>
           </span>
          </div>
         </div>
        </div>
        <p><?php echo $research->GetResearchDesc("R1",$research->GetNextResearch("R1"));?></p>
        <?php if(!$research->IsNoEnoughConds("R1",$research->GetNextResearch("R1"))){?>
    	<?php if($research->IsNoEnoughPoints("R1",$research->GetNextResearch("R1"))){?>
        <div class="researchButton2">
        لا تتوفر على نقاط بحث كافية.
        </div>
        <?php }else{?>
        <div class="researchButton">
         <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=Advisor&function=doResearch&type=R1&actionRequest=<?php echo $session->checker;?>">
         <span class="textLabel">بحث</span>
         </a>
        </div>
        <?php }?>
        <div class="costs">
         <h5>تكاليف:</h5>
         <ul class="resources">
         <li class="researchPoints">
          <?php echo number_format($research->GetResearchPoints("R1",$research->GetNextResearch("R1")));?>
         </li>
         </ul>
        </div>
    <?php }else{?>
        <div class="researchButton2">
        لا زال هنالك شرط من الشروط لم يتم بحثه بعد
        </div>
    <?php }?>
       </div>
      </li>
      <li class="researchType alt">
       <div class="researchInfo" style="width:100px; min-height:120px;">
        <h4><a href="?view=researchDetail&researchId=<?php echo "R2".$research->GetNextResearch("R2");?>">
        <?php echo $research->GetResearchName("R2",$research->GetNextResearch("R2"));?>
        </a></h4>
        <div class="leftBranch">
         <img src="img/changeResearchEconomy.jpg" />
         <div class="researchTypeLabel">
          <div class="unitcount">
           <span class="textLabel">
           <span class="before"></span>اقتصاد
           <span class="after"></span>
           </span>
          </div>
         </div>
        </div>
        <p><?php echo $research->GetResearchDesc("R2",$research->GetNextResearch("R2"));?></p>
        <?php if(!$research->IsNoEnoughConds("R2",$research->GetNextResearch("R2"))){?>
    	<?php if($research->IsNoEnoughPoints("R2",$research->GetNextResearch("R2"))){?>
        <div class="researchButton2">
        لا تتوفر على نقاط بحث كافية.
        </div>
        <?php }else{?>
        <div class="researchButton">
         <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=Advisor&function=doResearch&type=R2&actionRequest=<?php echo $session->checker;?>">
         <span class="textLabel">بحث</span>
         </a>
        </div>
        <?php }?>
        <div class="costs">
         <h5>تكاليف:</h5>
         <ul class="resources">
         <li class="researchPoints">
          <?php echo number_format($research->GetResearchPoints("R2",$research->GetNextResearch("R2")));?>
         </li>
         </ul>
        </div>
    <?php }else{?>
        <div class="researchButton2">
        لا زال هنالك شرط من الشروط لم يتم بحثه بعد 
        </div>
    <?php }?>
       </div>
      </li>
      <li class="researchType ">
       <div class="researchInfo" style="width:100px; min-height:120px;">
        <h4><a href="?view=researchDetail&researchId=<?php echo "R3".$research->GetNextResearch("R3");?>">
        <?php echo $research->GetResearchName("R3",$research->GetNextResearch("R3"));?>
        </a></h4>
        <div class="leftBranch">
         <img src="img/changeResearchKnowledge.jpg" />
         <div class="researchTypeLabel">
          <div class="unitcount">
           <span class="textLabel">
           <span class="before"></span>معرفة
           <span class="after"></span>
           </span>
          </div>
         </div>
        </div>
        <p><?php echo $research->GetResearchDesc("R3",$research->GetNextResearch("R3"));?></p>
    <?php if(!$research->IsNoEnoughConds("R3",$research->GetNextResearch("R3"))){?>
    	<?php if($research->IsNoEnoughPoints("R3",$research->GetNextResearch("R3"))){?>
        <div class="researchButton2">
        لا تتوفر على نقاط بحث كافية.
        </div>
        <?php }else{?>
        <div class="researchButton">
         <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=Advisor&function=doResearch&type=R3&actionRequest=<?php echo $session->checker;?>">
         <span class="textLabel">بحث</span>
         </a>
        </div>
        <?php }?>
        <div class="costs">
         <h5>تكاليف:</h5>
         <ul class="resources">
         <li class="researchPoints">
          <?php echo number_format($research->GetResearchPoints("R3",$research->GetNextResearch("R3")));?>
         </li>
         </ul>
        </div>
    <?php }else{?>
        <div class="researchButton2">
        لا زال هنالك شرط من الشروط لم يتم بحثه بعد
        </div>
    <?php }?>
       </div>
      </li>
      <li class="researchType alt">
       <div class="researchInfo" style="width:100px; min-height:120px;">
        <h4><a href="?view=researchDetail&researchId=<?php echo "R4".$research->GetNextResearch("R4");?>">
        <?php echo $research->GetResearchName("R4",$research->GetNextResearch("R4"));?>
        </a></h4>
        <div class="leftBranch">
         <img src="img/changeResearchMilitary.jpg" />
         <div class="researchTypeLabel">
          <div class="unitcount">
           <span class="textLabel">
           <span class="before"></span>جيش
           <span class="after"></span>
           </span>
          </div>
         </div>
        </div>
        <p><?php echo $research->GetResearchDesc("R4",$research->GetNextResearch("R4"));?></p>
    <?php if(!$research->IsNoEnoughConds("R4",$research->GetNextResearch("R4"))){?>
    	<?php if($research->IsNoEnoughPoints("R4",$research->GetNextResearch("R4"))){?>
        <div class="researchButton2">
        لا تتوفر على نقاط بحث كافية.
        </div>
        <?php }else{?>
        <div class="researchButton">
         <a class="button build" style="padding-left:3px;padding-right:3px;"  href="?action=Advisor&function=doResearch&type=R4&actionRequest=<?php echo $session->checker;?>">
         <span class="textLabel">بحث</span>
         </a>
        </div>
        <?php }?>
        <div class="costs">
         <h5>تكاليف:</h5>
         <ul class="resources">
         <li class="researchPoints">
          <?php echo number_format($research->GetResearchPoints("R4",$research->GetNextResearch("R4")));?>
         </li>
         </ul>
        </div>
    <?php }else{?>
        <div class="researchButton2">
        لا زال هنالك شرط من الشروط لم يتم بحثه بعد 
        </div>
    <?php }?>
       </div>
      </li>
      </ul>
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