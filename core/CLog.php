<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : CLog.php                                 ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php
class CLog {

	public $logs = array();
	public $IsAdvCitiesActive = false;
	
	function AddLoginLog($username,$ip,$time) {
	 global $database;
	 $q = "Insert into ".TB_PREFIX."login_log values (0,'$username','$ip','$time')";
	 $database->query($q);
    }
	function AddBuildingLog($uid, $cid, $building, $position, $levelto) {
	 global $database;
	 $uid = $uid;
	 $cname = $database->getCityField($cid,"name");
	 $ArName="";
	 switch($building){
	  case "townHall":$ArName="دار البلدية";break;
	  case "academy":$ArName="أكاديمية";break;
	  case "barracks":$ArName="ثكنة";break;
	  case "port":$ArName="مرفأ تجاري";break;
	  case "shipyard":$ArName="حوض بناء السفن";break;
	  case "wall":$ArName="سور المدينة";break;
	  case "warehouse":$ArName="منزل التحزين";break;
	  case "branchOffice":$ArName="متجر";break;
	  case "palace":$ArName="قصر";break;
	  case "tavern":$ArName="إستراحة";break;
	  case "safehouse":$ArName="مخبأ";break;
	  case "museum":$ArName="متحف";break;
	  case "vineyard":$ArName="عصارة العنب";break;
	  case "carpentering":$ArName="مبنى النجارة";break;
	  case "embassy":$ArName="سفارة";break;
	  case "optician":$ArName="صانع البصريات";break;
	  case "architect":$ArName="مكتب المهندس";break;
	  case "fireworker":$ArName="ساحة تجارب الألعاب النارية";break;
	  case "workshop":$ArName="مكان عمل المخترعين";break;
	  case "forester":$ArName="بيت الحطاب";break;
	  case "temple":$ArName="مركز";break;
	  case "alchemist":$ArName="برج الكيميائي";break;
	 }
	 $log = "<a title=\"اقفز الى المدينة".$cname."\" href=\"?view=city&id=".$cid."\">".$cname."</a></td>"
	  ."<td class=\"date\">".date("j.m.Y G:i")."</td>"
	  ."<td class=\"subject\">بنايتك <a href=\"?view=".$building."&id=".$cid."&position=".$position."\">"
	  .$ArName."</a> طُورت إلى المستوى ".$levelto;
	 $q = "Insert into ".TB_PREFIX."building_log values (0,'$uid','$log',1)";
	  $database->query($q);
    }
	function AddColonizationLog($darray) {
	 global $database;
	 $cname = $database->getCityField($darray["from_cid"],"name");
	 $log = "<a title=\"اقفز الى المدينة".$cname."\" href=\"?view=city&id=".$darray["from_cid"]."\">".$cname."</a></td>"."<td class=\"date\">".date("j.m.Y G:i")."</td>"
	  ."<td class=\"subject\"> لقد أنشأت مستعمرة جديدة <a href=\"?view=city&id=".$darray["to_cid"]."\"> محافضة </a>ونقلت إليها"
	  ."<ul class=\"resources\">";
	 if($darray["wood"]>0)
	  $log = $log."<li class=\"wood\"><span class=\"textLabel\">مادة صناعية: </span>".($darray["wood"]-750)."</li>";
	 if($darray["wine"]>0)
	  $log = $log."<li class=\"wine\"><span class=\"textLabel\">مشروب عنب: </span>".$darray["wine"]."</li>";
	 if($darray["marble"]>0)
	  $log = $log."<li class=\"marble\"><span class=\"textLabel\">رخام: </span>".$darray["marble"]."</li>";
	 if($darray["crystal"]>0)
	  $log = $log."<li class=\"crystal\"><span class=\"textLabel\">بلور: </span>".$darray["crystal"]."</li>";
	 if($darray["sulfur"]>0)
	  $log = $log."<li class=\"sulfur\"><span class=\"textLabel\">كبريت: </span>".$darray["sulfur"]."</li>";
	 $log = $log."</ul>";
	 $q = "Insert into ".TB_PREFIX."building_log values (0,'".$darray["uid"]."','$log',1)";
	  $database->query($q);
    }
	public function loadAvatarLogs($uid){
	  global $database;
	  $query = "SELECT * FROM ".TB_PREFIX."building_log WHERE uid = $uid ORDER BY id DESC";
	  $this->logs = $database->query_return($query);
	  $c = count($this->logs);
	  if($c>29)
	   for($i=0; $i<$c-29;$i++){
	    $q = "DELETE FROM ".TB_PREFIX."building_log WHERE id = ".$this->logs[$i];
	    $database->query($q);
	   }
	  $this->logs = $database->query_return($query);
	  if(count($this->logs))
	   if($this->logs[0]["isNew"] == "1")
	     $this->IsAdvCitiesActive = true;
	}
	public function getAvatarLogCount(){
	 return count($this->logs);
	}
	public function getAvatarLog($offset){
	 global $database;
	 $c = count($this->logs);
	 $logClass = "alt";
	 for($i=$offset; ($i<$offset+10)&&($i<$c); $i++){
	  echo "<tr class=\"".$logClass."\"><td class=\"";
	  if($this->logs[$i]["isNew"]) echo "wichtig";
	  else echo "empty";
	  echo "\"></td><td class=\"city\"></td></td><td style=\"white-space:nowrap;\">";
	  echo $this->logs[$i]["log"];
	  echo "</td><td class=\"empty\"></td></tr>";
	  $q = "UPDATE ".TB_PREFIX."building_log SET isNew=0 WHERE id = ".$this->logs[$i]["id"];
	  $database->query($q);
	  if($logClass=="alt")$logClass="";
	  else $logClass="alt";
	 }
	 if(!$offset)
	  echo "<tr class=\"pgnt\"><td class=\"empty\"></td><td></td><td></td><td colspan=\"i\" class=\"paginator\"><div class=\"text\" title=\"تقارير 1-10\">".($offset+1)."-".($offset+10)."</div><div class=\"next\"><a href=\"?view=tradeAdvisor&offset=".($offset+10)."\" title=\"العشرة التالية...\"><img src=\"img/resource/btn_max.gif\"/></a></div></td><td></td><td class=\"empty\"></td></tr>";
	 if(($i+$offset)<$c)
	  echo "";
	}
};
$log = new CLog;
?>