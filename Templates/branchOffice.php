<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");
$building = new CBuilding;
$session->changeChecker();
?>
<link href="css/common.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/branchOffice.css" rel="stylesheet" type="text/css" media="screen">
<?php include("js/js1.php");?>
</head>
<body id="branchOffice" dir="rtl">
 <div id="container">
  <div id="container2">
   <div id="header">
    <h1>إيكارياما ikariama</h1>
    <h2>عش في العصور القديمة!</h2>
   </div>
   <div id="avatarNotes"></div>
   <div id="breadcrumbs">
    <h3>أنت هنا:</h3>
    <a href="?view=worldmap_iso&amp;islandX=<?php echo $city->x;?>&amp;islandY=<?php echo $city->y;?>" title="عودة إلى خارطة العالم"><img src="img/resource/icon-world.gif" alt="عالم" /></a><span>&nbsp;&gt;&nbsp;</span>
    <a href="?view=island&amp;id=<?php echo $city->iid;?>" title="عودة إلى الجزيرة"><img src="img/resource/icon-island.gif" alt="<?php echo $island->name?>" /><?php echo $island->name?>[<?php echo $city->x;?>:<?php echo $city->y;?>]</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="?view=city&amp;id=<?php echo $city->cid;?>" class="city" title="عودة إلى المدينة"><?php echo $city->cname;?></a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="building">متجر</span>
   </div>
   <div id="buildingUpgrade" class="dynamic">
    <h3 class="header">تطوير
    <a class="help" href="?view=buildingDetail&buildingId=7" title="مساعدة">
    <span class="textLabel">هل تحتاج لمساعدة؟</span>
    </a>
    </h3>
    <div class="content">
     <div class="buildingLevel">
      <span class="textLabel">مستوى </span>
      <?php echo $building->currentLevel;?>
     </div><?php if($building->currentLevel<18){?>
     <h4>ضروري للمستوى <?php echo $building->getBuildingNextLevel($_GET["position"]);?>:</h4>
     <ul class="resources">
     <?php if($building->nextLevelRes["wood"] != 0){?>
      <li class="wood" title="مادة صناعية"><span class="textLabel">مادة صناعية: </span><?php echo number_format($building->nextLevelRes["wood"]);?>
      </li>
      <?php }if($building->nextLevelRes["marble"] != 0){?>
	  <li class="marble alt" title="رخام"><span class="textLabel">رخام: </span><?php echo number_format($building->nextLevelRes["marble"]);?>
      </li>
     <?php }?> 
      <li class="time" title="وقت البناء"><span class="textLabel">وقت البناء: </span>
	  <?php 
	  $time = $generator->getTimeFormat($building->nextLevelRes["time"]);
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
      </li>
     </ul>
      <ul class="actions">
      <li class="upgrade">
  <?php if(($building->currentLevel<18)&&$building->canBuild()&&$building->checkResource(7,$building->currentLevel+1)){?>    
      <a href="?action=CityScreen&function=upgradeBuilding&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"]?>&level=<?php echo $building->currentLevel;?>&actionRequest=<?php echo $session->checker;?>" title="في لائحة البناء!">
      <span class="textLabel">تحسين</span>
      </a>
  <?php }else{?>
      <a class="disabled" href="#" title="إكمال الإنشاء غير ممكن حالياً"></a>
  <?php }?>
      </li>
      <li class="downgrade">
   <?php if(!$building->AmIUpgrading($_GET["position"]) && ($building->currentLevel > 1)){?>   
      <a href="?view=buildings_demolition&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"]?>&actionRequest=<?php echo $session->checker;?>" title="تدمير المبنى"><span class="textLabel">تدمير</span></a>
   <?php }else{?>
      <a class="disabled" href="#" title="التدمير غير ممكن حالياً!"></a>
   <?php }?>
      </li>
      </ul><?php }?>
    </div>
    <div class="footer"></div>
   </div>
   <div class="dynamic">
    <h3 class="header">تاجر ممتاز</h3>
    <div class="content">
     <img src="img/research/area_economy.jpg" width="203" height="85" />
     <p style="text-align:center;">قم بتبادل المواد الأولية مباشرةً! الأسعار:<br />
     <strong style="font-size:1.2em;">مواد البناء: 1 مقابل 1!</strong><br />
     <strong style="font-size:1.2em;">سلع كمالية: 1 مقابل 1!</strong></p>
     <div class="centerButton">
     <a href="?view=premiumTrader&oldView=branchOffice&id=<?php echo $city->cid;?>&position=<?php echo $_GET['POSITION'];?>" class="button" title="إلى التاجر">إلى التاجر</a>
        </div>
    </div>
    <div class="footer"></div>
   </div>
   <div class="dynamic">
    <h3 class="header">سعة التخزين <a class="help" href="?view=buildingDetail&buildingId=7" title="مساعدة"><span class="textLabel">هل تحتاج لمساعدة؟</span></a></h3>
    <div class="content">
     <p><strong>سعة التخزين الحالية:</strong><?php echo pow($building->currentLevel,2)*400;?></p>
    </div>
    <div class="footer"></div>
   </div>
   <div id="mainview">
    <div class="buildingDescription">
    <h1>متجر</h1>
