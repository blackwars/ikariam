<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : CTransport.php                           ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php
class CTransport {
	private $transportArray = array();
	private $transportsCount = 0;
	
	function CTransport(){
	 global $database,$session;
	 $this->transportArray = $database->getTransportArray($session->uid);
	 $this->transportsCount = count($this->transportArray);
	 $this->UpdateTransports();
	}
	private function UpdateTransports(){
	 global $database,$session,$log;
	 $time = time();
	 for($i=0; $i<$this->transportsCount; $i++){
	  $trans = $this->transportArray[$i];
	  if($trans["endTime"] <= $time){
	   $cid = $trans["to_cid"];
	   if($trans["type"]=="colonization"){
		$pop = $database->getCityField($cid,"pop");
	    $database->modifyResource($cid,$trans["wood"]-1250,$trans["crystal"],$trans["marble"],$trans["wine"],$trans["sulfur"],$pop,1);
		$database->setBuildingsField($cid,"b0",1);
		$log->AddColonizationLog($trans);
	   }
	   $database->deleteTransport($trans["id"]);
	  }
	 }
	 $this->transportArray = $database->getTransportArray($session->uid);
	 $this->transportsCount = count($this->transportArray);
	}
	public function startColonization($post) {
	 global $database,$session,$city;
	 if(!isset($post['id'])||!isset($post['cargo_people'])||!isset($post['cargo_gold'])||!isset($post['desiredPosition'])||!isset($post['cargo_resource'])||!isset($post['journeyTime'])||!isset($post['actionRequest'])||($post['actionRequest'] != $session->checker))
	  header("Location: action.php?view=error");
	 if($database->getIslandField($post['id'],"p".$post['desiredPosition']))
	  header("Location: action.php?view=error");
	 $uid = $session->uid;
	 $to_iid = $post['id'];
	 $cargo_people = $post['cargo_people'];
	 $cargo_gold = $post['cargo_gold'];
	 $to_pos = $post['desiredPosition'];
	 $cargo_resource = $post['cargo_resource'];
	 if(isset($post['cargo_tradegood1']))
	  $cargo_tradegood1 = $post['cargo_tradegood1'];
	 else $cargo_tradegood1 =0;
	 if(isset($post['cargo_tradegood2']))
	  $cargo_tradegood2 = $post['cargo_tradegood2'];
	 else $cargo_tradegood2 =0;
	 if(isset($post['cargo_tradegood3']))
	  $cargo_tradegood3 = $post['cargo_tradegood3'];
	 else $cargo_tradegood3 =0;
	 if(isset($post['cargo_tradegood4']))
	  $cargo_tradegood4 = $post['cargo_tradegood4'];
	 else $cargo_tradegood4 =0;
	 $transporters = $post['transporters'];
	 $journeyTime = $post['journeyTime'];
	 $from_cid = $post['from_cid'];
	 $loadingEndTime = $cargo_resource+$cargo_tradegood1+$cargo_tradegood2+$cargo_tradegood3+$cargo_tradegood4+40;
	 $loadingEndTime /= $post['LoadSpeed'];
	 $loadingEndTime *= 60;
	 $t = time();
	 $endTime = $t + $post['journeyTime'] + $loadingEndTime;
	 $loadingEndTime += $t;
//$sendresource//$sendwine//$sendmarble//$sendcrystal//$sendsulfur//transporters
     $cid = $database->addCity($to_iid,$uid,$to_pos,0);
     $query = "INSERT INTO ".TB_PREFIX."movement(uid,from_cid,to_cid,to_iid,to_pos,ships,wood,wine,marble,crystal,sulfur,type,journeyTime,loadingEndTime,endTime) VALUES ('$uid','$from_cid','$cid','$to_iid','$to_pos','$transporters','$cargo_resource','$cargo_tradegood1','$cargo_tradegood2','$cargo_tradegood3','$cargo_tradegood4','colonization','$journeyTime','$loadingEndTime','$endTime')";echo $query;
	 $database->query($query);
	 $database->setBuildingsField($cid,"b0",0);
	 $database->modifyGold($city->uid,$city->gold-9000,0);
	 $database->modifyResource($from_cid,$cargo_resource,$cargo_tradegood3,$cargo_tradegood2,$cargo_tradegood1,$cargo_tradegood4,$city->pop-40,0);
	 header("Location: action.php?view=island&id=".$post['id']);
    }
	public function getTransportsCount(){
	 return $this->transportsCount;
	}
	public function getTransportInfo($i, $info){
	 global $database,$session;
	 switch($info){
	  case "from_cname":
	   return $database->getCityField($this->transportArray[$i]["from_cid"],"name");
	  case "from_uname":
	   return $database->getUserField($this->transportArray[$i]["from_cid"],"username",0);
	  case "to_cname":
	   if(($this->getTransType($i) == "colonization"))
	    return "محافضة";
	   else
	    return $database->getCityField($this->transportArray[$i]["to_cid"],"name");
	  case "to_uname":
	   if(($this->getTransType($i) == "colonization"))
	    return $session->username;
	   else
	    return $database->getUserField($this->transportArray[$i]["to_cid"],"username",0);
	  }
	 return $this->transportArray[$i][$info];
	}
	public function getTransportInfo2($i, $id){
	 $info = $this->index2name($id);
	 return $this->transportArray[$i][$info];
	}
	private function index2name($index){
	 switch($index){
	  case "7":return "wood";
	  case "10":return "crystal";
	  case "8":return "wine";
	  case "9":return "marble";
	  case "11":return "sulfur";
	 }
	}
	public function getUnitArName($u){
	 $name = $this->index2name($u);
	 switch($name){
	  case "wood":return "مواد البناء";
	  case "crystal":return "زجاج بلوري";
	  case "wine":return "مشروب عنب";
	  case "marble":return "رخام";
	  case "sulfur":return "كبريت";
	 }
	}
	public function getUnitImgPath($u){
	 $name = $this->index2name($u);
	 switch($name){
	  case "wood":case "crystal":case "wine":case "marble":
	  case "sulfur":return "img/resource/icon_".$name.".gif";
	 }
	}
	public function getTransType($i){
	 return $this->transportArray[$i]['type'];
	}
	public function getTransTypeArName($i){
	 switch($this->getTransType($i)){
	  case "colonization":
	   return "إستعمار";
	 }
	}
	public function getTransStatusArName($i){
	 if($this->getTransportInfo($i, "loadingEndTime")>time())
	  return "يتم التحميل";
	 else
	  return "في رحلة";
	}
	public function getTransImgLink($i){
	 switch($this->getTransType($i)){
	  case "colonization":
	  case "transport":
	   return "img/interface/mission_transport.gif";
	 }
	}
	public function getTransAction($i){
	 if(!$this->getTransportInfo($i, "go_back"))
	  return "";
	 global $session;
	 $ret = "<a href=\"?action=transportOperations&function=abortFleetOperation&eventId=".$this->getTransportInfo($i, "id")."&oldView=militaryAdvisorMilitaryMovements.\"><img title=\"سحب!\" src=\"img/interface/btn_abort.gif\"/></a>";
     return $ret;
	}
	public function abortFleetOperation($get){
	 global $database,$city,$session;
	 if(!isset($get['eventId']))
	  header("Location: action.php?view=error");
	 $darray = $database->getTransportRow($get['eventId']);
	 if($darray["type"] =="colonization"){
	  $database->deleteCity($darray["to_cid"]);
	  $database->modifyGold($city->uid,$city->gold+9000,0);
	  $cargo_resource = $darray['wood'];
	 if(isset($darray['wine']))
	  $cargo_tradegood1 = $darray['wine'];
	 else $cargo_tradegood1 =0;
	 if(isset($darray['marble']))
	  $cargo_tradegood2 = $darray['marble'];
	 else $cargo_tradegood2 =0;
	 if(isset($darray['crystal']))
	  $cargo_tradegood3 = $darray['crystal'];
	 else $cargo_tradegood3 =0;
	 if(isset($darray['sulfur']))
	  $cargo_tradegood4 = $darray['sulfur'];
	 else $cargo_tradegood4 =0;
	  $database->modifyResource($darray["from_cid"],$cargo_resource,$cargo_tradegood3,$cargo_tradegood2,$cargo_tradegood1,$cargo_tradegood4,$city->pop+40,1);
	 }
	 $database->deleteTransport($get['eventId']);
	 header("Location: action.php?view=militaryAdvisorMilitaryMovements&oldView=city&id=".$city->cid);
	}
};
?>