<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : CCity.php                                ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php
include("CBuilding.php");
include("core/CUnits.php");
include("core/CShips.php");

class CCity {
	public $type;
	public $position;
	public $iid;
	public $uid;
	public $x,$y;
	public $buildingsLevels = array();
	public $awood,$awine,$amarble,$acrystal,$asulfur,$pop,$maxpop,$citizens,$woodworkers,$specialworkers,$scientists,$priests,$maxstore,$maxtroops ;
	public $woodp,$specialp;
	public $growingupPop;
	public $ambrosia,$gold,$ships,$aships;
	public $maxWoodWorkers,$maxSpecialWorkers;
	public $movpoints,$avMovpoints;
	public $corruption,$happiness;
	public $cid,$cname,$capital,$tavernWine;
	private $infoarray = array();
	private $production = array();
	public $IsAdvResearchActive = false;
	
	function CCity() {
		global $session,$research;
		if(isset($_GET['view']) && isset($_GET['id'])&& $_GET['view']=="city")
		 $_SESSION['cid'] = $_GET['id'];
		if(isset($_SESSION['cid'])) {
			$this->cid = $_SESSION['cid'];
		}
		else {
		  $this->cid = $session->cities[0];
		  $_SESSION['cid'] = $this->cid;
		}
		$this->LoadCity();
		$this->calculateProduction();
		$research->scientists = $this->scientists;
		$rs = $research->CountResearches();
		if(!$research->IsNoEnoughPoints("R1",$research->GetNextResearch("R1")) ||
		!$research->IsNoEnoughPoints("R2",$research->GetNextResearch("R2")) ||
		!$research->IsNoEnoughPoints("R3",$research->GetNextResearch("R3")) ||
		!$research->IsNoEnoughPoints("R4",$research->GetNextResearch("R4")))
			$this->IsAdvResearchActive = true;
	}
	
	public function getProd($type) {
		return $this->production[$type];
	}
	
	private function LoadCity() {
		global $database,$session/*,$logging*//*,$technology*/;
		$this->infoarray = $database->getCity($this->cid);
		if($this->infoarray['uid'] != $session->uid && !$session->isAdmin) {
			unset($_SESSION['cid']);
			//$logging->addIllegal($session->uid,$this->cid,1);
			$this->cid = $session->cities[0];
			$this->infoarray = $database->getCity($this->cid);
		}
		$this->buildingsLevels = $database->getBuildingsLevels($this->cid);
		$this->iid = $this->infoarray["iid"];
		$this->uid = $this->infoarray["uid"];
		$this->position = $this->infoarray["position"];
		//echo "island::".$this->island."<br/>";
		$this->type = $database->getIslandField($this->iid,"rtype");
		$this->x = $database->getIslandField($this->iid,"x");
		$this->y = $database->getIslandField($this->iid,"y");
		$this->capital = $this->infoarray['capital'];
		$this->cname = $this->infoarray['name'];
		$this->awood = $this->infoarray['wood'];
		$this->acrystal = $this->infoarray['crystal'];
		$this->amarble = $this->infoarray['marble'];
		$this->awine = $this->infoarray['wine'];
		$this->asulfur = $this->infoarray['sulfur'];
		$this->pop = $this->infoarray['pop'];
		$this->maxstore = $this->infoarray['maxstore'];
		$this->maxpop = $this->infoarray['maxpop'];
		$this->citizens = $this->infoarray['citizens'];
		$this->woodworkers = $this->infoarray['woodworkers'];
		$this->specialworkers = $this->infoarray['specialworkers'];
		$this->scientists = $this->infoarray['scientists'];
		$this->priests = $this->infoarray['priests'];
		$this->maxtroops  = $this->infoarray['maxtroops'];
		$this->movpoints = $this->infoarray['movpoints'];
		$this->gold = $database->getUserField($this->uid,'gold',false);
		$this->ships = $database->getUserField($this->uid,'ships',false);
		$this->aships = $this->ships;
		$this->ambrosia = $database->getUserField($this->uid,'ambrosia',false);
		$this->tavernWine = $this->infoarray['tavernWine'];
		//print_r($this->infoarray);
	}
	