<?php if($building->AmIUpgrading($_GET["position"])){?> 
 <div id="upgradeInProgress">
  <div class="buildingLevel">
   <span class="textLabel">مستوى </span>
   <?php echo $building->currentLevel;?>
  </div>
  <div class="nextLevel">
   <span class="textLabel">المستوى التالي </span>
   <?php echo $building->currentLevel+1;?>
  </div>
  <div class="isUpgrading">جاري إكمال الإنشاء</div>
  <div class="progressBar">
   <div class="bar" id="upgradeProgress" title="<?php echo $building->GetBUpPercent2Finish();?>%" style="width:<?php echo $building->GetBUpPercent2Finish();?>%;">
   </div>
  </div>
  <a class="cancelUpgrade" href="?view=buildings_demolition&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>&actionRequest=<?php echo $session->checker;?>" title="إلغاء"><span class="textLabel">إلغاء</span>
  </a>
  <script type="text/javascript">
  Event.onDOMReady(function() {
   var tmppbar = getProgressBar({
   startdate: <?php echo $building->GetBUpgradingStartTime();?>,
   enddate: <?php echo $building->GetBUpgradingTime();?>,
   currentdate: <?php echo time();?>,
   bar: "upgradeProgress"});
   tmppbar.subscribe("update", function(){
    this.barEl.title=this.progress+"%";});
   tmppbar.subscribe("finished", function(){
    this.barEl.title="100%";});
	});
   </script>
   <div class="time" id="upgradeCountDown">
    <?php $time = $generator->getTimeFormat($building->GetBUpgradingTime()-time());
	  if($time["d"]) echo $time["d"]."يوم ";
	  if($time["h"] && $time["d"]) echo $time["h"]."س ";
	  else if($time["h"]) echo $time["h"]."ساعة ";
	  if($time["m"] && $time["h"]) echo $time["m"]."د ";
	  else if($time["m"]) echo $time["m"]."دقيقة ";
	  if($time["s"]) echo $time["s"]."ث ";
	  ?>
   </div>
   <script type="text/javascript">
   Event.onDOMReady(function() {
    var tmpCnt = getCountdown({
	 enddate: <?php echo $building->GetBUpgradingTime();?>,
	 currentdate: <?php echo time();?>,
	 el: "upgradeCountDown"}, 2, " ", "", true, true);
	 tmpCnt.subscribe("finished", function() {
	 setTimeout(function() {
	  location.href="?view=port&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>";
	 },2000);
	 });
	});
   </script>
 </div>
<?php }?>
    <p>البائعون والتجار الكبار يقومون بممارسة تجارتهم في المتجر. هناك يمكن القيام بهذا البيع أو ذاك أو تحقيق سعر ممتاز. التجار من بلدان بعيدة يفضلون المرور بالمتاجر الكبيرة والمشهورة! 
