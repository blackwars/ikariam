<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : CSession.php                             ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php
include("Config.php");
include("database/CMySql.php");
include("CGenerator.php");
include("CMailer.php");
include("CForm.php");
include("buildingsdata.php");
include("CResearch.php");
include("CLog.php");
include("CTransport.php");
include("ships.php");
include("units.php");
class CSession {
	var $logged_in = false;
	var $referrer, $url;
	var $username,$usermail,$uid,$access,$isAdmin;
	var $checker,$mchecker;
	public $userinfo = array();
	private $userarray = array();
	var $cities = array();
	public $barbarian;
	public $IsAdvMilitaryActive = false;
	public $IsAdvDiplomacyActive = false;

	function CSession() {
		session_start();
		global $database,$log;
		$this->logged_in = $this->checkLogin();
		if($this->logged_in && TRACK_USR) {
		  $database->updateActiveUser($_SESSION['username'],time());
		  $this->barbarian = $database->getBarbarianRow($this->uid);
		 }	  
		if(isset($_SESSION['url'])){
         $this->referrer = $_SESSION['url'];
		 }else{
			 $this->referrer = "/";
		}
		$this->url = $_SESSION['url'] = $_SERVER['PHP_SELF'];
		if($this->logged_in){
		 $this->updateBuildings();
		 $this->MakeGlobalUpdates();
		 global $log;
		 $log->loadAvatarLogs($this->uid);
		}
	}
	
	public function Login($user) {
		global $database,$generator,$log;
		$this->logged_in = true;
		$_SESSION['sessid'] = $generator->generateRandID();
		$_SESSION['username'] = $user;	
		$_SESSION['checker'] = $generator->generateRandStr(20);
		$_SESSION['mchecker'] = $generator->generateRandStr(5);
		$_SESSION['userid'] = $database->getUserField($user,"id",true);
		$this->PopulateVar();
		
		$database->addActiveUser($_SESSION['username'],time());
		$database->updateUserField($_SESSION['username'],"sessid",$_SESSION['sessid'],0);
		$log->AddLoginLog($_SESSION['username'],$_SERVER['REMOTE_ADDR'],date("F j, Y, g:i a"));
	}
	
	public function Logout() {
		global $database;
		$this->logged_in = false;
		$database->updateUserField($_SESSION['username'],"sessid","",0);
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		session_destroy();
		session_start();
	}
	
	public function changeChecker() {
		global $generator;
		$this->checker = $_SESSION['checker'] = $generator->generateRandStr(20);
		$this->mchecker = $_SESSION['mchecker'] = $generator->generateRandStr(5);
	}
	
	private function checkLogin() {
		global $database;
		if(isset($_SESSION['username']) && isset($_SESSION['sessid'])) {
			if(!$database->checkActiveSession($_SESSION['username'],$_SESSION['sessid'])) {
				$this->Logout();
				return false;
			}
			else {
				$this->PopulateVar();
				$database->updateUserField($_SESSION['username'],"timestamp",time(),0);	
				return true;
			}
		}
		else {
			return false;
		}
	}
	