	private function calculateProduction() { 
		global $database,$session;
		$this->production['wood'] = $this->getWoodProd();
		$this->production['crystal'] = $this->getCrystalProd();
		$this->production['marble'] = $this->getMarbleProd();
		$this->production['wine'] = $this->getWineProd();
		$this->production['sulfur'] = $this->getSulfurProd();
		$this->avMovpoints = $this->movpoints;
		//calc corruption
		$this->corruption = 0;
		$cities = count($session->cities);
		$plevel = $this->getBuildingLevel2(8);
		if($plevel < ($cities-1)){
		 $this->corruption = 100;
		 $this->corruption -= 100/$cities;
		 $this->corruption -= round($plevel*(100/$cities));
		}
		//happiness
		$this->happiness = 196 - $this->pop;
		$rarray = $database->GetUserResearches($this->uid);
		if($this->IsCapital()&&$rarray["R3"]>0)
		    $this->happiness += 50;
		if($rarray["R2"]>7)
	        $this->happiness += 20;
		if($rarray["R2"]>13)
		   $this->happiness += 200;
		if($rarray["R2"]>14)
		    $this->happiness += 10*($rarray["R2"]-14);
		$this->happiness += $this->GetBuildingLevel2(9)*12;
		$this->happiness += $this->tavernWine*15;
		$this->happiness -= $this->corruption/100*196;
		//
		$this->growingupPop = round(($this->happiness*2)/100,2);
		if(($this->pop == $this->maxpop) &&
		    ($this->growingupPop >= 0))
			$this->growingupPop = 0;
		$this->goldp = $this->citizens * 3;
		$this->goldp -= $this->scientists * 9;
		$this->woodp = $this->production['wood'];
		$this->specialp = $this->specialworkers;
		$this->maxWoodWorkers=24*$database->getIslandField($this->iid,"woodlevel");
		if($this->maxWoodWorkers > $this->citizens)
			$this->maxWoodWorkers = $this->citizens;
		$this->maxSpecialWorkers=24*$database->getIslandField($this->iid,"minelevel");
		if($this->maxSpecialWorkers > $this->citizens)
			$this->maxSpecialWorkers = $this->citizens;
		if($this->getReqReExprTime()<=time())
		 $database->setExperimentField($this->uid,"timestamp",0);
		 
	}
	