بعد كل درجتي إكمال تطوير يزداد امتداد المتجر</p>
    </div>
    <div class="contentBox01h">
     <h3 class="header"><span class="textLabel">عروض من شركاء التجارة</span></h3>
     <div class="content">
      <div>
       <table cellpadding="0" cellspacing="0" border="0" class="tablekontor">
       <tr><th>مدينة</th><th>حجم الميناء</th><th>قطعة</th><th>مادة أولية</th><th>سعر الشراء</th><th>مسافة</th><th>تجارة؟</th></tr>
       </table>
      </div>
     </div><!-- content -->
     <div class="footer"></div>
    </div><!-- contentbox01h -->
    <!-- Trade box -->
    <form action="index.php" method="POST">
     <div class="contentBox01h" id="finder">
      <h3 class="header"><span class="textLabel">صياد الأسعار الممتازة</span></h3>
      <div class="content">
       <div>
       <input type="hidden"name="id"value="<?php echo $city->cid;?>" />
       <input type="hidden"name="position"value="<?php echo $_GET['position'];?>" />
       <input type="hidden"name="view"value="branchOffice" />
       <table class="search">
       <tr>
       <td><input type="radio"name="type"value="444"checked/></td>
       <td class="text">إني أبحث عن</td>
       <td><input type="radio"name="type"value="333"/></td
       ><td class="text">إني أعرضُ</td>
       <td>
        <div>
         <select name="searchResource">
          <option value="resource" >مادة صناعية</option>
          <option value="1" selected>مشروب العنب</option>
          <option value="2" >رخام</option>
          <option value="3" >زجاج بلوري</option>
          <option value="4" >كبريت</option>
          </select>
         </div>
        </td>
        <td>شعاع البحث:</td>
        <td>
         <select size="1" name="range">
          <option selected="selected">1</option>
         </select>
        </td>
        <td>محيط الجزيرة</td>
        </tr>
        </table>
       </div>
       <div>
        <div class="centerButton">
         <input type="submit" class="button" style="clear:left;" value="البحث عن سعر ممتاز"/>
        </div>
       </div>
      </div><!-- content -->
      <div class="footer"></div>
     </div><!-- contentbox01h -->
    </form>
    <div class="contentBox01h">
     <h3 class="header"><span class="textLabel">نتائج</span></h3>
     <div class="content">
      <div>
       <table cellpadding="0" cellspacing="0" border="0" class="tablekontor">
       <tr>
       <th>مدينة<a href="#" class="unicode">&uArr;</a>
       <a href="#" class="unicode">&dArr;</a></th>
       <th>حجم الميناء<a href="#" class="unicode">&uArr;</a>
       <a href="#" class="unicode">&dArr;</a></th>
       <th>قطعة<a href="#" class="unicode">&uArr;</a>
       <a href="#" class="unicode">&dArr;</a></th>
       <th>مادة أولية</th>
       <th>سعر الشراء<a href="#" class="unicode">&uArr;</a>
       <a href="#" class="unicode">&dArr;</a></th>
       <th>مسافة<a href="#" class="unicode">&uArr;</a>
       <a href="#" class="unicode">&dArr;</a></th>
       <th>تجارة؟</th>
       </tr>
       <tr  class="alt">
        <td>محافظة (elnazy)</td>
        <td>4</td>
        <td>149</td>
        <td><img src="img/resource/icon_wine.gif" alt="مزرعة العنب" title="مزرعة العنب" /></td>
        <td>10
        <img src="img/resource/icon_gold.gif" /> في القطعة</td>
        <td>1</td>
        <td><a href="?view=takeOffer&destinationCityId=57667&oldView=branchOffice&id=<?php echo $city->cid;?>&position=<?php echo $_GET["position"];?>&type=444&resource=1"><img src="img/icon-kiste.gif" alt="" title="" /></a></td>
       </tr>
       <tr >
        <td>محافظة (زاحف)</td>
        <td>1</td>
        <td>1,100</td>
        <td><img src="img/resource/icon_wine.gif" alt="مزرعة العنب" title="مزرعة العنب" /></td>
        <td>99 <img src="img/resource/icon_gold.gif" /> في القطعة</td>
        <td>1</td>
        <td><a href="?view=takeOffer&destinationCityId=57667&oldView=branchOffice&id=<?php echo $city->cid;?>&position=6&type=444&resource=1"><img src="img/icon-kiste.gif" alt="" title="" /></a></td>
       </tr>
       <!--<tr>
        <td colspan="6" class="paginator">1-2</td>
       </tr>-->
       </table>
      </div>
     </div><!-- content -->
     <div class="footer"></div>
    </div><!-- contentbox01h -->
    <form name="formkontor"  action="index.php" method="POST">
     <input type="hidden" name="id" value="<?php echo $city->cid;?>"><br>
     <input type="hidden" name="position" value="<?php echo $_GET["position"];?>">
     <input type="hidden" name="action" value="CityScreen">
     <input type="hidden" name="function" value="updateOffers">
     <input type="hidden" name="actionRequest" value="<?php echo $session->checker;?>" />
     <div class="contentBox01h">
      <h3 class="header"><span class="textLabel">عروض خاصة</span></h3>
      <div class="content">
       <table cellpadding="0" cellspacing="0" border="0" class="tablekontor">
        <tr><th colspan="2">نوع العرض</th><th>كمية</th><th>سعر</th>
        </tr>
        <tr>
        <td class="icon"><img src="img/resource/icon_wood.gif" alt="مادة صناعية" title="منشرة"/></td>
        <td class="select"><select name="resourceTradeType" id="resourceTradeType" size="1"><option value="333" >شراء</option><option value="444" selected>بيع</option></select></td>
        <td><input type="text" size="4" name="resource" id="resource" value="0" /></td>
        <td><input type="text" size="2" name="resourcePrice"  id="resourcePrice"  maxlength="2" value="0" /><img src="img/resource/icon_gold.gif"/> في القطعة</td>
        </tr>
        <tr class="alt">
        <td class="icon"><img src="img/resource/icon_wine.gif" alt="مشروب العنب" title="مزرعة العنب"/></td>
        <td class="select"><select name="tradegood1TradeType" id="tradegood1TradeType" size="1"><option value="333" >شراء</option><option value="444" selected>بيع</option></select></td>
        <td><input type="text" size="4" name="tradegood1" id="tradegood1" value="0" /></td>
        <td><input type="text" size="2" name="tradegood1Price" id="tradegood1Price" maxlength="2" value="0" /><img src="img/resource/icon_gold.gif" /> في القطعة</td>
        </tr>
        <tr>
        <td class="icon"><img src="img/resource/icon_marble.gif" alt="رخام" title="منجم رخام"/></td>
        <td class="select"><select name="tradegood2TradeType" id="tradegood2TradeType" size="1"><option value="333" >شراء</option><option value="444" selected>بيع</option></select></td>
        <td><input type="text" size="4" name="tradegood2" id="tradegood2" value="0" /></td>
        <td><input type="text" size="2" name="tradegood2Price" id="tradegood2Price" maxlength="2" value="0"/><img src="img/resource/icon_gold.gif"/> في القطعة</td>
        </tr>
        <tr class="alt">
        <td class="icon"><img src="img/resource/icon_glass.gif" alt="زجاج بلوري" title="منجم بلور"/></td>
        <td class="select"><select name="tradegood3TradeType" id="tradegood3TradeType" size="1"><option value="333" >شراء</option><option value="444" selected>بيع</option></select></td>
        <td><input type="text" size="4" name="tradegood3" id="tradegood3" value="0" /></td>
        <td><input type="text" size="2" name="tradegood3Price" id="tradegood3Price" maxlength="2" value="0"/><img src="img/resource/icon_gold.gif"/> في القطعة</td>
        </tr>
        <tr>
        <td class="icon"><img src="img/resource/icon_sulfur.gif" alt="كبريت" title="حفرة كبريت"/></td>
        <td class="select"><select name="tradegood4TradeType" id="tradegood4TradeType" size="1"><option value="333" >شراء</option><option value="444" selected>بيع</option></select></td>
        <td><input type="text" size="4" name="tradegood4" id="tradegood4" value="0" /></td>
        <td><input type="text" size="2" name="tradegood4Price" id="tradegood4Price" maxlength="2" value="0" /><img src="img/resource/icon_gold.gif"/> في القطعة</td>
        </tr>
       </table>
       <div>
        <p>ذهب محجوز للمشتريات:
        <span id="reservedGold">0</span>
        <img src="img/resource/icon_gold.gif" /></p>
        <input type="submit" class="button" value="تحديث العروض"/></div>
       </div><!-- content -->
      <div class="footer"></div>
     </div><!-- contentbox01h -->
    </form>
   </div><!-- end #mainview -->
