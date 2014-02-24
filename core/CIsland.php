<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : CIsland.php                              ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php
class CIsland {
	public $maptype;
	public $specialRes;
	public $wid;
	public $x,$y;
	public $name;
	public $iid;
	public $woodlevel,$minelevel,$wonderlevel;
	public $wooddonations,$minedonations,$wonderdonations;
	public $CurrentIslandID;
	public $CurrentIslandName;
	public $CurrentIslandX;
	public $CurrentIslandY;

	function CIsland() {
		global $database,$city;
		if(!isset($_SESSION["iid"]))
		 $_SESSION["iid"] = $city->iid;
		if(isset($_GET['view'])&&($_GET['view']=="island")){
		 if(isset($_GET['id'])){
		  $_SESSION["iid"] = $_GET['id'];
		 }
		 else if(isset($_GET['cityId'])){
		  $iid = $database->getCityField($_GET['cityId'],"iid");
 		  $_SESSION["iid"] = $iid;
		 }
		}
		$this->iid = $_SESSION['iid'];
		$this->UpdateWoodMine($this->iid);
		$this->LoadIslandID($this->iid);
	}
	
	public function LoadIslandXY($x,$y){
	}
	
	public function LoadIslandID($id){
	 global $database;
	 $this->maptype = $database->getIslandField($id,"itype");
	 $this->specialRes = $database->getIslandField($id,"rtype");
	 $this->wid = $database->getIslandField($id,"wid");
	 $this->x = $database->getIslandField($id,"x");
	 $this->y = $database->getIslandField($id,"y");
	 $this->name = $database->getIslandField($id,"name");
	 $this->CurrentIslandID = $this->iid;
	 $this->CurrentIslandName = $this->name;
	 $this->CurrentIslandX = $this->x;
	 $this->CurrentIslandY = $this->y;
	 $this->woodlevel = $database->getIslandField($id,"woodlevel");
	 $this->minelevel = $database->getIslandField($id,"minelevel");
	 $this->wonderlevel = $database->getIslandField($id,"wonderlevel");
	 $this->wooddonations = $database->getIslandField($id,"wooddonations");
	 $this->minedonations = $database->getIslandField($id,"minedonations");
	 $this->wonderdonations = $database->getIslandField($id,"wonderdonations");
	 
	}
	public function IsCityOccupied($pos){
	 global $database;
	 $f = $database->getIslandField($this->iid,"p".$pos);
	 if($f&&($f!=-1))
	  return true;
	 else
	 	return false;
	}
	public function GetCityByPos($pos){
	 global $database;
	 return $database->getIslandField($this->iid,"p".$pos);
	}
	public function GetCityLevel($pos){
	 global $database;
	 $cid = $this->GetCityByPos($pos);
	 $level = $database->getBuildingsField($cid,"b0");
	 if($level<0)
	 {
	  $darray = $database->GetCityBuildingOp($cid);
	  $level=$darray["levelfrom"];
	 }
	 return $level;
	}
	public function IsMyCity($pos){
	 global $database,$session;
	 $cid = $this->GetCityByPos($pos);
	 if($database->getCityField($cid,"uid") == $session->uid)
	 	return true;
	 return false;
	}
	public function GetCityName($pos){
	 global $database;
	 $cid = $this->GetCityByPos($pos);
	 return $database->getCityField($cid,"name");
	}
	public function GetCityOwnerID($pos){
	 global $database;
	 $cid = $this->GetCityByPos($pos);
	 return $database->getCityField($cid,"uid");
	}
	public function GetCityOwnerName($pos){
	 global $database;
	 $cid = $this->GetCityByPos($pos);
	 $uid =  $database->getCityField($cid,"uid");
	 return $database->getUserField($uid,"username",0);
	}
	public function GetCityOwnerPoints($pos){
	 global $database;
	 $cid = $this->GetCityByPos($pos);
	 $uid =  $database->getCityField($cid,"uid");
	 return $database->getUserField($uid,"points",0);
	}
	public function GetCityOwnerAllyID($pos){
	 global $database;
	 $cid = $this->GetCityByPos($pos);
	 $uid =  $database->getCityField($cid,"uid");
	 return $database->getUserField($uid,"allyid",0);
	}
	public function GetCityOwnerDonation($pos,$donationtype){
	 global $database;
	 $cid = $this->GetCityByPos($pos);
	 return $database->getCityField($cid,$donationtype);
	}
	public function GetCityOwnerWorkers($pos,$workersfield){
	 global $database;
	 $cid = $this->GetCityByPos($pos);
	 return $database->getCityField($cid,$workersfield);
	}
	public function IsBarbarianAllowed($iid){
	 global $city;
	 if($city->capital)
	  if($iid==$city->iid)
	   return true;
	 return false;
	}
	public function Donate($field,$value){
	 global $database,$city;
	 $v =$value+$database->getIslandField($this->iid,$field);
	 $database->updateIslandField($this->iid,$field,$v);
	 $v =$database->getCityField($city->cid,"wood")-$value;
	 $database->setCityField($city->cid,"wood",$v);
	 $v =$database->getCityField($city->cid,$field)+$value;
	 $database->setCityField($city->cid,$field,$v);
	}
	public function GetIslandTGArType(){
	 switch($this->specialRes){
	  case "crystal":return "منجم بلور";
	  case "wine":return "حقول عنب";
	  case "marble":return "منجم رخام";
	  case "sulfur":return "حفرة كبريت";
	 }
	}
	private function UpdateWoodMine($id){
	 global $database,$city;
	 $woodlevel = $database->getIslandField($id,"woodlevel");
	 $minelevel = $database->getIslandField($id,"minelevel");
	 $wonderlevel = $database->getIslandField($id,"wonderlevel");
	 $wooddonations = $database->getIslandField($id,"wooddonations");
	 $minedonations = $database->getIslandField($id,"minedonations");
	 $wonderdonations = $database->getIslandField($id,"wonderdonations");
	 while(($woodlevel*1000) <= $wooddonations){
	  $wooddonations -= $woodlevel*1000;
	  $woodlevel++;
	  $database->updateIslandField($id,"woodlevel",$woodlevel);
	  $database->updateIslandField($id,"wooddonations",$wooddonations);
	  $city->IsAdvCitiesActive = true;
	 }
	 while(($minelevel*1000) <= $minedonations){
	  $minedonations -= $minelevel*1000;
	  $minelevel++;
	  $database->updateIslandField($id,"minelevel",$minelevel);
	  $database->updateIslandField($id,"minedonations",$minedonations);
	  $city->IsAdvCitiesActive = true;
	 }
	 while(($wonderlevel*1000) <= $wonderdonations){
	  $wonderdonations -= $wonderlevel*1000;
	  $wonderlevel++;
	  $database->updateIslandField($id,"wonderlevel",$wonderlevel);
	  $database->updateIslandField($id,"wonderdonations",$wonderdonations);
	  $city->IsAdvCitiesActive = true;
	 }
	}
	public function CalcDesIslandTime($iid1, $iid2){
	 global $database;
	 $x1 = $database->getIslandField($iid1,"x");
	 $y1 = $database->getIslandField($iid1,"y");
	 $x2 = $database->getIslandField($iid2,"x");
	 $y2 = $database->getIslandField($iid2,"y");
	 if(($x1==$x2) && ($y1==$y2))
	  return 600;
	 $x=abs($x1-$x2);
	 $y=abs($y1-$y2);
	 if($x>$y) return $x*28*60;
	 else return $y*28*60;
	}
	function getJSONIsland($x, $y){
	}
	function getJSONArea($data){
	 global $database;
	 $x_min = $data['islandX'] - 15;
	 if($x_min<=0)$x_min=1;
	 $x_max = $data['islandX'] + 13;
	 if($x_max>29)$x_max=29;
	 $y_min = $data['islandY'] - 15;
	 if($y_min<=0)$y_min=1;
	 $y_max = $data['islandY'] + 13;
	 if($y_max>=29)$y_max=29;
	 print('\'{"request":{"x_min":'.$x_min.',"x_max":'.$x_max.',"y_min":'.$y_min.',"y_max":'.$y_max.'},');
	 print('"data":{');
	 $xfirst = true;
	 for($x=$x_min; $x<=$x_max; $x++){
	  $islands = $database->GetIslandsXLine($x);
	  if(isset($islands[0]['id'])){
	   if(!$xfirst) print(',');
	   $xfirst = false;
	   print('"'.$x.'":{');
	   $yfirst = true;
	   for($y=$y_min; $y<=$y_max; $y++){
	    $island = $database->GetIslandArrayByPOS($x,$y);
	    if(isset($island['id'])){
		 if(!$yfirst) print(',');
		 $yfirst = false;
	     print('"'.$y.'":[');
		 print('"'.$island["id"].'",');
		 print('"'.$island["name"].'",');
		 switch($island["rtype"]){
		  case "wine":print('"1",');break;
		  case "marble":print('"2",');break;
		  case "crystal":print('"3",');break;
		  case "sulfur":print('"4",');break;
		 }
		 print('"'.$island["wid"].'",');
		 print('"132",');
		 print('"'.$island["itype"].'",');
		 print('"15",');
		 $cities = 0;
		 for($c=0;$c<16;$c++)
		  if($island["p".$c]) $cities++;
		 print('"'.$cities.'"]');
	    }
	   }
	   print('}');
	  }
	 }
	 print('}}\'');
	}
};
?>