	private function getWoodProd() {
	 $wp = $this->woodworkers;
	 $exwoodp = round($wp*($this->getBuildingLevel2(12)/100));
	 return round($wp+$exwoodp);
	}
	private function getCrystalProd() {
		global $database;
		$islandtype = $database->getIslandField($this->iid,'rtype');
		if($islandtype == "crystal")
			return $this->specialworkers;
		else
			return 0;
	}
	private function getMarbleProd() {
		global $database;
		$islandtype = $database->getIslandField($this->iid,'rtype');
		if($islandtype == "marble")
			return $this->specialworkers;
		else
			return 0;
	}
	private function getWineProd() {
		global $database;
		$islandtype = $database->getIslandField($this->iid,'rtype');
		if($islandtype == "wine")
			return $this->specialworkers;
		else
			return 0;
	}
	private function getSulfurProd() {
		global $database;
		$islandtype = $database->getIslandField($this->iid,'rtype');
		if($islandtype == "sulfur")
			return $this->specialworkers;
		else
			return 0;
	}
	public function getBuildingCount($bid){
		$c = 0;
		for($i=1; $i<14; $i++)
			if($this->buildingsLevels["b".$i."t"] == $bid)
				$c++;
		return $c;
	}
	public function newBuiListChekBuild($bid){
	 	for($i=1; $i<14; $i++)
			if($this->buildingsLevels["b".$i."t"] == $bid)
				return false;
	 return true;
	}
	public function canAction($action){
	 global $research;
	 switch($action){
	  case "transport":
	   if($research->GetResearchStatus("R1")>2)
	    return true;
	   return false;
	  case "defend_city":
	   return false;
	  case "defend_port":
	   return false;
	  case "plunder":
	   return true;
	  case "blockade":
	   return false;
	  case "occupy":
	   if($research->GetResearchStatus("R4")>7)
	    return true;
	   return false;
	  case "espionage":
	   if($research->GetResearchStatus("R3")>2)
	    return true;
	   return false;
	 }
	}
	public function ActionMeetReq($action){
	 global $research,$island,$units,$ships;
	 switch($action){
	  case "transport":
	   if($this->aships > 0)
	     return true;
	   return false;
	  case "defend_city":
	   return false;
	  case "defend_port":
	   return false;
	  case "plunder":
	   if($this->iid == $island->iid){
	    for($u=301; $u<316; $u++)
	     if($units->GetUnitsNbr("$u")>0)
		  return true;
	   }
	   else if($this->aships != 0){
	    for($u=301; $u<316; $u++)
	     if($units->GetUnitsNbr("$u")>0)
		  return true;
	   }
	   else return false;
	  case "blockade":
	   return false;
	  case "occupy":
	   if($this->iid == $island->iid){
	    for($u=301; $u<316; $u++)
	     if($units->GetUnitsNbr("$u")>0)
		  return true;
	   }
	   else if($this->aships != 0){
	    for($u=301; $u<316; $u++)
	     if($units->GetUnitsNbr("$u")>0)
		  return true;
	   }
	   else return false;
	  case "espionage":
	   return false;
	  case "deploy_army":
	   return false;
	  case "deploy_fleet":
	   return false;
	 }
	}
	public function increaseTransporter($get){
	 global $session,$database;
	 if(!isset($get['id']) || ($get['actionRequest'] != $session->checker))
	  header("Location: action.php?view=error");
	 $price = pow($this->ships,2)*20+600;
	 $this->ships++;
	 $this->aships++;
	 $database->modifyGold($this->uid,$this->gold-$price,0);
	 $database->updateUserField($this->uid,"ships",$this->ships,true);
	 header("Location: action.php?view=port&id=".$this->cid."&position=".$get['position']);
	}
	public function SetWorkers($workers, $value){
	 global $database;
	 if($value <= $this->maxWoodWorkers){
	  $database->setCityField($this->cid,$workers,$value);
	 }
	}
	public function IsSiteEmpty($pos){
		if($this->buildingsLevels["b".$pos] == 0)
			return true;
		return false;
	}
	public function IsBuildingReady($pos){
	 if($this->buildingsLevels["b".$pos] != -1)
	  return true;
	 return false;
	}
	public function GetBuildingLevel($pos){
	 if($this->buildingsLevels["b".$pos] != -1)
	  return $this->buildingsLevels["b".$pos];
	 else{
	  global $database;
	  $darray = $database->GetCityBuildingOp($this->cid);
	  return $darray["levelfrom"];
	 }
	}
	public function GetBuildingNameFromPos($pos){
	 if($pos == 0)
		return "townHall";
	 if($pos == 14)
		return "wall";
	 global $database,$buildingsNames,$city;
	 return $buildingsNames[$city->buildingsLevels["b".$pos."t"]];
	}
    public function GetBuildingFinishTime(){
	  global $database;
	  $darray = $database->GetCityBuildingOp($this->cid);
	  return $darray["timestamp"];
	}
	public function IsCapital(){
	 global $database;
	 if($database->getCityField($this->cid,"capital")==1)
	 	return true;
	 return false;
	}
	public function GetMaxScientists($academylevel){
	 global $academy;
	 if($academy[$academylevel]["sc"] < $this->citizens)
	 	return $academy[$academylevel]["sc"];
	 else
	 	return $this->citizens;
	}
	public function SetScientists($post){
	 global $database;
	 $maxs = $this->GetMaxScientists($this->buildingsLevels["b".$post['position']]);
	 if($post['s'] <= $maxs){
	  $database->setCityField($this->cid,"scientists",$post['s']);
	 }else{
	  $database->setCityField($this->cid,"scientists",$maxs);
	 }
	}
	public function getBuildingLevel2($building){
	 if($building == 5)
	  return $this->GetBuildingLevel(14);
	 if($building == 0)
	  return $this->GetBuildingLevel(0);
	 for($i=1; $i<14; $i++){
	  if($this->buildingsLevels["b".$i."t"] == $building)
	   return $this->GetBuildingLevel($i);
	 }
	 return 0;
	}
	public function GetWarehousesLevelSum(){
	 $level = 0;
	 for($i=2; $i<14; $i++)
	  if($this->buildingsLevels["b".$i."t"] == "6")
	   $level += $this->GetBuildingLevel($i);
	 return $level;
	}
	public function CalcIncomegold($cid){
	 global $database,$research;
	 $g = $database->getCityField($cid,"citizens") * 3;
	 $rp = 9;
	 if($research->GetResearchStatus("R3")>12)
	  $rp = 6;
	 $g -= $database->getCityField($cid,"scientists")*$rp;
	 $g -= $this->CalcShipsInsurance($cid);
	 $g -= $this->CalcUnitsInsurance($cid);
	 return $g;
	}
	public function CalcUnitsInsurance($cid){
	 $units = new CUnits(false);
	 $UnitsUpkeep = $units->CalcCityUpkeep($cid);
	 return round($UnitsUpkeep-$UnitsUpkeep*$units->UpkeepDiscount/100);
	}
	public function CalcShipsInsurance($cid){
	 $ships = new CShips(false);
	 $ShipsUpkeep = $ships->CalcCityUpkeep($cid);
	 return round($ShipsUpkeep-$ShipsUpkeep*$ships->UpkeepDiscount/100);
	}
	public function GetArHappiness(){
	 if($this->happiness>=300)
     	return "بفرح";
     else if(($this->happiness>=50)&&($this->happiness<300))
    	return "سعيد";
    else if(($this->happiness>=0)&&($this->happiness<50))
    	return "عادي";
    else if(($this->happiness<-50)&&($this->happiness>-1000))
    	return "حزين";
    else if($this->happiness<-1000)
    	return "غاضب";
	}
	public function GetHappinessHTMLClass(){
	 if($this->happiness>=300)
     	return "happiness_ecstatic";
     else if(($this->happiness>=50)&&($this->happiness<300))
    	return "happiness_happy";
    else if(($this->happiness>=0)&&($this->happiness<50))
    	return "happiness_neutral";
    else if(($this->happiness<-50)&&($this->happiness>-1000))
    	return "happiness_sad";
    else if($this->happiness<-1000)
    	return "happiness_outraged";
	}
	public function GetIslandTGArMerch($cid){
	 global $database;
	 $iid = $database->getCityField($cid,"iid");
	 $specialRes = $database->getIslandField($iid,"rtype");
	 switch($specialRes){
	  case "crystal":return "زجاج بلوري";
	  case "wine":return "مشروب عنب";
	  case "marble":return "رخام";
	  case "sulfur":return "كبريت";
	 }
	}
	public function renameCity($post){
	 global $database,$session;
	 if(!isset($post['name'])||!isset($post['id'])||!isset($post['actionRequest'])||($post['actionRequest'] != $session->checker))
	  header("Location: action.php?view=error");
	 $database->setCityField($post['id'],"name",$post['name']);
	}
	public function getLoadSpeed(){
	 $s = $this->getBuildingLevel2(3)*50;
	 if($s)
	  return $s;
	 else return 30;
	}
	public function changeCurrentCity($post){
	 global $database,$session;
	 if(!isset($post['cityId'])||!isset($post['oldView']))
	  header("Location: action.php?view=error");
	  $_SESSION['cid'] = $post['cityId'];
	  $_SESSION['iid'] = $database->getCityField($post['cityId'],"iid");
	  header("Location: action.php?view=city&id=".$_SESSION['cid']);
	}
	public function assignWinePerTick($post){
	global $database,$session;
	 if(!isset($post['amount'])||!isset($post['id'])||!isset($post['position'])||!isset($post['actionRequest'])||($post['actionRequest'] != $session->checker))
	  header("Location: action.php?view=error");
	 $database->setCityField($post['id'],"tavernWine",$post['amount']*4);
	 header("Location: action.php?view=tavern&id=".$_SESSION['cid']."&position=".$post['position']);
	}
	public function getReqExprCrystal(){
	 global $database;
	 return $database->getExperimentField($this->uid,"reqCrystal");
	}
	public function getReqReExprTime(){
	 global $database;
	 return $database->getExperimentField($this->uid,"timestamp");
	}
	public function buyResearch($post){
	 global $database,$session,$research;
	 if(!isset($post['id'])||!isset($post['position'])||!isset($post['actionRequest'])||($post['actionRequest'] != $session->checker))
	  header("Location: action.php?view=error");
	 $reqCrystal = $this->getReqExprCrystal();
	 $rs = $research->CountResearches();
	 $rs += round($reqCrystal/2);
	 $database->setCityField($this->cid,"crystal",$this->acrystal-$reqCrystal);
	 $database->setExperimentField($this->uid,"reqCrystal",$reqCrystal+2000);
	 $database->setExperimentField($this->uid,"timestamp",time()+14400);
	 $rscore = $database->getUserField($this->uid,"research_score",0);
	 $rscore += round($reqCrystal/2*0.02);
	 $database->updateUserField($this->uid,"research_score",$rscore,1);
	 $database->updateUserField($this->uid,"researches",$rs,1);
	 header("Location: action.php?view=academy&id=".$post['id']."&position=".$post['position']);
	}
	public function buildSpy($post){
	 global $database,$session,$research;
	 if(!isset($post['id'])||!isset($post['position'])||!isset($post['actionRequest'])||($post['actionRequest'] != $session->checker))
	  header("Location: action.php?view=error");
	 
	 header("Location: action.php?view=safehouse&id=".$post['id']."&position=".$post['position']);
	}
};
?>