<script language="javascript">
function checkBranchOffice(e, num) { 
var tradeType = new Array();
var tradegood = new Array();
var tradegoodPrice = new Array();
var resources = new Array();
tradeType[0] = Dom.get("resourceTradeType");
tradeType[1] = Dom.get("tradegood1TradeType");
tradeType[2] = Dom.get("tradegood2TradeType");
tradeType[3] = Dom.get("tradegood3TradeType");
tradeType[4] = Dom.get("tradegood4TradeType");
tradegood[0] = Dom.get("resource");
tradegoodPrice[0] = Dom.get("resourcePrice");
tradegood[1] = Dom.get("tradegood1");
tradegoodPrice[1] = Dom.get("tradegood1Price");
tradegood[2] = Dom.get("tradegood2");
tradegoodPrice[2] = Dom.get("tradegood2Price");
tradegood[3] = Dom.get("tradegood3");
tradegoodPrice[3] = Dom.get("tradegood3Price");
tradegood[4] = Dom.get("tradegood4");
tradegoodPrice[4] = Dom.get("tradegood4Price");
resources[0] = <?php echo $city->awood;?>;
resources[1] = <?php echo $city->awine;?>;
resources[2] = <?php echo $city->amarble;?>;
resources[3] = <?php echo $city->acrystal;?>;
resources[4] = <?php echo $city->asulfur;?>;
var gold = 159588.344218;
var costs = 0;
var sumCosts = 0;
var storageCapacity = <?php echo pow($building->currentLevel,2)*400;?>;
var sumStorage = 0;
for (i=0; i<5; i++) {
 if (tradeType[i].value == 333) {
  sumCosts += tradegood[i].value * tradegoodPrice[i].value;
 } else {
  sumStorage += tradegood[i].value * 1; // *1 converts to int
 }
}
if(sumCosts > gold) {
 sumCosts -= tradegood[num].value * tradegoodPrice[num].value;
 tradegood[num].value = 0;
 dif = gold - sumCosts;
 tradegood[num].value = Math.floor(dif / tradegoodPrice[num].value);
 sumCosts += tradegood[num].value * tradegoodPrice[num].value;
 if (sumCosts > gold) {
  sumCosts -= tradegood[num].value * tradegoodPrice[num].value;
  tradegood[num].value = 0;
 }            
}
if(sumStorage > storageCapacity) {
 sumStorage -= tradegood[num].value;
 tradegood[num].value = 0;
 dif = storageCapacity - sumStorage;
 tradegood[num].value = dif;
 sumStorage += dif;
 if (sumStorage > storageCapacity) {
  sumStorage -= tradegood[num].value;
  tradegood[num].value = 0;
 }           
}
Dom.get("reservedGold").innerHTML = sumCosts;        
for (i=0; i<5; i++) {
 if (tradeType[i].value == 444) {
  if (tradegood[i].value > resources[i]) {
   tradegood[i].value = resources[i];
   tradegood[i].focus();
   break;
  }
 }
}       
}

