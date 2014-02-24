<?php
if(!isset($_SESSION['sessid']))
	header("Location: ../index.php");

?>
<?php
if(!isset($_POST['actionRequest']) ||
   !isset($_POST['position']) ||
   ($_POST['actionRequest'] != $session->checker))
    header("Location: action.php?view=error");
$units->buildUnits($_POST);
?>