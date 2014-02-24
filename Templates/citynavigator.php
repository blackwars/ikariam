<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");

?>
<div id="cityNav">
 <form id="changeCityForm" action="action.php" method="POST">
  <fieldset style="display: none;">
  <input type="hidden" name="action" value="header" />
  <input type="hidden" name="function" value="changeCurrentCity" />
<input type="hidden" name="oldView" value="<?php if(isset($_GET["view"])) echo $_GET["view"]; else echo"city"; ?>" />
  <input type="hidden" name="id" value="<?php echo $city->cid;?>" />
  </fieldset>
  <!-- Navigation -->
  <h3>ملاحة في المدن:</h3>
  <ul>
   <li><label for="citySelect">المدينة الحالية:</label>
   <select id="citySelect" class="citySelect smallFont" name="cityId" tabindex="1" onchange="this.form.submit()">
<?php 
for($i=0; $i<count($session->cities); $i++){
$cid = $session->cities[$i];
$darray = $database->getBuildingsLevels($cid);
if($darray["b0"]){
 $cname =  $database->getCityField($cid,"name");
 $darray = $database->getBuildingsLevels($cid);
 $iid = $database->getCityField($cid,"iid");
 $islandNameCoor = " [".$database->getIslandField($iid,"x")
				.":".$database->getIslandField($iid,"y")."]";
 $islandResArName = $island->GetIslandTGArType();
?> 
   <option class="coords" value="<?php echo $cid;?>" <?php if($cid==$city->cid)echo "selected=\"selected\"";?> title="سلعة: <?php echo $islandResArName;?>" ><p><?php echo $islandNameCoor;?>&nbsp;<?php echo $cname;?></p></option>
<?php }}?>  
   </select></li>
   <li class="previousCity">
   <a href="#" tabindex="2" title="تبديل مدينة قبل"><span class="textLabel">المدينة السابقة</span></a>
   </li>
   <li class="nextCity">
   <a href="#" tabindex="3" title="التنقل نحو مدينة إلى الأمام"><span class="textLabel">المدينة التالية</span></a>
   </li>
   <li class="viewWorldmap">
   <a href="?view=worldmap_iso&amp;islandX=<?php echo $city->x;?>&amp;islandY=<?php echo $city->y;?>" tabindex="4" title="توسيط المدينة المختارة على خارطة العالم"><span class="textLabel">خارطة العالم</span></a>
   </li>
   <li class="viewIsland">
   <a href="?view=island&amp;id=<?php echo $city->iid;?>" tabindex="5" title="الانتقال إلى خارطة الجزيرة للمدينة المختارة"><span class="textLabel">الجزيرة</span></a>
   </li>
   <li class="viewCity">
   <a href="?view=city&amp;id=<?php echo $city->cid;?>" tabindex="6" title="عرض المدينة المختارة">
   <span class="textLabel">المدينة</span></a>
   </li>
  </ul>
 </form>
</div>
<!-- Goldbalance... -->
<div id="globalResources">
<h3>موارد إمبراطوريتك</h3>
<ul>
 <li class="transporters" title="سفن تجارية متوفرة/مجموع">
 <a href="?view=merchantNavy"><span class="textLabel">سفن تجارية:</span><span><?php echo $city->aships;?> (<?php echo $city->ships;?>)</span>
 </a>
 </li>
 <li class="ambrosia" title="<?php echo $city->ambrosia;?> أمبروزيا">
 <a href="?view=premium">
 <span class="textLabel">أمبروزيا:</span>
 <span><?php echo $city->ambrosia;?></span>
 </a>
 </li>  
 <li class="gold" title="<?php echo number_format($city->gold);?> ذهب">
 <a href="?view=finances">
 <span class="textLabel">ذهب:</span>
 <span id="value_gold"><?php echo number_format($city->gold);?></span>
 </a>
 </li>
