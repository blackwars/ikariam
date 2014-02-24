<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : CBuilding.php                            ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php

class CBuilding {	

	public $currentLevel;
	public $nextLevelRes = array();
	public $isUppgrading = false;
	public $timeLeft = 0;
	public $costsDecreasingPercent = 0;
	public $costsDecWood = 0;
	public $costsDecWine = 0;
	public $costsDecMarble = 0;
	public $costsDecCrystal = 0;
	public $costsDecSulfur = 0;
	
	public function CBuilding() {
	 global $research,$city;
	 if($research->GetResearchStatus("R2") > 1)
	  $this->costsDecreasingPercent += 2;
	 if($research->GetResearchStatus("R2") > 5)
	  $this->costsDecreasingPercent += 4;
	 if($research->GetResearchStatus("R2") > 10)
	  $this->costsDecreasingPercent += 8;
	  $this->costsDecWood = $city->getBuildingLevel2(23);
	  $this->costsDecWine = $city->getBuildingLevel2(24);
	  $this->costsDecMarble = $city->getBuildingLevel2(20);
	  $this->costsDecCrystal = $city->getBuildingLevel2(21);
	  //$this->costsDecSulfur = $city->getBuildingLevel2();
	 if(isset($_GET["view"])&&isset($_GET["position"])){
		$this->LoadBuilding($_GET["position"],$_GET["view"]);
	 }
	}
	
	public function procBuild($get) {
		global $session,$city;
		if(isset($get['id']) && $get['actionRequest'] == $session->checker && isset($get['position'])) {
		 switch($get['function']){
		  case "build":
		    if(!isset($get['building'])||
			   !$this->canBuild())
			 header("Location: action.php?view=error");
			$this->constructBuilding($get['building'],$get['position']);
		  break;
		  case "upgradeBuilding":
		    if(!isset($get['level']) || $get['level']>17||
			   !$this->canBuild())
			 header("Location: action.php?view=error");
			$this->upgradeBuilding($get['position'],$get['level']);
		  break;
		 }
		}
		else 
			header("Location: action.php?view=error");
	}
	
	private function GetBuildingNameFromPos($pos){
	 if($pos == 0)
		return "townHall";
	 if($pos == 14)
		return "wall";
	 global $database,$buildingsNames,$city;
	 return $buildingsNames[$city->buildingsLevels["b".$pos."t"]];
	}
	private function loadBuilding($pos,$name) {
		global $database,$city,$session;
		$this->currentLevel = $city->GetBuildingLevel($pos);
		global $$name;
		$id = $$name;
		$level=$this->getBuildingNextLevel($pos);
		$this->nextLevelRes["wood"] = $this->CalcRequRes($id[$level]["wood"])-($id[$level]["wood"]*$this->costsDecWood/100);
		$this->nextLevelRes["marble"] = $this->CalcRequRes($id[$level]["marble"])-($id[$level]["marble"]*$this->costsDecMarble/100);
		$this->nextLevelRes["crystal"] = $this->CalcRequRes($id[$level]["crystal"])-($id[$level]["crystal"]*$this->costsDecCrystal/100);
		$this->nextLevelRes["sulfur"] = $this->CalcRequRes($id[$level]["sulfur"])-($id[$level]["sulfur"]*$this->costsDecSulfur/100);
		$this->nextLevelRes["wine"] = $this->CalcRequRes($id[$level]["wine"])-($id[$level]["wine"]*$this->costsDecWine/100);
		$this->nextLevelRes["time"] = $id[$this->getBuildingNextLevel($pos)]["time"];
		
	}
	public function getBuildingNextLevel($pos){
	 global $database,$city;
	 if($city->IsBuildingReady($pos))
	    if($this->currentLevel<18)
	 	 return $this->currentLevel+1;
		else return 18;
	 else
	 	return $this->currentLevel+2;
	}
	public function canBuild(){
	 global $database,$city;
	 $bo = $database->GetCityBuildingOp($city->cid);
	 if($bo["id"]=="")
	 	return true;
	 return false;
	}
	public function checkResource($bid,$level){
	 global $city;
	 if(($this->GetBuildingReqWood($bid,$level)<=$city->awood) &&
	    ($this->GetBuildingReqWine($bid,$level)<=$city->awine) &&
		($this->GetBuildingReqCrystal($bid,$level)<=$city->acrystal) &&
		($this->GetBuildingReqSulfur($bid,$level)<=$city->asulfur) &&
		($this->GetBuildingReqMarble($bid,$level)<=$city->amarble))
		return true;
	 return false;
	}
	public function GetBuildingReqWood($bid,$level){
	 global $buildingsNames;
	 $name = $buildingsNames[$bid];
	 global $$name;
	 $id = $$name;
	 return $this->CalcRequRes($id[$level]["wood"])-($id[$level]["wood"]*$this->costsDecWood/100);
	}
	public function GetBuildingReqWine($bid,$level){
	 global $buildingsNames;
	 $name = $buildingsNames[$bid];
	 global $$name;
	 $id = $$name;
	 return $this->CalcRequRes($id[$level]["wine"])-($id[$level]["wine"]*$this->costsDecWine/100);
	}
	public function GetBuildingReqCrystal($bid,$level){
	 global $buildingsNames;
	 $name = $buildingsNames[$bid];
	 global $$name;
	 $id = $$name;
	 return $this->CalcRequRes($id[$level]["crystal"])-($id[$level]["crystal"]*$this->costsDecCrystal/100);
	}
	public function GetBuildingReqSulfur($bid,$level){
	 global $buildingsNames;
	 $name = $buildingsNames[$bid];
	 global $$name;
	 $id = $$name;
	 return $this->CalcRequRes($id[$level]["sulfur"])-($id[$level]["sulfur"]*$this->costsDecSulfur/100);
	}
	public function GetBuildingReqMarble($bid,$level){
	 global $buildingsNames;
	 $name = $buildingsNames[$bid];
	 global $$name;
	 $id = $$name;
	 return $this->CalcRequRes($id[$level]["marble"])-($id[$level]["marble"]*$this->costsDecMarble/100);
	}
	public function GetBuildingReqTime($bid,$level){
	 global $buildingsNames;
	 $name = $buildingsNames[$bid];
	 global $$name;
	 $id = $$name;
	 return $id[$level]["time"];
	}
	