Event.onDOMReady(function() {
 Event.addListener(Dom.get("resourceTradeType"),   "change", checkBranchOffice, 0);
 Event.addListener(Dom.get("tradegood1TradeType"), "change", checkBranchOffice, 1);
 Event.addListener(Dom.get("tradegood2TradeType"), "change", checkBranchOffice, 2);
 Event.addListener(Dom.get("tradegood3TradeType"), "change", checkBranchOffice, 3);
 Event.addListener(Dom.get("tradegood4TradeType"), "change", checkBranchOffice, 4);
 Event.addListener(Dom.get("resource"),            "keyup", checkBranchOffice, 0);
 Event.addListener(Dom.get("resourcePrice"),       "keyup", checkBranchOffice, 0);
 Event.addListener(Dom.get("tradegood1"),          "keyup", checkBranchOffice, 1);
 Event.addListener(Dom.get("tradegood1Price"),     "keyup", checkBranchOffice, 1);
 Event.addListener(Dom.get("tradegood2"),          "keyup", checkBranchOffice, 2);
 Event.addListener(Dom.get("tradegood2Price"),     "keyup", checkBranchOffice, 2);
 Event.addListener(Dom.get("tradegood3"),          "keyup", checkBranchOffice, 3);
 Event.addListener(Dom.get("tradegood3Price"),     "keyup", checkBranchOffice, 3);
 Event.addListener(Dom.get("tradegood4"),          "keyup", checkBranchOffice, 4);
 Event.addListener(Dom.get("tradegood4Price"),     "keyup", checkBranchOffice, 4);
});
</script>            
<?php include("citynavigator.php");?>
<?php include("footer.php");?>
<?php include("toolbar.php");?>
 </div>
</div>
<?php include("js/js2.php");?>