	private function PopulateVar() {
		global $database;
		$this->userarray = $database->getUserArray($_SESSION['username'],0);
		$this->username = $this->userarray['username'];
		$this->uid = $this->userarray['id'];
		$this->access = $this->userarray['access'];
		$this->isAdmin = $this->access == ADMIN;
		$this->checker = $_SESSION['checker'];
		$this->mchecker = $_SESSION['mchecker'];
		$this->usermail = $this->userarray['email'];
		$this->cities = $database->getCitiesID($this->uid);
	}
	public function CalcIncomegold($cid){
	 global $database;
	 $g = $database->getCityField($cid,"citizens") * 3;
	 $rp = 9;
	 $rarray = $database->GetUserResearches($this->uid);
	 if($rarray["R3"]>12)
	  $rp = 6;
	 $g -= $database->getCityField($cid,"scientists")*$rp;
	 $g -= $this->CalcShipsInsurance($cid);
	 $g -= $this->CalcUnitsInsurance($cid);
	 return $g;
	}
	public function CalcUnitsInsurance($cid){
	 global $database,$units;
	 $us = array();
	 $us = $database->getUnits($cid);
	 $UnitsUpkeep = 0;
	 for($u=301; $u<316; $u++){
	  $unit = "u".$u;
	  global $$unit;
	  $id = $$unit;
	  $UnitsUpkeep += $id["upkeep"] * $us[$unit];
	 }
	 $rarray = $database->GetUserResearches($this->uid);
	 $UpkeepDiscount = 0;
	 if($rarray["R4"] > 1)
	 	$UpkeepDiscount += 2;
	 if($rarray["R4"] > 4)
	 	$UpkeepDiscount += 4;
	 if($rarray["R4"] > 9)
	 	$UpkeepDiscount += 8;
	 if($rarray["R4"]>13)
	  $UpkeepDiscount += 2*($rarray["R4"]-13);
	 return round($UnitsUpkeep-$UnitsUpkeep*$UpkeepDiscount/100);
	}
	public function CalcShipsInsurance($cid){
	 global $database;
	 $ss = array();
	 $ss = $database->getShips($cid);
	 $ShipsUpkeep = 0;
	 for($s=210; $s<217; $s++){
	  $ship = "s".$s;
	  global $$ship;
	  $id = $$ship;
	  $ShipsUpkeep += $id["upkeep"] * $ss[$ship];
	 }
	 $rarray = $database->GetUserResearches($this->uid);
	 $UpkeepDiscount = 0;
	 if($rarray["R1"] > 1)
	 	$UpkeepDiscount += 2;
	 if($rarray["R1"] > 4)
	 	$UpkeepDiscount += 4;
	 if($rarray["R1"] > 9)
	 	$UpkeepDiscount += 8;
	 if($rarray["R1"]>13)
	  $UpkeepDiscount += 2*($rarray["R1"]-13);
	 return round($ShipsUpkeep-$ShipsUpkeep*$UpkeepDiscount/100);
	}
	public function MakeGlobalUpdates(){
	 global $database;
	 $timepast = abs(time() - $this->userarray['timestamp']);
	 //Update pop & gold
		$hours = floor($timepast / 3600);
		$ngold = $database->getUserField($this->uid,'gold',false);
		//upkeeps
		/*$units = new CUnits(false);
		$UnitsAllUpkeep = $units->CalcUpkeep();
		$Unitsboldcosts=round($UnitsAllUpkeep-$UnitsAllUpkeep*$units->UpkeepDiscount/100);
		$ships = new CShips(false);
		$ShipsAllUpkeep = $ships->CalcUpkeep();
		$Shipsboldcosts=round($ShipsAllUpkeep-$ShipsAllUpkeep*$ships->UpkeepDiscount/100);
		$upkeeps = $Unitsboldcosts + $ShipsAllUpkeep;
		$SCupkeeps = $database->getCityField($this->cid,"scientists")*9;*/
		//upkeeps end
		$cities = count($this->cities);
		$pop = array();
		$maxpop = array();
		$citizens = array();
		$happiness = array();
		$growingupPop = array();
		$tavernWine = array();
		$production = array();
		$nwood = array();
		$nwine = array();
		$nmarble = array();
		$ncrystal = array();
		$nsulfur = array();
		$points = 0;
		$rarray = $database->GetUserResearches($this->uid);
		for($i=0; $i<$cities; $i++){
         $cid = $this->cities[$i];
		 $pop[]=$database->getCityField($cid,"pop");
		 $maxpop[]=$database->getCityField($cid,"maxpop");
		 $citizens[]=$database->getCityField($cid,"citizens");
		 //clac corruptiopn
		 $corruption = 0;
		 $darray = $database->getBuildingsLevels($cid);
		 $palacelevel = 0;
		 for($j=1; $j<14; $j++)
 		  if($darray["b".$j."t"] == 8)
  			$palacelevel =  $darray["b".$j];
		 if($palacelevel<0){
          $barray = $database->GetCityBuildingOp($cid);
          $palacelevel=$barray["levelfrom"];
         }
		 if($palacelevel < $cities){
		  $corruption = 100;
		  $corruption -= 100/$cities;
		  $corruption -= round($palacelevel*(100/$cities));
		 }
		 $tavernlevel = 0;
		 for($j=1; $j<14; $j++)
 		  if($darray["b".$j."t"] == 9)
  			$tavernlevel =  $darray["b".$j];
		 if($tavernlevel<0){
          $barray = $database->GetCityBuildingOp($cid);
          $tavernlevel=$barray["levelfrom"];
         }
		 $tavernWine[] = $database->getCityField($cid,"tavernWine");
		 //happiness
		 $isCapital = $database->getCityField($cid,"capital");
		 $happiness[] = 196 - $pop[$i];
		 if($isCapital&&$rarray["R3"]>0)
		    $happiness[$i] += 50;
		 if($rarray["R2"]>7)
	        $this->happiness += 20;
		 if($rarray["R2"]>13)
		    $happiness[$i] += 200;
		 if($rarray["R2"]>14)
		    $happiness[$i] += 10*($rarray["R2"]-14);
		 $happiness[$i] += $tavernlevel*12;
		 $happiness[$i] += $tavernWine[$i]*15;
		 $happiness[$i] -= $corruption/100*196;
		 $growingupPop[] = round(($happiness[$i]*2)/100,2);
		 //productions
		 $nwood[]=$database->getCityField($cid,"wood");
		 $nwine[]=$database->getCityField($cid,"wine");
		 $nmarble[]=$database->getCityField($cid,"marble");
		 $ncrystal[]=$database->getCityField($cid,"crystal");
		 $nsulfur[]=$database->getCityField($cid,"sulfur");
		 $iid = $database->getCityField($cid,"iid");
		 $islandResName = $database->getIslandField($iid,"rtype");
		 $production[]['wood'] = $database->getCityField($cid,"woodworkers");
		 $forester = 0;
		 for($j=1; $j<14; $j++)
 		  if($darray["b".$j."t"] == 12)
  			$forester =  $darray["b".$j];
		 if($tavernlevel<0){
          $barray = $database->GetCityBuildingOp($cid);
          $forester=$barray["levelfrom"];
         }
		 $production[$i]['wood'] += $production[$i]['wood']*$forester/100;
		 $specialworkers = $database->getCityField($cid,"specialworkers");
		 $production[$i]['crystal'] = 0;
		 $production[$i]['marble'] = 0;
		 $production[$i]['wine'] = 0;
		 $production[$i]['sulfur'] = 0;
		 $production[$i]["$islandResName"] = $specialworkers;
		}
		for($i=0; $i<$hours; $i++){
		 for($c=0; $c<$cities; $c++){
          $cid = $this->cities[$c];
		  $nwood[$c] += $production[$c]['wood'];
		  $ncrystal[$c] += $production[$c]['crystal'];
		  $nmarble[$c] += $production[$c]['marble'];
		  $nwine[$c] += $production[$c]['wine'];
		  $nwine[$c] -= $tavernWine[$c];
		  $nsulfur[$c] += $production[$c]['sulfur'];
		  $incomegold = $this->CalcIncomegold($cid);
		  if(($pop[$c]+$growingupPop[$c]) <= $maxpop[$c]){
		   $pop[$c] += $growingupPop[$c];
		   $points += $growingupPop[$c];
		   $citizens[$c] += $growingupPop[$c];
		   $happiness[$c] -= $growingupPop[$c];
		   $growingupPop[$c] = round(($happiness[$c] * 2)/100,2);
		  }
		  else{
		   $delta = $maxpop[$c] - $pop[$c];
		   $citizens[$c] += $delta;
		   $points += $delta;
		   $pop[$c] = $maxpop[$c];
		  }
		  $ngold += $incomegold;
		 }
		}
		$extratime = $timepast - 3600*floor($timepast / 3600);
		$extratime /= 3600;
		for($c=0; $c<$cities; $c++){
		 $nwood[$c] += $production[$c]['wood']*$extratime;
		 $ncrystal[$c] += $production[$c]['crystal']*$extratime;
		 $nmarble[$c] += $production[$c]['marble']*$extratime;
		 $nwine[$c] += $production[$c]['wine']*$extratime;
		 $nsulfur[$c] += $production[$c]['sulfur']*$extratime;
		 $g = round($growingupPop[$c]*$extratime);
		 if(($pop[$c]+$g) <= $maxpop[$c]){
		   $pop[$c] += $g;
		   $points += $g;
		   $citizens[$c] += $g;
		   $ngold += round(($citizens[$c]*3)*$extratime);
		  }
		  else{
		   $delta = $maxpop[$c] - $pop[$c];
		   $citizens[$c] += $delta;
		   $points += $delta;
		   $pop[$c] = $maxpop[$c];
		  }
		 if($pop[$c] > $maxpop[$c]){
		  $citizens[$c] -= $pop[$c]-$maxpop[$c];
		  $pop[$c] = $maxpop[$c];
		 }
		}
		$temp = $database->getUserField($this->uid,"points",0);
		$database->updateUserField($this->uid,"points",round($temp+$points),1);
		$database->modifyGold($this->uid,$ngold,0);
		for($c=0; $c<$cities; $c++){
          $cid = $this->cities[$c];
		 $maxstore = $database->getCityField($cid,"maxstore");
		 if($nwood[$c] > $maxstore) $nwood[$c] = $maxstore;
		 if($ncrystal[$c] > $maxstore) $ncrystal[$c] = $maxstore;
		 if($nmarble[$c] > $maxstore) $nmarble[$c] = $maxstore;
		 if($nwine[$c] > $maxstore) $nwine[$c] = $maxstore;
		 if($nsulfur[$c] > $maxstore) $nsulfur[$c] = $maxstore;
		 $database->setCityField($cid,"wood",$nwood[$c]);
		 $database->setCityField($cid,"wine",$nwine[$c]);
		 $database->setCityField($cid,"marble",$nmarble[$c]);
		 $database->setCityField($cid,"crystal",$ncrystal[$c]);
		 $database->setCityField($cid,"sulfur",$nsulfur[$c]);
		 $database->setCityField($cid,"pop",$pop[$c]);
		 $database->setCityField($cid,"citizens",$citizens[$c]);
		 $database->updateCity($cid);
		}
	 //Update pop & gold ends
	 //Calculate researches
	 $points = $database->getUserField($this->uid,"points",0);
	 $researches = $this->userarray["researches"];
	 $userResearches = array();
	 $userResearches = $database->GetUserResearches($this->uid);
	 $ns = 0;
	 $expr=$database->getExperimentField($this->uid,"reqCrystal");
	 for($i=0; $i<$cities; $i++){
 	  $tcity = $this->cities[$i];
 	  $sp = $database->getCityField($tcity,"scientists");
	  $ns += ($sp / 3600) * $timepast;
	  $expr += round($timepast / 360);
	 }
	 $database->setExperimentField($this->uid,"reqCrystal",$expr);
	 $p = 0;
	 if($userResearches["R3"] > 1) $p += 2;
	 if($userResearches["R3"] > 4) $p += 4;
	 if($userResearches["R3"] > 10) $p += 8;
	 if($userResearches["R3"] > 15) $p += 2*($userResearches["R3"]-15);
	 $ns += $ns*$p/100;
	 $researches += round($ns);
	 $points += round($ns*0.02);
	 $database->updateUserField($this->uid,"points",$points,1);
	 $rscore = $database->getUserField($this->uid,"research_score",0);
	 $rscore += round($ns*0.02);
	 $database->updateUserField($this->uid,"research_score",$rscore,1);
	 $database->updateUserField($this->uid,"researches",$researches,1);
	 //Calculate researches ends.
	}
	function getAvatarNotes(){
	 return "";
	}
	private function updateBuildings() {
	global $database,$log;
	$cities = count($this->cities);
    for($i=0; $i<$cities; $i++){
	 $cid = $this->cities[$i];
	 $IsCapital = $database->getCityField($cid,"capital");
     $buildingsLevels = $database->getBuildingsLevels($cid);
	 $darray = $database->GetCityBuildingOp($cid);
	 for($pos=0;$pos<15;$pos++)
	 if($buildingsLevels["b".$pos] == -1)
	  if($darray["timestamp"] <= time()){
	   $darray = $database->GetCityBuildingOp($cid);
	   $database->removeBuilding($darray["id"]);
	   $database->setBuildingsField($cid,"b".$pos,$darray["levelto"]);
	   //Update points
		global $buildingsNames;
		$name = $buildingsNames[$darray["type"]];
	 	global $$name;
	 	$id = $$name;
	 	$points = $id[$darray["levelto"]]["wood"]
		 + $id[$darray["levelto"]]["wine"]
		 + $id[$darray["levelto"]]["marble"]
		 + $id[$darray["levelto"]]["crystal"]
		 + $id[$darray["levelto"]]["sulfur"];
		$points = round($points*0.01);
		$temp = $database->getUserField($this->uid,"points",0);
		$database->updateUserField($this->uid,"points",($temp+$points),1);
		$temp = $database->getUserField($this->uid,"building_score",0);
		$database->updateUserField($this->uid,"building_score",$temp+$points,1);
		$log->AddBuildingLog($this->uid,$cid,$name,$pos,$darray["levelto"]);
		//Update points end
		$buildingsLevels = $database->getBuildingsLevels($cid);
		switch($name){
		 case "townHall":
		  $maxpop = $id[$darray["levelto"]]["maxpop"];
		  if($IsCapital){
		   $rarray = $database->GetUserResearches($this->uid);
		   if($rarray["R3"]>0)
		    $maxpop += 50;
		   if($rarray["R2"]>13)
		    $maxpop += 200;
		  }  
		  $database->setCityField($cid,"maxpop",$maxpop);
		  $movpoints = $database->getCityField($cid,"movpoints");
		  $database->setCityField($cid,"movpoints",$movpoints+1);
		 break;
		 case "warehouse":
		  $whl = 0;
	      for($j=2; $j<14; $j++)
	       if($buildingsLevels["b".$j."t"] == "6")
		    if($buildingsLevels["b".$pos] != -1)
	          $whl += $buildingsLevels["b".$pos];
	        else
	         $whl += $darray["levelfrom"];
		 $capacity = $whl*32000 + 1500;
		 $database->setCityField($cid,"maxstore",$capacity);
		 break;
		 case "wall":
		  $maxtrs = $database->getCityField($cid,"maxtroops");
		  $database->setCityField($cid,"maxtroops",$maxtrs+300);
		 break;
		}
	  }
	 }
	}
};

$session = new CSession;
$form = new CForm;
$research = new CResearch;
$transport = new CTransport;
?>