<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : CUnits.php                               ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php
/*
301 مقلاع حجارة
302 مبارز
303 محارب مدرع
304 قناصة بندقية البارود
305 هاون
306 منجنيق
307 كاسر
308 عملاق بخاري
309 قاصف
310 طباخ
311 طبيب
312 طائرة مروحية
313 رامي السهام

315 رامي الرماح
*/
class CUnits {	
	
	public $unitsBList = array();
	public $units = array();
	public $UpkeepDiscount = 0;
	
	public function CUnits($IsNotTemporary){
	if($IsNotTemporary){
	 global $database, $city;
	 $this->unitsBList = $database->getUnitsBList($city->cid);
	 $this->updateUnits();
	 $this->unitsBList = $database->getUnitsBList($city->cid);
	 $this->units = $database->getUnits($city->cid);
	}
	 global $research;
	 if($research->GetResearchStatus("R4") > 1)
	 	$this->UpkeepDiscount += 2;
	 if($research->GetResearchStatus("R4") > 4)
	 	$this->UpkeepDiscount += 4;
	 if($research->GetResearchStatus("R4") > 9)
	 	$this->UpkeepDiscount += 8;
	 if($research->GetResearchStatus("R4")>13)
	  $this->UpkeepDiscount += 2*($research->GetResearchStatus("R4")-13);
	}
	private function meetRequirement($unit,$n){
	 $unit = "u".$unit;
	 global $city,$$unit;
	 $id = $$unit;
	 if($city->citizens < ($id['citizens']*$n))
	  return false;
	 if(($city->awood < ($id['wood']*$n)) ||
	    ($city->asulfur < ($id['sulfur']*$n)) ||
		($city->acrystal < ($id['crystal']*$n)) ||
		($city->awine < ($id['wine']*$n)))
	  return false;
	 return true;
	}
	public function BarracksLevelCond($unit){
	 global $city;
	 $unit = "u".$unit;
	 global $city,$$unit;
	 $id = $$unit;
	 if($city->getBuildingLevel2(2) < $id['blevel'])
	  return false;
	 return true;
	}
	public function getUnitInfo($unit,$info){
	$unit = "u".$unit;
	global $$unit;
	$id = $$unit;
	return $id[$info];
	}
	public function buildUnits($post){
	 global $database,$city,$session;
	 if(!isset($post['actionRequest']) ||
        !isset($post['position']) ||
        ($post['actionRequest'] != $session->checker))
          header("Location: action.php?view=error");
	 if($this->GetUnitsBuildingListNbr()>2)
	     header("Location: action.php?view=error");
	 $u301=0;$u302=0;$u303=0;$u304=0;$u305=0;$u306=0;$u307=0;$u308=0;$u309=0;$u310=0;$u311=0;$u312=0;$u313=0;$u314=0;$u315=0;
	 //////
	 $time = 0;
	 if(isset($this->unitsBList[0]["timestamp"]))
	  $time = $this->unitsBList[0]["timestamp"];
	 if(isset($this->unitsBList[1]["timestamp"]))
	  $time = $this->unitsBList[1]["timestamp"];
	 if($time == 0)
	  $time = time();
	 /////
	 $rwood = 0;
	 $rsulfur = 0;
	 $rcrystal = 0;
	 $rwine = 0;
	 $pop = $city->pop;
	 /////
	 if(isset($post['315']) && ($post['315'] != 0))
	  if($this->meetRequirement("315",$post['315']) &&
	     $this->BarracksLevelCond("315") &&
		 $this->IsUnitBuildingAvailable("315")){
	   $u315 = $post['315'];
	   $time += $this->getUnitInfo("315","time")*$post['315'];
	$rwood += $this->getUnitInfo("315","wood")*$post['315'];
	$pop -= $post['315'];
	  }
	 /////
	 if(isset($post['301']) && ($post['301'] != 0))
	  if($this->meetRequirement("301",$post['301']) &&
	     $this->BarracksLevelCond("301") &&
		 $this->IsUnitBuildingAvailable("301")){
	   $u301 = $post['301'];
	   $time += $this->getUnitInfo("301","time")*$post['301'];
	$rwood += $this->getUnitInfo("301","wood")*$post['301'];
	$pop -= $post['301'];
	  }
	 /////
	 if(isset($post['302']) && ($post['302'] != 0))
	  if($this->meetRequirement("302",$post['302']) &&
	     $this->BarracksLevelCond("302") &&
		 $this->IsUnitBuildingAvailable("302")){
	   $u302 = $post['302'];
	   $time += $this->getUnitInfo("302","time")*$post['302'];
	$rwood += $this->getUnitInfo("302","wood")*$post['302'];
	$rsulfur += $this->getUnitInfo("302","sulfur")*$post['302'];
	$pop -= $post['302'];
	  }
	 /////
	 if(isset($post['303']) && ($post['303'] != 0))
	  if($this->meetRequirement("303",$post['303']) &&
	     $this->BarracksLevelCond("303") &&
		 $this->IsUnitBuildingAvailable("303")){
	   $u303 = $post['303'];
	   $time += $this->getUnitInfo("303","time")*$post['303'];
	$rwood += $this->getUnitInfo("303","wood")*$post['303'];
	$rsulfur += $this->getUnitInfo("303","sulfur")*$post['303'];
	$pop -= $post['303'];
	  }
	 /////
	 if(isset($post['304']) && ($post['304'] != 0))
	  if($this->meetRequirement("304",$post['304']) &&
	     $this->BarracksLevelCond("304") &&
		 $this->IsUnitBuildingAvailable("304")){
	   $u304 = $post['304'];
	   $time += $this->getUnitInfo("304","time")*$post['304'];
	$rwood += $this->getUnitInfo("304","wood")*$post['304'];
	$rsulfur += $this->getUnitInfo("304","sulfur")*$post['304'];
	$pop -= $post['304'];
	  }
	 /////
	 if(isset($post['305']) && ($post['305'] != 0))
	  if($this->meetRequirement("305",$post['305']) &&
	     $this->BarracksLevelCond("305") &&
		 $this->IsUnitBuildingAvailable("305")){
	   $u305 = $post['305'];
	   $time += $this->getUnitInfo("305","time")*$post['305'];
	$rwood += $this->getUnitInfo("305","wood")*$post['305'];
	$rsulfur += $this->getUnitInfo("305","sulfur")*$post['305'];
	$pop -= $post['305'];
	  }
	 /////
	 if(isset($post['306']) && ($post['306'] != 0))
	  if($this->meetRequirement("306",$post['306']) &&
	     $this->BarracksLevelCond("306") &&
		 $this->IsUnitBuildingAvailable("306")){
	   $u306 = $post['306'];
	   $time += $this->getUnitInfo("306","time")*$post['306'];
	$rwood += $this->getUnitInfo("306","wood")*$post['306'];
	$rsulfur += $this->getUnitInfo("306","sulfur")*$post['306'];
	$pop -= $post['307'];
	  }
	 /////
	 if(isset($post['307']) && ($post['307'] != 0))
	  if($this->meetRequirement("307",$post['307']) &&
	     $this->BarracksLevelCond("307") &&
		 $this->IsUnitBuildingAvailable("307")){
	   $u307 = $post['307'];
	   $time += $this->getUnitInfo("307","time")*$post['307'];
	$rwood += $this->getUnitInfo("307","wood")*$post['307'];
	$rsulfur += $this->getUnitInfo("307","sulfur")*$post['307'];
	$pop -= $post['307'];
	  }
	 /////
	 if(isset($post['308']) && ($post['308'] != 0))
	  if($this->meetRequirement("308",$post['308']) &&
	     $this->BarracksLevelCond("308") &&
		 $this->IsUnitBuildingAvailable("308")){
	   $u308 = $post['308'];
	   $time += $this->getUnitInfo("308","time")*$post['308'];
	$rwood += $this->getUnitInfo("308","wood")*$post['308'];
	$rsulfur += $this->getUnitInfo("308","sulfur")*$post['308'];
	$pop -= $post['308'];
	  }
	 /////
	 if(isset($post['309']) && ($post['309'] != 0))
	  if($this->meetRequirement("309",$post['309']) &&
	     $this->BarracksLevelCond("309") &&
		 $this->IsUnitBuildingAvailable("309")){
	   $u309 = $post['309'];
	   $time += $this->getUnitInfo("309","time")*$post['309'];
	$rwood += $this->getUnitInfo("309","wood")*$post['309'];
	$rsulfur += $this->getUnitInfo("309","sulfur")*$post['309'];
	$pop -= $post['309'];
	  }
	 /////
	 if(isset($post['310']) && ($post['310'] != 0))
	  if($this->meetRequirement("310",$post['310']) &&
	     $this->BarracksLevelCond("310") &&
		 $this->IsUnitBuildingAvailable("310")){
	   $u310 = $post['310'];
	   $time += $this->getUnitInfo("310","time")*$post['310'];
	$rwood += $this->getUnitInfo("310","wood")*$post['310'];
	$rcrystal += $this->getUnitInfo("310","crystal")*$post['310'];
	$pop -= $post['310'];
	  }
	 /////
	 if(isset($post['311']) && ($post['311'] != 0))
	  if($this->meetRequirement("311",$post['311']) &&
	     $this->BarracksLevelCond("311") &&
		 $this->IsUnitBuildingAvailable("311")){
	   $u311 = $post['311'];
	   $time += $this->getUnitInfo("311","time")*$post['311'];
	$rwood += $this->getUnitInfo("311","wood")*$post['311'];
	$rcrystal += $this->getUnitInfo("311","crystal")*$post['311'];
	$pop -= $post['311'];
	  }
	 /////
	 if(isset($post['312']) && ($post['312'] != 0))
	  if($this->meetRequirement("312",$post['312']) &&
	     $this->BarracksLevelCond("312") &&
		 $this->IsUnitBuildingAvailable("312")){
	   $u312 = $post['312'];
	   $time += $this->getUnitInfo("312","time")*$post['312'];
	$rwood += $this->getUnitInfo("312","wood")*$post['312'];
	$rsulfur += $this->getUnitInfo("312","sulfur")*$post['312'];
	$pop -= $post['312'];
	  }
	 /////
	 if(isset($post['313']) && ($post['313'] != 0))
	  if($this->meetRequirement("313",$post['313']) &&
	     $this->BarracksLevelCond("313") &&
		 $this->IsUnitBuildingAvailable("313")){
	   $u313 = $post['313'];
	   $time += $this->getUnitInfo("313","time")*$post['313'];
	$rwood += $this->getUnitInfo("313","wood")*$post['313'];
	$rsulfur += $this->getUnitInfo("313","sulfur")*$post['313'];
	$pop -= $post['313'];
	  }
	 /////
	 $database->addUnitsBuilding($city->cid,$u301,$u302,$u303,$u304,$u305,$u306,$u307,$u308,$u309,$u310,$u311,$u312,$u313,$u314,$u315,time(),$time);
	 $database->modifyResource($city->cid,
		               $rwood,
					   $rcrystal,
					   0,
					   $rwine,
					   $rsulfur,
					   $pop,0);
	 header("Location: action.php?view=barracks&id=".$city->cid."&position=".$post['position']);
	}
	public function GetUnitsNbr($unit){
	 return $this->units["u".$unit];
	}
	public function GetAllUnitsNbr(){
	 $n = 0;
	 for($u=301; $u<316; $u++)
	  $n += $this->GetUnitsNbr($u);
	 return $n;
	}
	public function IsUnitBuildingAvailable($u){
	 global $research;
	 switch($u){
	  case 301:return true;break;
	  case 302:
	   if($research->GetResearchStatus("R4")>2)
	    return true;
	   return false;
	  break;
	  case 303: 
	   if($research->GetResearchStatus("R4")>2)
	    return true;
	   return false;
	  break;
	  case 304: 
	   if($research->GetResearchStatus("R4")>10)
	    return true;
	   return false;
	  break;
	  case 305: 
	   if($research->GetResearchStatus("R4")>12)
	    return true;
	   return false;
	  break;
	  case 306: 
	   if($research->GetResearchStatus("R4")>6)
	    return true;
	   return false;
	  break;
	  case 307: 
	   if($research->GetResearchStatus("R4")>3)
	    return true;
	   return false;
	  break;
	  case 308:
	   if($research->GetResearchStatus("R4")>11)
	    return true;
	   return false;
	  case 309:
	   if($research->GetResearchStatus("R3")>14)
	    return true;
	   return false;
	  break;
	  case 310: 
	   if($research->GetResearchStatus("R2")>8)
	    return true;
	   return false;
	  break;
	  case 311: 
	   if($research->GetResearchStatus("R3")>7)
	    return true;
	   return false;
	  break;
	  case 312: 
	   if($research->GetResearchStatus("R3")>11)
	    return true;
	   return false;
	  break;
	  case 313: 
	   if($research->GetResearchStatus("R4")>5)
	    return true;
	   return false;
	  break;
	  case 315:return true;break;
	  default:return false;
	 }
	}
	public function GetUnitHTMLClass($u){
	 switch($u){
	  case 301:return "slinger";break;
	  case 302:return "swordsman";break;
	  case 303:return "phalanx";break;
	  case 304:return "marksman";break;
	  case 305:return "mortar";break;
	  case 306:return "catapult";break;
	  case 307:return "ram";break;
	  case 308:return "steamgiant";break;
	  case 309:return "bombardier";break;
	  case 310:return "cook";break;
	  case 311:return "medic";break;
	  case 312:return "gyrocopter";break;
	  case 313:return "archer";break;
	  case 315:return "spearman";break;
	  default:return "";
	 }
	}
	public function GetMaxUnitMaxNbr($unit){
	 if($this->GetUnitsBuildingListNbr()>2)
	  return 0;
	 $unit = "u".$unit;
	 global $city,$$unit;
	 if($city->maxtroops <= $this->GetAllUnitsNbr())
	  return 0;
	 $id = $$unit;
	 $max = $city->citizens;
	 $max = min($max, floor($city->awood/$id['wood']));
	 if($id['sulfur'] > 0)
	 	$max= min($max, floor($city->asulfur/$id['sulfur']));
	 if($id['crystal'] > 0)
	 	$max= min($max, floor($city->acrystal/$id['crystal']));
	 if($id['wine'] > 0)
	 	$max= min($max, floor($city->awine/$id['wine']));
	 return min($max, floor($city->citizens/$id['citizens']));
	}
	public function GetUnitsBuildingListNbr(){
	 $n = 0;
	 if(isset($this->unitsBList[0]["timestamp"]))
	  $n++;
	 if(isset($this->unitsBList[1]["timestamp"]))
	  $n++;
	 if(isset($this->unitsBList[2]["timestamp"]))
	  $n++;
	 return $n;
	}
	public function UnitsInBuildNbr($list,$unit){
	 return $this->unitsBList[$list]["u".$unit];
	}
	public function GetUBListTime($list){
	 return $this->unitsBList[$list]["timestamp"];
	}
	public function GetUBListStartTime($list){
	 return $this->unitsBList[$list]["starttime"];
	}
	public function GetUBListID($list){
	 return $this->unitsBList[$list]["id"];
	}
	public function GetUBListPercent2Finish($list){
	 $time =  $this->unitsBList[$list]["timestamp"] - $this->unitsBList[$list]["starttime"];
	 $t = $this->unitsBList[$list]["timestamp"] - time();
	 return floor($t*100/$time);
	}
	private function updateUnits(){
	 global $database,$city;
	 $points = $database->getUserField($city->uid,"points",0);
	 $armypoints = $database->getUserField($city->uid,"army_score",0);
	 $upoints = 0;
	 for($i=0; $i<$this->GetUnitsBuildingListNbr(); $i++){
	  if($this->unitsBList[$i]["timestamp"] <= time()){
	   for($u=301; $u<316; $u++){
	    if($this->unitsBList[$i]["u".$u] > 0)
		 $database->updateUnits($city->cid,
		                        "u".$u,
								$this->unitsBList[$i]["u".$u]);
		 $upoints += $this->getUnitInfo("$u","wood")*$this->unitsBList[$i]["u".$u]
		  + $this->getUnitInfo("$u","wine")*$this->unitsBList[$i]["u".$u]
		 + $this->getUnitInfo("$u","sulfur")*$this->unitsBList[$i]["u".$u]
		 + $this->getUnitInfo("$u","crystal")*$this->unitsBList[$i]["u".$u];
	   }
	   $database->removeUnitsBuilding($this->unitsBList[$i]["id"]);
	  }
	 }
	 $upoints *= 0.02;
	 $armypoints += $upoints;
	 $points += $upoints;
	 $database->updateUserField($city->uid,"points",$points,1);
	 $database->updateUserField($city->uid,"army_score",$armypoints,1);
	}
	public function abortMilitaryConstruction($get){
	 global $database,$city,$session;
	  if(!isset($get['actionRequest']) ||
        !isset($get['id']) ||
		!isset($get['position']) ||
		!isset($get['eid']) ||
		!isset($get['type']) ||
        ($get['actionRequest'] != $session->checker))
          header("Location: action.php?view=error");
	  $ublist = $database->getUnitsBList2($get['eid']);
	  $pop = $city->pop;
	  for($u=301; $u<316; $u++){
	   $pop += $ublist["u".$u];
	  }
	  $pop > $city->maxpop?$pop = $city->maxpop:$pop;
	  $database->modifyResource($city->cid,0,0,0,0,0,$pop,1);
	  $database->removeUnitsBuilding($get['eid']);
	  $this->unitsBList = $database->getUnitsBList($city->cid);
	   header("Location: action.php?view=barracks&id=".$city->cid."&position=".$get['position']);
	}
	public function CalcCityUpkeep($cid){
	 global $database;
	 $us = array();
	 $us = $database->getUnits($cid);
	 $upkeep = 0;
	 for($u=301; $u<316; $u++){
	  $unit = "u".$u;
	  global $$unit;
	  $id = $$unit;
	  $upkeep += $id["upkeep"] * $us[$unit];
	 }
	 return $upkeep;
	}
	public function CalcUpkeep(){
	 global $session;
	 $upkeep = 0;
	 for($i=0; $i<count($session->cities); $i++){
      $cid = $session->cities[$i];
	  $upkeep += $this-> CalcCityUpkeep($cid);
     }
	 return $upkeep;
	}
 };
?>