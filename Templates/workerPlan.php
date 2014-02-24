<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");

?>
<?php 
if($_POST['view'] == "resource"){
 if($_POST['type'] == "resource"){
  $city->SetWorkers("woodworkers",$_POST['rw']);
  header("Location: action.php?view=island&id=".$_POST['id']);
 }
}else if($_POST['view'] == "academy"){
 $city->SetScientists($_POST);
 header("Location: action.php?view=academy&position=".$_POST['position']."&id=".$city->cid);
}else if($_POST['type'] == "tradegood"){
  $city->SetWorkers("specialworkers",$_POST['rw']);
  header("Location: action.php?view=island&id=".$_POST['id']);
}
?>