</ul>
</div>
<!-- Resources of the city.-->
<div id="cityResources"><h3>موارد المدينة</h3>
<ul class="resources">
 <li class="population" title="سكان">
 <span class="textLabel">السكان: </span>
 <span id="value_inhabitants" style="display: block; width: 80px;"><?php echo number_format($city->citizens);?> (<?php echo number_format($city->pop);?>)</span>
 </li>
 <li class="actions" title="نقاط التحرك">
 <span class="textLabel">نقاط التحرك: </span>
 <span id="value_maxActionPoints"><?php echo $city->movpoints;?></span>
 </li>
 <li class="wood">
 <span class="textLabel">مواد البناء:</span>
 <span id="value_wood" class=""><?php echo number_format($city->awood);?></span>
 <div class="tooltip">
 <span class="textLabel">سعة التخزين مادة البناء:</span><?php echo number_format($city->maxstore);?></div>
 </li>
<?php 
$r2 = $research->GetResearchStatus("R2")<3;
?>
 <li class="wine<?php if($r2)echo "_inactive";?>">
 <span class="textLabel">مشروب العنب:</span>
 <span id="value_wine" class=""><?php echo number_format($city->awine);?></span>
 <div class="tooltip"><span class="textLabel">سعة التخزين مشروب العنب: </span><?php echo number_format($city->maxstore);?></div>
 </li>
 <li class="marble<?php if($r2)echo "_inactive";?>">
 <span class="textLabel">رخام:</span>
 <span id="value_marble" class=""><?php echo number_format($city->amarble);?></span>
 <div class="tooltip"><span class="textLabel">سعة التخزين رخام: </span><?php echo number_format($city->maxstore);?></div>
 </li>
 <li class="glass<?php if($r2)echo "_inactive";?>">
 <span class="textLabel">بلور:</span>
 <span id="value_crystal" class=""><?php echo number_format($city->acrystal);?></span>
 <div class="tooltip"><span class="textLabel">سعة التخزين بلور: </span><?php echo number_format($city->maxstore);?></div>
 </li>
 <li class="sulfur<?php if($r2)echo "_inactive";?>">
 <span class="textLabel">كبريت:</span>
 <span id="value_sulfur" class=""><?php echo number_format($city->asulfur);?></span>
 <div class="tooltip"><span class="textLabel">سعة التخزين كبريت: </span><?php echo number_format($city->maxstore);?></div>
 </li>
</ul>
</div>
<!-- ADVISORS -->
<div id="advisors">
<h3>نظرات عامة</h3>
<ul>
 <li id="advCities">
 <a href="?view=tradeAdvisor&oldView=city&id=<?php echo $city->cid;?>" title="نظرة عامة على المدن والتمويلات" class="<?php if(!$log->IsAdvCitiesActive)echo "normal";else echo "normalactive";?>">
 <span class="textLabel">مدن</span>
 </a> 
 <a class="plusteaser" href="?view=premiumDetails" title="إلى النظرة العامة">
 <span class="textLabel">إلى النظرة العامة</span>
 </a>
 </li>
 <li id="advMilitary">
 <a href="?view=militaryAdvisorMilitaryMovements&oldView=city&id=<?php echo $city->cid;?>" title="نظرة عامة على الجيش" class="<?php if(!$session->IsAdvMilitaryActive)echo "normal";else echo "normalactive";?>">
 <span class="textLabel">جيش</span>
 </a> 
 <a class="plusteaser" href="?view=premiumDetails" title="إلى النظرة العامة">
 <span class="textLabel">إلى النظرة العامة</span></a>
 </li>
 <li id="advResearch">
 <a href="?view=researchAdvisor&oldView=city&id=<?php echo $city->cid;?>" title="نظرة عامة على البحوث" class="<?php if(!$city->IsAdvResearchActive)echo "normal";else echo "normalactive";?>">
 <span class="textLabel">أبحاث</span></a> 
 <a class="plusteaser" href="?view=premiumDetails" title="إلى النظرة العامة">
 <span class="textLabel">إلى النظرة العامة</span></a>
 </li>
 <li id="advDiplomacy">
 <a href="?view=diplomacyAdvisor&oldView=city&id=<?php echo $city->cid;?>" title="نظرة عامة على الدبلوماسية والأخبار" class="<?php if(!$session->IsAdvDiplomacyActive)echo "normal";else echo "normalactive";?>">
 <span class="textLabel">دبلوماسية</span></a> 
 <a class="plusteaser" href="?view=premiumDetails" title="إلى النظرة العامة">
 <span class="textLabel">إلى النظرة العامة</span></a>
 </li>
</ul>
</div>
<!-- ADVISORS END -->