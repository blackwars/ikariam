<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : db.php                                   ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php 
include("Config.php");
class CDatabase {
	
	var $connection;
	public $db=SQL_DB;
	
	function CDatabase() {
		$this->connection = mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS) or die(mysql_error());
		mysql_select_db(SQL_DB, $this->connection);
	}
	
	function mysql_exec_batch ($p_query) {
    $p_query = 'START TRANSACTION;' . $p_query . '; COMMIT;';
  $query_split = preg_split ("/[;]+/", $p_query);
  foreach ($query_split as $query) {
    $query = trim($query);
    if ($query != '') {
      $query_result = mysql_query($query,$this->connection);
      if ($query_result == 0) {
        break;
      };
    };
  };
  return $query_result;
} 

	function query($query) {
		return mysql_query($query, $this->connection);
	}
};
$database = new CDatabase;
?>