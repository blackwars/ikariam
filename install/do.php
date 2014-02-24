<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : do.php                                   ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php
if(file_exists("inc/Config.php")) {
	include("inc/db.php");
}
class Action {
			
	function Action() {
		if(isset($_POST['config'])) {
				$this->constForm();
		}
		else if(isset($_POST['createdb'])) {
				$this->createDB();
		}
		else{
          header("Location: index.php");
       }
	}

	function constForm() {
		$myFile = "inc/Config.php";
		$fh = fopen($myFile, 'w') or die("can't open file");
		$text = file_get_contents("config.dat");
		$text = preg_replace("'%SSERVER%'",$_POST['sserver'],$text);
		$text = preg_replace("'%SUSER%'",$_POST['suser'],$text);
		$text = preg_replace("'%SPASS%'",$_POST['spass'],$text);
		$text = preg_replace("'%SDB%'",$_POST['sdb'],$text);
		$text = preg_replace("'%PREFIX%'",$_POST['prefix'],$text);																		
		fwrite($fh, $text);
		if(file_exists("inc/Config.php"))
		 header("Location: index.php?o=2");
		else
		 header("Location: index.php?o=1&e=1");
		fclose($fh);
	}
	
	function createDB() {
		global $database;
		$str = file_get_contents("request.sql");
		$str = preg_replace("'%PREFIX%'",TB_PREFIX,$str);
		$database = new CDatabase;
		$result = $database->mysql_exec_batch($str);
		if($result) {
			header("Location: index.php?o=3");
		}
		else {
			header("Location: index.php?o=2&e=1&db=".$database->db);
		}
	}
	
};

$action = new Action;
?>