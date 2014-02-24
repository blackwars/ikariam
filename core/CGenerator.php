<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : CGenerator.php                           ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php

class CGenerator {
	
	public function generateRandID(){
		return md5($this->generateRandStr(16));
		}

   public function generateRandStr($length){
      $randstr = "";
      for($i=0; $i<$length; $i++){
         $randnum = mt_rand(0,61);
         if($randnum < 10){
            $randstr .= chr($randnum+48);
         }else if($randnum < 36){
            $randstr .= chr($randnum+55);
         }else{
            $randstr .= chr($randnum+61);
         }
      }
      return $randstr;
   }
   
   public function encodeStr($str,$length) {
	   $encode = md5($str);
	   return substr($encode,0,$length);
   }
   
   public function getTimeFormat($time) {
	   /*if ($time%10 < 5) {
			$time = $time-($time%10);
		}
		else {
			$time = $time + (10 - $time%10);
		}*/
	   $min = 0;
	   $hr = 0;
	   $days = 0;
	   $counter = 0;
	   while($time >= 60) :
		   $time -= 60;
		   $min += 1;
	   endwhile;
	   while ($min > 60) :
		   $min -= 60;
		   $hr += 1;
	   endwhile;
	   while ($hr > 24) :
		   $hr -= 24;
		   $days += 1;
	   endwhile;
	   $str = "";
	   $result = array();
	   $result["d"] = $days;
	   $result["h"] = $hr;
	   $result["m"] = $min;
	   $result["s"] = $time;
	   return $result;
   }

	public function procMtime($time) {
		if ((time()-$time) < 24*60*60) {
			$day = "today";
		}
		elseif (time()-$time > 24*60*60 && time()-$time < 2*24*60*60) {
			$day = "yesterday";		
		}		
		else {
			$pref = 3;
			switch($pref) {
			case 1:
			$day = date("m/j/y",$time);
			break;
			case 2:
			$day = date("j/m/y",$time);
			break;
			case 3:
			$day = date("j.m.y",$time);
			break;
			default:
			$day = date("y/m/j",$time);
			break;
			}
		}
		$new = date("H:i",$time);
		return array($day,$new);
	}
   
   
	public function pageLoadTimeStart() {
		$starttime = microtime();
		$startarray = explode(" ", $starttime);
		//$starttime = $startarray[1] + $startarray[0];
		return $startarray[0];
	}

	public function pageLoadTimeEnd() {
		$endtime = microtime();
		$endarray = explode(" ", $endtime);
		//$endtime = $endarray[1] + $endarray[0];
		return $endarray[0];
	}
	
};
$generator = new CGenerator;
?>