<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : CMySql.php                               ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php
class CMySql {
 var $connection;
 
 function CMySql() {
  	$this->connection = mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS) or die(mysql_error());
  	mysql_select_db(SQL_DB, $this->connection) or die(mysql_error());
 }
 
 function register($username,$password,$email,$act) {
	$q = "INSERT INTO ".TB_PREFIX."users (username,password,email,access,act) VALUES ('$username', '$password', '$email', ".USER.",'$act')";
	if(mysql_query($q,$this->connection))
		$uid = mysql_insert_id($this->connection);
	else
		$uid = 0;
	$q = "INSERT INTO ".TB_PREFIX."reasearches (uid,R1,R2,R3,R4) VALUES ('$uid', '0', '0', '0')";
	mysql_query($q,$this->connection);
	$q = "INSERT INTO ".TB_PREFIX."barbarian VALUES (0,'$uid',1,1,0)";
	mysql_query($q,$this->connection);
	return $uid;
 }
 
 function unreg($username) {
	$q = "DELETE from ".TB_PREFIX."users where username = '$username'";
	return mysql_query($q,$this->connection);
 }	
 function checkExist($ref,$mode) {
	if(!$mode)
		$q = "SELECT username FROM ".TB_PREFIX."users where username = '$ref' LIMIT 1";
	else
		$q = "SELECT email FROM ".TB_PREFIX."users where email = '$ref' LIMIT 1";
	$result = mysql_query($q, $this->connection);
	if(mysql_num_rows($result))
		return true;
	else
		return false;
 }
 
 function updateUserField($ref,$field,$value,$switch) {
	if(!$switch)
		$q = "UPDATE ".TB_PREFIX."users set $field = '$value' where username = '$ref'";
	else
		$q = "UPDATE ".TB_PREFIX."users set $field = '$value' where id = '$ref'";
	return mysql_query($q, $this->connection);
 }
 function getUserField($ref,$field,$mode) {
	if(!$mode)
		$q = "SELECT $field FROM ".TB_PREFIX."users where id = $ref";
	else
		$q = "SELECT $field FROM ".TB_PREFIX."users where username = '$ref'";
	$result = mysql_query($q, $this->connection);
	$dbarray = mysql_fetch_array($result);
	return $dbarray[$field];
 }
 function login($username,$password) {
	$q = "SELECT password,sessid FROM ".TB_PREFIX."users where username = '$username'";
	$result = mysql_query($q, $this->connection);
	$dbarray = mysql_fetch_array($result);
	if($dbarray['password'] == md5($password))
		return true;
	else
		return false;
 }
 
 function getUserArray($ref,$mode) {
	if(!$mode)
		$q = "SELECT * FROM ".TB_PREFIX."users where username = '$ref'";
	else
		$q = "SELECT * FROM ".TB_PREFIX."users where id = $ref";
	$result = mysql_query($q, $this->connection);
	return mysql_fetch_array($result);
 }
 
 function activeModify($username,$mode) {
	$time = time();
	if(!$mode)
		$q = "INSERT into ".TB_PREFIX."active VALUES ('$username',$time)";
	else
		$q = "DELETE FROM ".TB_PREFIX."active where username = '$username'";
	return mysql_query($q, $this->connection);
 }
 function addActiveUser($username,$time) {
	$q = "REPLACE into ".TB_PREFIX."active values ('$username',$time)";
	if(mysql_query($q, $this->connection))
		return true;
	else
		return false;
 }
 function updateActiveUser($username,$time) {
		$q = "UPDATE ".TB_PREFIX."users set timestamp = $time where username = '$username'";
		$exec1 = mysql_query($q, $this->connection);
		$q = "REPLACE into ".TB_PREFIX."active values ('$username',$time)";
		$exec2 = mysql_query($q, $this->connection);
		if($exec1 && $exec2)
			return true;
		else
			return false;

	}
 function checkactiveSession($username,$sessid) {
	$q = "SELECT username FROM ".TB_PREFIX."users where username = '$username' and sessid = '$sessid' LIMIT 1";
	$result = mysql_query($q, $this->connection);
	if(mysql_num_rows($result) != 0) 
		return true;
	else
		return false;
 }
 
 function modifyGold($id,$amt,$mode) {
		if(!$mode) {
			$q = "UPDATE ".TB_PREFIX."USERS set gold = $amt where id = $id";
		}
		else {
			$q = "UPDATE ".TB_PREFIX."USERS set gold = gold + $amt where id = $id";
		}
		return mysql_query($q,$this->connection);
 }
 
 function getBarbarianRow($uid){
  $q = "Select * from ".TB_PREFIX."barbarian where uid = '$uid'";
  $result = mysql_query($q, $this->connection);
  return mysql_fetch_array($result);
 }
 
 function generateIsland() {
		$q = "Select * from ".TB_PREFIX."wdata where isoccupied = 0";
		$result = mysql_query($q, $this->connection);
		$num_rows = mysql_num_rows($result);
		$result = $this->mysql_fetch_all($result);
		$island = rand(0, ($num_rows-1));
		return $result[$island]['id'];
	}
 function getIslandArray($iid) {
	$q = "SELECT * FROM ".TB_PREFIX."wdata where id = '$iid'";
	$result = mysql_query($q, $this->connection);
	return mysql_fetch_array($result);
 }
 function GetIslandArrayByPOS($x,$y){
  $q = "SELECT * FROM ".TB_PREFIX."wdata where x = '$x' AND  y = '$y'";
  $result = mysql_query($q, $this->connection);
  return mysql_fetch_array($result);
 }
 function GetIslandsXLine($x){
  $q = "SELECT id FROM ".TB_PREFIX."wdata where x = '$x'";
  $result = mysql_query($q, $this->connection);
  return mysql_fetch_array($result);
 }
 function getIslandField($iid,$field) {
		$q = "SELECT $field FROM ".TB_PREFIX."wdata where id = $iid";
		$result = mysql_query($q, $this->connection);
		$dbarray = mysql_fetch_array($result);
		return $dbarray[$field];
 }
 function updateIslandField($iid,$field,$value) {
	$q = "UPDATE ".TB_PREFIX."wdata set $field = '$value' where id = '$iid'";
	return mysql_query($q, $this->connection);
 }
 function generateCityPos($iid){
 	$result = $this->getIslandArray($iid);
	$array = array();
	$o;
	for($i=1;$i<=15;$i++)
		if($result[6+$i] == 0)
			array_push($array,$i);
	$pos = rand(0, count($array)-1);
	return $array[$pos];
 }
 function addCity($iid,$uid,$pos,$capital) {
	$name = "محافظة";
	$time = time();
	$q = "INSERT into ".TB_PREFIX."cdata(iid,uid,name,position,capital,pop,maxpop,wood,crystal,marble,sulfur,wine,maxstore,lastupdate) values ($iid, $uid, '$name', $pos, $capital, 40, 60, 500, 0, 0, 0, 0, 1500, $time)";
	mysql_query($q, $this->connection);
	$q = "SELECT MAX(id) FROM ".TB_PREFIX."cdata";
	$result = mysql_query($q, $this->connection);
	$result = mysql_fetch_row($result);
	$cid = $result[0];
	$this->updateIslandField($iid,"p".$pos,$cid);
	$IslandOccupiedPlaces = 0;
	$result = $this->getIslandArray($iid);
	for($i=1;$i<=15;$i++)
		if($result[6+$i] == 1)
			$IslandOccupiedPlaces++;
	if($IslandOccupiedPlaces == 15)
		$this->updateIslandField($iid,"isoccupied",1);
	/////////////
	$q = "INSERT into ".TB_PREFIX."buildingsdata(cid) values ($cid)";
	mysql_query($q, $this->connection);
	$q = "INSERT into ".TB_PREFIX."units (cid) values ($cid)";
	mysql_query($q, $this->connection);
	$q = "INSERT into ".TB_PREFIX."ships (cid) values ($cid)";
	mysql_query($q, $this->connection);
	$q = "INSERT into ".TB_PREFIX."spies (cid) values ($cid)";
	mysql_query($q, $this->connection);
	return $cid;
 }
 function deleteCity($cid){
    $q = "DELETE FROM ".TB_PREFIX."buildingsdata WHERE cid = $cid";
	mysql_query($q, $this->connection);
	$q = "DELETE FROM ".TB_PREFIX."units WHERE cid = $cid";
	mysql_query($q, $this->connection);
	$q = "DELETE FROM ".TB_PREFIX."ships WHERE cid = $cid";
	mysql_query($q, $this->connection);
	$iid = $this->getCityField($cid,"iid");
	$pos = $this->getCityField($cid,"position");
	$this->updateIslandField($iid,"p".$pos,"0");
	$q = "DELETE FROM ".TB_PREFIX."cdata WHERE id = $cid";
	mysql_query($q, $this->connection);
 }
 function getCitiesID($uid) {
		$q = "SELECT id from ".TB_PREFIX."cdata where uid = $uid order by capital DESC";
		$result = mysql_query($q, $this->connection);
		$array = $this->mysql_fetch_all($result);
		$newarray = array();
		for($i=0;$i<count($array);$i++) {
			array_push($newarray,$array[$i]['id']);
		}
		return $newarray;
 }
 
 function getCityField($id,$field) {
		$q = "SELECT $field FROM ".TB_PREFIX."cdata where id = $id";
		$result = mysql_query($q, $this->connection);
		$dbarray = mysql_fetch_array($result);
		return $dbarray[$field];
 }
 function setCityField($id,$field,$value) {
		$q = "UPDATE ".TB_PREFIX."cdata set $field = '$value' where id = $id";
		return mysql_query($q,$this->connection);
 }
 function getCity($cid) {
		$q = "SELECT * FROM ".TB_PREFIX."cdata where id = $cid";
		$result = mysql_query($q, $this->connection);
		return mysql_fetch_array($result);
 }
 function modifyResource($cid,$wood,$crystal,$marble,$wine,$sulfur,$pop,$mode) {
		if(!$mode) {
			$q = "UPDATE ".TB_PREFIX."cdata set wood = wood - $wood, crystal = crystal - $crystal, marble = marble - $marble, wine = wine - $wine, sulfur = sulfur - $sulfur, pop = $pop where id = $cid";
		}
		else {
			$q = "UPDATE ".TB_PREFIX."cdata set wood = wood + $wood, crystal = crystal + $crystal, marble = marble + $marble, wine = wine + $wine, sulfur = sulfur + $sulfur, pop = $pop where id = $cid";
		}
		return mysql_query($q, $this->connection);
	}
 function updateCity($cid) {
		$time = time();
		$q = "UPDATE ".TB_PREFIX."cdata set lastupdate = $time where id = $cid";
		return mysql_query($q, $this->connection);
	}
 function getBuildingsLevels($cid){
 	$q = "SELECT * FROM ".TB_PREFIX."buildingsdata where cid = $cid";
		$result = mysql_query($q, $this->connection);
		return mysql_fetch_array($result);
 }
 function getBuildingsField($cid,$field){
 	$q = "SELECT $field FROM ".TB_PREFIX."buildingsdata where cid = $cid";
		$result = mysql_query($q, $this->connection);
		$dbarray = mysql_fetch_array($result);
		return $dbarray[$field];
 }
  function setBuildingsField($cid,$field,$value){
		$q = "UPDATE ".TB_PREFIX."buildingsdata set $field = $value where cid = $cid";
		return mysql_query($q, $this->connection);
 }
 function addBuilding($cid,$pos,$type,$levelfrom,$levelto,$stime,$time) {
		$q = "INSERT into ".TB_PREFIX."bdata values (0,$cid,$pos,$type,$levelfrom,$levelto,$stime,$time)";
		return mysql_query($q,$this->connection);
	}
 function removeBuilding($id) {
		$q = "DELETE FROM ".TB_PREFIX."bdata where id = $id";
		return mysql_query($q,$this->connection);
	}
 function GetCityBuildingOp($cid){
 	$q = "SELECT * FROM ".TB_PREFIX."bdata where cid = $cid";
	$result = mysql_query($q, $this->connection);
	return mysql_fetch_array($result);
 }
 function GetUserResearches($uid){
  $q = "SELECT * FROM ".TB_PREFIX."researches where uid = $uid";
  $result = mysql_query($q, $this->connection);
  return mysql_fetch_array($result);
 }
 function UpdateUserResearches($uid,$R,$level){
  $q = "UPDATE ".TB_PREFIX."researches set $R = '$level' where uid = '$uid'";echo $q;
  return mysql_query($q, $this->connection);
 }
 function updateUnits($cid,$unit,$n)  {
		$q = "UPDATE ".TB_PREFIX."units set $unit = $unit + '$n' where cid = $cid";
		return mysql_query($q,$this->connection);
 }
 function addUnitsBuilding($cid,$u301,$u302,$u303,$u304,$u305,$u306,$u307,$u308,$u309,$u310,$u311,$u312,$u313,$u314,$u315,$stime,$time)  {
		$q = "INSERT into ".TB_PREFIX."bunits values (0,$cid,$u301,$u302,$u303,$u304,$u305,$u306,$u307,$u308,$u309,$u310,$u311,$u312,$u313,$u314,$u315,$stime,$time)";
		return mysql_query($q,$this->connection);
 }
 function getUnitsBList($cid){
  $q = "SELECT * FROM ".TB_PREFIX."bunits where cid = $cid ORDER BY id";
  $result = mysql_query($q, $this->connection);
  return $this->mysql_fetch_all($result);
 }
 function getUnitsBList2($id){
  $q = "SELECT * FROM ".TB_PREFIX."bunits where id = $id";
  $result = mysql_query($q, $this->connection);
  return mysql_fetch_array($result);
 }
 function removeUnitsBuilding($id) {
		$q = "DELETE FROM ".TB_PREFIX."bunits where id = $id";
		return mysql_query($q,$this->connection);
 }
 function getUnits($cid){
  $q = "SELECT * FROM ".TB_PREFIX."units where cid = $cid";
  $result = mysql_query($q, $this->connection);
  return mysql_fetch_array($result);
 }
 ///ships
 function updateShips($cid,$ship,$n)  {
		$q = "UPDATE ".TB_PREFIX."ships set $ship = $ship + '$n' where cid = $cid";
		return mysql_query($q,$this->connection);
 }
 function addShipsBuilding($cid,$s210,$s211,$s212,$s213,$s214,$s215,$s216,$stime,$time)  {
		$q = "INSERT into ".TB_PREFIX."bships values (0,$cid,$s210,$s211,$s212,$s213,$s214,$s215,$s216,$stime,$time)";
		return mysql_query($q,$this->connection);
 }
 function getShipsBList($cid){
  $q = "SELECT * FROM ".TB_PREFIX."bships where cid = $cid";
  $result = mysql_query($q, $this->connection);
  return $this->mysql_fetch_all($result);
 }
 function getShipsBList2($id){
  $q = "SELECT * FROM ".TB_PREFIX."bships where id = $id";
  $result = mysql_query($q, $this->connection);
  return mysql_fetch_array($result);
 }
 function removeShipsBuilding($id) {
		$q = "DELETE FROM ".TB_PREFIX."bships where id = $id";
		return mysql_query($q,$this->connection);
 }
 function getShips($cid){
  $q = "SELECT * FROM ".TB_PREFIX."ships where cid = $cid";
  $result = mysql_query($q, $this->connection);
  return mysql_fetch_array($result);
 }
 function getTransportArray($uid){
  $q = "SELECT * FROM ".TB_PREFIX."movement where uid = $uid ORDER BY endTime DESC";
  $result = mysql_query($q, $this->connection);
  return $this->mysql_fetch_all($result);
 }
 function getTransportRow($id){
  $q = "SELECT * FROM ".TB_PREFIX."movement where id = $id";
  $result = mysql_query($q, $this->connection);
  return mysql_fetch_array($result);
 }
 function deleteTransport($id){
  $q = "DELETE FROM ".TB_PREFIX."movement where id = $id";
  mysql_query($q, $this->connection);
 }
 function addExperiment($uid) {
		$q = "INSERT into ".TB_PREFIX."experiments(uid,timestamp) values ($uid,0)";
		return mysql_query($q,$this->connection);
 }
 function getExperimentField($uid,$field)  {
  $q = "SELECT * FROM ".TB_PREFIX."experiments where uid = $uid";
  $result = mysql_query($q, $this->connection);
  $dbarray = mysql_fetch_array($result);
  return $dbarray[$field];
 }
 function setExperimentField($uid,$field,$value)  {
		$q = "UPDATE ".TB_PREFIX."experiments set $field = $value where uid = $uid";
		return mysql_query($q,$this->connection);
 }
/////////////////////////////
	function mysql_fetch_all($result) {
		$all = array();
		if($result) {
		while ($row = mysql_fetch_assoc($result)){ $all[] = $row; }
		return $all;
		}
	}
	function query_return($q) {
		$result = mysql_query($q, $this->connection);
		return $this->mysql_fetch_all($result);
	}
	function query($query) {
		return mysql_query($query, $this->connection);
	}
};
$database = new CMySql;
?>