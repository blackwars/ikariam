<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : CResearch.php                            ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php
include("research.php");
class CResearch{

	private $userResearches = array();
	public $scientists;
	
	function CResearch() {
	 global $database,$session;
	 if($session->logged_in){
	  $this->userResearches = $database->GetUserResearches($session->uid);
	 }
	}
	public function CountScientists(){
	 global $database,$session;
	 $s = 0;
	 for($i=0; $i<count($session->cities); $i++){
 	  $tcity = $session->cities[$i];
 	  $s += $database->getCityField($tcity,"scientists");
	 }
	 return $s;
	}
	public function CountResearches(){
	 global $database,$session;
 	 return $database->getUserField($session->uid,"researches",0);
	}
	public function GetNextResearch($R){
	 global $$R;
	 $rid = $$R;
	 $rlevel = $this->userResearches[$R];
	 $max = 0;
	 switch($R){
	  case "R1":$max = 13;break;
	  case "R2":$max = 15;break;
	  case "R3":$max = 16;break;
	  case "R4":$max = 14;break;
	 }
	 if($rlevel<=$max)
	 	return $rlevel+1;
	 return $rlevel;
	}
	public function GetResearchName($R,$level){
	 global $$R;
	 $rid = $$R;
	 switch($R){
	  case "R1":$max = 13;break;
	  case "R2":$max = 15;break;
	  case "R3":$max = 16;break;
	  case "R4":$max = 14;break;
	 }
	 if($level>$max) $level = $max;
	 return $rid[$level]["name"];
	}
	public function GetResearchDesc($R,$level){
	 global $$R;
	 $rid = $$R;
	 switch($R){
	  case "R1":$max = 13;break;
	  case "R2":$max = 15;break;
	  case "R3":$max = 16;break;
	  case "R4":$max = 14;break;
	 }
	 if($level>$max) $level = $max;
	 return $rid[$level]["desc"];
	}
	public function GetResearchPoints($R,$level){
	 global $$R;
	 $rid = $$R;
	 switch($R){
	  case "R1":$max = 13;break;
	  case "R2":$max = 15;break;
	  case "R3":$max = 16;break;
	  case "R4":$max = 14;break;
	 }
	 if($level>$max) $level = $max;
	 return $rid[$level]["points"];
	}
	public function IsNoEnoughPoints($R,$level){
	 global $$R;
	 $rid = $$R;
	 switch($R){
	  case "R1":$max = 13;break;
	  case "R2":$max = 15;break;
	  case "R3":$max = 16;break;
	  case "R4":$max = 14;break;
	 }
	 if($level>$max) $level = $max;
	 $points = $rid[$level]["points"];
	 if($points <= $this->CountResearches())
	 	return false;
	 return true;
	}
	public function IsNoEnoughConds($R,$level){
	 /*if($level != ($this->userResearches[$R]+1))
	 	return true;*/
	 switch($R){
	  case "R1":
	   switch($level){
	    case 3:if($this->userResearches["R2"] < 3) return true;break;
		case 4:if($this->userResearches["R3"] < 3) return true;break;
		case 6:if($this->userResearches["R2"] < 5) return true;break;
		case 7:if($this->userResearches["R3"] < 3) return true;break;
		case 8:if($this->userResearches["R3"] < 7) return true;break;
		case 9:if($this->userResearches["R4"] < 8) return true;break;
		case 11:if($this->userResearches["R3"] < 7) return true;break;
		case 12:if($this->userResearches["R3"] < 9) return true;break;
		case 13:if(($this->userResearches["R2"] < 14) ||
		           ($this->userResearches["R3"] < 15) ||
				   ($this->userResearches["R4"] < 13))
				    return true;break;
		default:return false;
	   }
	  break;
	  case "R2":
	   switch($level){
	    case 4:if($this->userResearches["R3"] < 1) return true;break;
		case 5:if($this->userResearches["R1"] < 3) return true;break;
		case 7:if($this->userResearches["R3"] < 4) return true;break;
		case 9:if($this->userResearches["R1"] < 6) return true;break;
		case 10:if($this->userResearches["R3"] < 7) return true;break;
		case 14:if(($this->userResearches["R1"] < 9) ||
		           ($this->userResearches["R3"] < 13) ||
				   ($this->userResearches["R4"] < 11))
				    return true;break;
		case 15:if(($this->userResearches["R1"] < 12) ||
		           ($this->userResearches["R3"] < 15) ||
				   ($this->userResearches["R4"] < 13))
				    return true;break;
		default:return false;
	   }
	  break;
	  case "R3":
	   switch($level){
	    case 3:if($this->userResearches["R2"] < 3) return true;break;
		case 4:if(($this->userResearches["R1"] < 3) ||
		           ($this->userResearches["R4"] < 3))
				    return true;break;
		case 6:if($this->userResearches["R2"] < 5) return true;break;
		case 9:if($this->userResearches["R2"] < 7) return true;break;
		case 12:if($this->userResearches["R4"] < 6) return true;break;
		case 13:if(($this->userResearches["R1"] < 8) ||
		           ($this->userResearches["R2"] < 10) ||
				   ($this->userResearches["R4"] < 9))
				    return true;break;
		case 14:if(($this->userResearches["R1"] < 11) ||
		           ($this->userResearches["R4"] < 13))
				    return true;break;
		case 16:if(($this->userResearches["R1"] < 12) ||
		           ($this->userResearches["R2"] < 14) ||
				   ($this->userResearches["R4"] < 13))
				    return true;break;
		default:return false;
	   }
	  break;
	  case "R4":
	   switch($level){
	    case 3:if($this->userResearches["R2"] < 3) return true;break;
		case 4:if($this->userResearches["R3"] < 3) return true;break;
		case 7:if($this->userResearches["R3"] < 6) return true;break;
		case 8:if($this->userResearches["R2"] < 4) return true;break;
		case 9:if($this->userResearches["R2"] < 5) return true;break;
		case 11:if($this->userResearches["R3"] < 9)return true;break;
		case 12:if($this->userResearches["R3"] < 9)return true;break;
		case 14:if(($this->userResearches["R1"] < 12) ||
		           ($this->userResearches["R2"] < 14) ||
				   ($this->userResearches["R3"] < 15))
				    return true;break;
		default:return false;
	   }
	  break;
	 }
	 return false;
	}
	public function doResearch($get){
	 if(!isset($get['type']) ||
	    !isset($get['actionRequest']))
		 header("Location: action.php?view=error");
	 global $database,$session,$city;
	 if($get['actionRequest'] != $session->checker)
	  header("Location: action.php?view=error");
	 $R = $get["type"];
	 $Rlevel = $this->GetNextResearch($R);
	 if($this->IsNoEnoughPoints($R,$Rlevel) ||
	    $this->IsNoEnoughConds($R,$Rlevel))
		 header("Location: action.php?view=error");
	 $rn = $database->getUserField($session->uid,"researches",0);
	 $rn -= $this->GetResearchPoints($R,$Rlevel);
	 $database->updateUserField($session->uid,"researches",$rn,1);
	 $database->UpdateUserResearches($session->uid,$R,$this->userResearches[$R]+1);
	 if($R=="R2"){
	  $maxpop = $city->maxpop;
	  if($Rlevel == 8)
	   $maxpop += 20;
	  if($Rlevel == 14)
	   $maxpop += 200;
	  if($Rlevel > 14)
	   $maxpop  += 10;
	  $database->setCityField($city->cid,"maxpop",$maxpop);
	  if($Rlevel == 3){
	  	$database->setCityField($city->cid,"crystal",130);
		$database->setCityField($city->cid,"wine",130);
		$database->setCityField($city->cid,"marble",130);
		$database->setCityField($city->cid,"sulfur",130);
	  }
	  if($R=="R3"){
	   if($Rlevel == 6)
	  	$database->addExperiment($city->uid);
	  }
	 }
	 header("Location: action.php?view=researchAdvisor&oldView=city&id=".$city->cid);
	}
	public function GetResearchStatus($R){
	 return $this->userResearches["$R"];
	}
	public function GetHappinessByResearches(){
	 $h = 0;
	 if($this->GetResearchStatus("R2")>7)
	  $h += 20;
	 if($this->GetResearchStatus("R2")>13)
	  $h += 200;
	 if($this->GetResearchStatus("R2")>14)
	  $h += 10*($this->GetResearchStatus("R2")-14);
	 return $h;
	}
	public function getResearchesPerHour(){
	 global $database,$session,$city;
	 $p = 0;
	 if($this->userResearches["R3"] > 1)
	  $p += 2;
	 if($this->userResearches["R3"] > 4)
	  $p += 4;
	 if($this->userResearches["R3"] > 10)
	  $p += 8;
	 if($this->userResearches["R3"] > 15)
	  $p += 2*($this->userResearches["R3"]-15);
	 return $this->scientists + round($this->scientists*$p/100);
	}
	public function getAllResearchesPerHour(){
	 global $database,$session,$city;
	 $sc = $this->CountScientists();
	 $p = 0;
	 if($this->userResearches["R3"] > 1)
	  $p += 2;
	 if($this->userResearches["R3"] > 4)
	  $p += 4;
	 if($this->userResearches["R3"] > 10)
	  $p += 8;
	 if($this->userResearches["R3"] > 15)
	  $p += 2*($this->userResearches["R3"]-15);
	 return $sc + round($sc*$p/100);
	}
};


?>