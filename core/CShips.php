<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : CShips.php                               ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php
/*
210 سفينة مزودة بقوة دفع
211 سفينة اللهب
212 سفينة هاون
213 سفينة حاملة لسلاح المرجام
214 سفينة مزودة بمنجنيق
215 غواصة
216 جارفة آلية ضخمة
*/
class CShips {	
	
	public $shipsBList = array();
	public $ships = array();
	public $UpkeepDiscount = 0;
	
	public function CShips($IsNotTemporary){
	if($IsNotTemporary){
	 global $database, $city;
	 $this->shipsBList = $database->getShipsBList($city->cid);
	 $this->updateships();
	 $this->shipsBList = $database->getShipsBList($city->cid);
	 $this->ships = $database->getShips($city->cid);
	}
	 global $research;
	 if($research->GetResearchStatus("R1") > 1)
	 	$this->UpkeepDiscount += 2;
	 if($research->GetResearchStatus("R1") > 4)
	 	$this->UpkeepDiscount += 4;
	 if($research->GetResearchStatus("R1") > 9)
	 	$this->UpkeepDiscount += 8;
	 if($research->GetResearchStatus("R1")>11)
	  $this->UpkeepDiscount += 2*($research->GetResearchStatus("R1")-11);
	}
	private function meetRequirement($ship,$n){
	 $ship = "s".$ship;
	 global $city,$$ship;
	 $id = $$ship;
	 if($city->citizens < ($id['citizens']*$n))
	  return false;
	 if(($city->awood < ($id['wood']*$n)) ||
	    ($city->asulfur < ($id['sulfur']*$n)) ||
		($city->acrystal < ($id['crystal']*$n)) ||
		($city->awine < ($id['wine']*$n)))
	  return false;
	 return true;
	}
	public function ShipyardLevelCond($ship){
	 global $city;
	 $ship = "s".$ship;
	 global $city,$$ship;
	 $id = $$ship;
	 if($city->getBuildingLevel2(4) < $id['sylevel'])
	  return false;
	 return true;
	}
	public function GetShipInfo($ship,$info){
	$ship = "s".$ship;
	global $$ship;
	$id = $$ship;
	return $id[$info];
	}
	public function buildShips($post){
	 global $database,$city,$session;
	 if(!isset($post['actionRequest']) ||
        !isset($post['position']) ||
        ($post['actionRequest'] != $session->checker))
          header("Location: action.php?view=error");
	 if($this->GetShipsBuildingListNbr()>2)
	     header("Location: action.php?view=error");
	 $s210=0;$s211=0;$s212=0;$s213=0;$s214=0;$s215=0;$s216=0;
	 //////
	 $time = 0;
	 if(isset($this->shipsBList[0]["timestamp"]))
	  $time = $this->shipsBList[0]["timestamp"];
	 if(isset($this->shipsBList[1]["timestamp"]))
	  $time = $this->shipsBList[1]["timestamp"];
	 if($time == 0)
	  $time = time();
	 /////
	 $rwood = 0;
	 $rsulfur = 0;
	 $rcrystal = 0;
	 $rwine = 0;
	 $pop = $city->pop;
	 /////
	 if(isset($post['210']) && ($post['210'] != 0))
	  if($this->meetRequirement("210",$post['210']) &&
	     $this->ShipyardLevelCond("210") &&
		 $this->IsShipBuildingAvailable("210")){
	   $s210 = $post['210'];
	   $time += $this->GetShipInfo("210","time")*$post['210'];
	$rwood += $this->GetShipInfo("210","wood")*$post['210'];
	$rsulfur += $this->GetShipInfo("210","sulfur")*$post['210'];
	$pop -= $post['210']*$this->GetShipInfo("210","citizens");
	  }
	 /////
	 if(isset($post['213']) && ($post['213'] != 0))
	  if($this->meetRequirement("213",$post['213']) &&
	     $this->ShipyardLevelCond("213") &&
		 $this->IsShipBuildingAvailable("213")){
	   $s213 = $post['213'];
	   $time += $this->GetShipInfo("213","time")*$post['213'];
	$rwood += $this->GetShipInfo("213","wood")*$post['213'];
	$rsulfur += $this->GetShipInfo("213","sulfur")*$post['213'];
	$pop -= $post['213']*$this->GetShipInfo("213","citizens");
	  }
	 /////
	 if(isset($post['211']) && ($post['211'] != 0))
	  if($this->meetRequirement("211",$post['211']) &&
	     $this->ShipyardLevelCond("211") &&
		 $this->IsShipBuildingAvailable("211")){
	   $s211 = $post['211'];
	   $time += $this->GetShipInfo("211","time")*$post['211'];
	$rwood += $this->GetShipInfo("211","wood")*$post['211'];
	$rsulfur += $this->GetShipInfo("211","sulfur")*$post['211'];
	$pop -= $post['211']*$this->GetShipInfo("211","citizens");
	  }
	 /////
	 if(isset($post['212']) && ($post['212'] != 0))
	  if($this->meetRequirement("212",$post['212']) &&
	     $this->ShipyardLevelCond("212") &&
		 $this->IsShipBuildingAvailable("212")){
	   $s212 = $post['212'];
	   $time += $this->GetShipInfo("212","time")*$post['212'];
	$rwood += $this->GetShipInfo("212","wood")*$post['212'];
	$rcrystal += $this->GetShipInfo("212","crystal")*$post['212'];
	$pop -= $post['211']*$this->GetShipInfo("211","citizens");
	  }
	 /////
	 if(isset($post['214']) && ($post['214'] != 0))
	  if($this->meetRequirement("214",$post['214']) &&
	     $this->ShipyardLevelCond("214") &&
		 $this->IsShipBuildingAvailable("214")){
	   $s214 = $post['214'];
	   $time += $this->GetShipInfo("214","time")*$post['214'];
	$rwood += $this->GetShipInfo("214","wood")*$post['214'];
	$rsulfur += $this->GetShipInfo("214","sulfur")*$post['214'];
	$pop -= $post['214']*$this->GetShipInfo("214","citizens");
	  }
	 /////
	 if(isset($post['215']) && ($post['215'] != 0))
	  if($this->meetRequirement("215",$post['215']) &&
	     $this->ShipyardLevelCond("215") &&
		 $this->IsShipBuildingAvailable("215")){
	   $s215 = $post['215'];
	   $time += $this->GetShipInfo("215","time")*$post['215'];
	$rwood += $this->GetShipInfo("215","wood")*$post['215'];
	$rsulfur += $this->GetShipInfo("215","sulfur")*$post['215'];
	$pop -= $post['215']*$this->GetShipInfo("215","citizens");
	  }
	 /////
	 if(isset($post['216']) && ($post['216'] != 0))
	  if($this->meetRequirement("216",$post['216']) &&
	     $this->ShipyardLevelCond("216") &&
		 $this->IsShipBuildingAvailable("216")){
	   $s216 = $post['216'];
	   $time += $this->GetShipInfo("216","time")*$post['216'];
	$rwood += $this->GetShipInfo("216","wood")*$post['216'];
	$rsulfur += $this->GetShipInfo("216","sulfur")*$post['216'];
	$pop -= $post['216']*$this->GetShipInfo("216","citizens");
	  }
	 /////
	 $database->addShipsBuilding($city->cid,$s210,$s211,$s212,$s213,$s214,$s215,$s216,time(),$time);
	 $database->modifyResource($city->cid,
		               $rwood,
					   $rcrystal,
					   0,
					   $rwine,
					   $rsulfur,
					   $pop,0);
	 header("Location: action.php?view=shipyard&id=".$city->cid."&position=".$post['position']);
	}
	public function GetShipsNbr($ship){
	 return $this->ships["s".$ship];
	}
	public function GetAllShipsNbr(){
	 $n = 0;
	 for($s=210; $s<217; $s++)
	  $n += $this->GetShipsNbr($s);
	 return $n;
	}
	public function IsShipBuildingAvailable($s){
	 global $research;
	 switch($s){
	  case 210:return true;break;
	  case 211:
	   if($research->GetResearchStatus("R1")>6)
	    return true;
	   return false;
	  case 212:
	   if($research->GetResearchStatus("R3")>13)
	    return true;
	   return false;
	  case 213:
	   if($research->GetResearchStatus("R1")>0)
	    return true;
	   return false;
	  case 214:
	   if($research->GetResearchStatus("R1")>7)
	    return true;
	   return false;
	  case 215:
	   if($research->GetResearchStatus("R1")>11)
	    return true;
	   return false;
	  case 216:
	   if($research->GetResearchStatus("R1")>10)
	    return true;
	   return false;
	  default:return false;
	 }
	}
	public function GetShipHTMLClass($s){
	 switch($s){
	  case 210:return "ship_ram";break;
	  case 211:return "ship_flamethrower";break;
	  case 212:return "ship_submarine";break;
	  case 213:return "ship_ballista";break;
	  case 214:return "ship_catapult";break;
	  case 215:return "ship_mortar";break;
	  case 216:return "ship_steamboat";break;
	  default:return "";
	 }
	}
	public function GetMaxShipMaxNbr($ship){
	 if($this->GetShipsBuildingListNbr()>2)
	  return 0;
	 $ship = "s".$ship;
	 global $city,$$ship;
	 $id = $$ship;
	 $max = $city->citizens;
	 $max = min($max, floor($city->awood/$id['wood']));
	 if($id['sulfur'] > 0)
	 	$max= min($max, floor($city->asulfur/$id['sulfur']));
	 if($id['crystal'] > 0)
	 	$max= min($max, floor($city->acrystal/$id['crystal']));
	 if($id['wine'] > 0)
	 	$max= min($max, floor($city->awine/$id['wine']));
	 return  min($max, floor($city->citizens/$id['citizens']));
	}
	public function GetShipsBuildingListNbr(){
	 $n = 0;
	 if(isset($this->shipsBList[0]["timestamp"]))
	  $n++;
	 if(isset($this->shipsBList[1]["timestamp"]))
	  $n++;
	 if(isset($this->shipsBList[2]["timestamp"]))
	  $n++;
	 return $n;
	}
	public function ShipsInBuildNbr($list,$ship){
	 return $this->shipsBList[$list]["s".$ship];
	}
	public function GetUBListTime($list){
	 return $this->shipsBList[$list]["timestamp"];
	}
	public function GetUBListStartTime($list){
	 return $this->shipsBList[$list]["starttime"];
	}
	public function GetUBListID($list){
	 return $this->shipsBList[$list]["id"];
	}
	public function GetUBListPercent2Finish($list){
	 $time =  $this->shipsBList[$list]["timestamp"] - $this->shipsBList[$list]["starttime"];
	 $t = $this->shipsBList[$list]["timestamp"] - time();
	 return floor($t*100/$time);
	}
	private function updateShips(){
	 global $database,$city;
	 $points = $database->getUserField($city->uid,"points",0);
	 $armypoints = $database->getUserField($city->uid,"army_score",0);
	 $upoints = 0;
	 for($i=0; $i<$this->GetShipsBuildingListNbr(); $i++){
	  if($this->shipsBList[$i]["timestamp"] <= time()){
	   for($s=210; $s<217; $s++){
	    if($this->shipsBList[$i]["s".$s] > 0)
		 $database->updateShips($city->cid,
		                        "s".$s,
								$this->shipsBList[$i]["s".$s]);
		 $upoints += $this->GetShipInfo("$s","wood")*$this->shipsBList[$i]["s".$s]
		 + $this->getShipInfo("$s","wine")*$this->shipsBList[$i]["s".$s]
		  + $this->GetShipInfo("$s","sulfur")*$this->shipsBList[$i]["s".$s]
		  + $this->GetShipInfo("$s","crystal")*$this->shipsBList[$i]["s".$s];
	   }
	   $database->removeShipsBuilding($this->shipsBList[$i]["id"]);
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
	  $sblist = $database->getShipsBList2($get['eid']);
	  $pop = $city->pop;
	  for($s=210; $s<217; $s++){
	   $pop += $sblist["s".$s];
	  }
	  $pop > $city->maxpop?$pop = $city->maxpop:$pop;
	  $database->modifyResource($city->cid,0,0,0,0,0,$pop,1);
	  $database->removeShipsBuilding($get['eid']);
	  $this->shipsBList = $database->getShipsBList($city->cid);
	  header("Location: action.php?view=shipyard&id=".$city->cid."&position=".$get['position']);
	}
	public function CalcCityUpkeep($cid){
	 global $database;
	 $ss = array();
	 $ss = $database->getShips($cid);
	 $upkeep = 0;
	 for($s=210; $s<217; $s++){
	  $ship = "s".$s;
	  global $$ship;
	  $id = $$ship;
	  $upkeep += $id["upkeep"] * $ss[$ship];
	 }
	 return $upkeep;
	}
	public function CalcUpkeep(){
	 global $session;
	 $upkeep = 0;
	 for($i=0; $i<count($session->cities); $i++){
      $cid = $session->cities[$i];
	  $upkeep += $this->CalcCityUpkeep($cid);
     }
	 return $upkeep;
	}
 };
?>