	private function constructBuilding($bid,$pos) {
		global $database,$city,$session;
		$uptimerequire = $this->GetBuildingReqTime($bid,1);
		$time = time() + $uptimerequire;
		if($this->meetRequirement($bid)) {
		 if($database->addBuilding($city->cid,$pos,$bid,0,1,time(),$time)) 
		 {
		   $database->modifyResource($city->cid,
		               $this->GetBuildingReqWood($bid,1),
					   $this->GetBuildingReqCrystal($bid,1),
					   $this->GetBuildingReqMarble($bid,1),
					   $this->GetBuildingReqWine($bid,1),
					   $this->GetBuildingReqSulfur($bid,1),
					   $city->pop,0);
		   $database->setBuildingsField($city->cid,"b".$pos,"-1");
		   $database->setBuildingsField($city->cid,"b".$pos."t",$bid);
		   header("Location: action.php?view=city&id=".$city->cid);
		 }
	   }
	   else
		header("Location: action.php?view=error");
	}
	
	private function upgradeBuilding($pos,$level) {
		global $database,$city,$session;
		if(!$pos)
		 $bid = 0;
		else{
		 if($pos<14) $bid = $city->buildingsLevels["b".$pos."t"];
		 else $bid = 5;
		}
		$uptimerequire = $this->GetBuildingReqTime($bid,$level+1);
		$time = time() + $uptimerequire;
		if($this->meetRequirement($bid)) {
		 if($database->addBuilding($city->cid,$pos,$bid,$level,$level+1,time(),$time)) 
		 {
		   $database->modifyResource($city->cid,
		               $this->GetBuildingReqWood($bid,$level+1),
					   $this->GetBuildingReqCrystal($bid,$level+1),
					   $this->GetBuildingReqMarble($bid,$level+1),
					   $this->GetBuildingReqWine($bid,$level+1),
					   $this->GetBuildingReqSulfur($bid,$level+1),
					   $city->pop,0);
		   $database->setBuildingsField($city->cid,"b".$pos,"-1");
		   header("Location: action.php?view=city&id=".$city->cid);
		 }
	   }
	   else
		header("Location: action.php?view=error");
	}
	
	public function meetRequirement($bid) {
		global $research;
		switch($bid) {
		    case 0:return true;break;
			case 1:return true;break;
			case 2:return true;break;
			case 3:return true;break;
			case 4:
			 if($research->GetResearchStatus("R4")>0)
			  return true;
			 return false;
			case 5:return true;break;
			case 6:
				if($research->GetResearchStatus("R2")>0)
			  return true;
			 return false;
			case 7:
				if($research->GetResearchStatus("R2")>2)
			  return true;
			 return false;
			case 8:
				if($research->GetResearchStatus("R1")>2)
			  return true;
			 return false;
			case 9:
				if($research->GetResearchStatus("R2")>3)
			  return true;
			 return false;
			case 10:
				if($research->GetResearchStatus("R3")>2)
			  return true;
			 return false;
			case 11:
				if($research->GetResearchStatus("R3")>3)
			  return true;
			 return false;
			case 12:case 13:case 14:case 15:case 16:
				if($research->GetResearchStatus("R2")>4)
			  return true;
			 return false;
			case 17:
				if($research->GetResearchStatus("R3")>5)
			  return true;
			 return false;
			case 18:
				if($research->GetResearchStatus("R4")>8)
			  return true;
			 return false;
			case 19:
				if($research->GetResearchStatus("R3")>6)
			  return true;
			 return false;
			case 20:
				if($research->GetResearchStatus("R2")>6)
			  return true;
			 return false;
			case 21:
				if($research->GetResearchStatus("R3")>8)
			  return true;
			 return false;
			case 22:
				if($research->GetResearchStatus("R1")>3)
			  return true;
			 return false;
			case 23:
				if($research->GetResearchStatus("R2")>5)
			  return true;
			 return false;
			case 24:
				if($research->GetResearchStatus("R2")>11)
			  return true;
			 return false;
		}
	}
	public function GetBUpPercent2Finish(){
	 global $database,$city;
	 $darray = $database->GetCityBuildingOp($city->cid);
	 $time =  $darray["timestamp"] - $darray["starttime"];
	 $t = $darray["timestamp"] - time();
	 return floor($t*100/$time);
	}
	public function GetBUpgradingTime(){
	 global $database,$city;
	 $darray = $database->GetCityBuildingOp($city->cid);
	 return $darray["timestamp"];
	}
	public function GetBUpgradingStartTime(){
	 global $database,$city;
	 $darray = $database->GetCityBuildingOp($city->cid);
	 return $darray["starttime"];
	}
	public function AmIUpgrading($pos){
	 global $database,$city;
	 $bo = $database->GetCityBuildingOp($city->cid);
	 if($bo["pos"]==$pos)
	 	return true;
	 return false;
	}
	public function CalcRequRes($res){
	 return $res - round($res*$this->costsDecreasingPercent/100);
	}

};

?>