<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : CAccount.php                             ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php
include("CSession.php");

class CAccount {

	function CAccount() {
		global $session;
		if(isset($_POST['ft'])) {
			switch($_POST['ft']) {
				case "a1":
				$this->Signup();
				break;
				case "a2":
				$this->Activate();
				break;
				case "a3":
				$this->Unreg();
				break;
				case "a4":
				$this->Login();
				break;
			}
		}
		else {
			if($session->logged_in) {
				if(isset($_GET['action'])){
				 switch($_GET['function']){
				  case "logout":$this->Logout();break;
				  default:break;
				 }
				}
			}
		}
	}
	
	private function Signup() {
		global $database,$form,$mailer,$generator,$session;
		if(!isset($_POST['name']) || $_POST['name'] == "") {
			$form->addError("name","USRNM_EMPTY");
		}
		else {
			if(strlen($_POST['name']) < USRNM_MIN_LENGTH) {
				$form->addError("name","USRNM_SHORT");
			}
			else if(!USRNM_SPECIAL && preg_match('/[^0-9A-Za-z]/',$_POST['name'])) {
				$form->addError("name","USRNM_CHAR");
			}
			else if($database->checkExist($_POST['name'],0)) {
				$form->addError("name","USRNM_TAKEN");
			}
		}
		if(!isset($_POST['pw']) || $_POST['pw'] == "") {
			$form->addError("pw",PW_EMPTY);
		}
		else {
			if(strlen($_POST['pw']) < PW_MIN_LENGTH) {
				$form->addError("pw","PW_SHORT");
			}
			else if($_POST['pw'] == $_POST['name']) {
				$form->addError("pw","PW_INSECURE");
			}
		}
		if(!isset($_POST['email'])) {
			$form->addError("email","EMAIL_EMPTY");
		}
		else {
			if(!$this->validEmail($_POST['email'])) {
				$form->addError("email","EMAIL_INVALID");
			}
			else if($database->checkExist($_POST['email'],1)) {
				$form->addError("email","EMAIL_TAKEN");
			}
		}
		if(!isset($_POST['agb'])) {
			$form->addError("agree","AGREE_ERROR");
		}
		if($form->returnErrors() > 0) {
			$_SESSION['errorarray'] = $form->getErrors();
			$_SESSION['valuearray'] = $_POST;
			
			header("Location: register.php");
		}
		else {
			$act = $generator->generateRandStr(10);
			$uid = $database->register($_POST['name'],md5($_POST['pw']),$_POST['email'],$act);
			if($uid) {
				setcookie("COOKUSR",$_POST['name'],time()+COOKIE_EXPIRE,COOKIE_PATH);
				setcookie("COOKEMAIL",$_POST['email'],time()+COOKIE_EXPIRE,COOKIE_PATH);
				//$mailer->sendActivate($_POST['email'],$_POST['name'],$_POST['pw'],$act);
				$this->generateCity($uid);
				header("Location: index.php");
				//$session->cities = $database->getCitiesID($uid);
			    //$session->login($_POST['name']);
				//header("Location: action.php?action=loginAvatar&function=login");
			}
		}
	}
	
	private function Activate() {
		global $database;
		$actcode = $database->getUserField($_GET['un'],"act",1);
		if($actcode == $_GET['act']) {
			$uid = $database->getUserField($_GET['un'],"id",1);
			$database->updateUserField($uid,"act","",1);
			unset($_COOKIE['COOKEMAIL']);
			header("Location: activate.php?e=2");
		}
		else {
			header("Location: activate.php?e=1");
		}
	}
	
	private function Unreg() {
		global $database;
		$pw = $database->getUserField($_COOKIE['COOKUSR'],"password",1);
		if(md5($_POST['pw']) == $pw) {
			$database->unreg($_COOKIE['COOKUSR']);
			unset($_COOKIE['COOKUSR']);
			unset($_COOKIE['COOKEMAIL']);
			header("Location: login.php");
		}
		else {
			header("Location: activate.php?e=3");
		}
	}
	
	private function Login() {
		global $database,$session,$form;
		if(!isset($_POST['user']) || $_POST['user'] == "") {
			$form->addError("user",LOGIN_USR_EMPTY);
		}
		else if(!$database->checkExist($_POST['user'],0)) {
			$form->addError("user",USR_NT_FOUND);
		}
		if(!isset($_POST['pw']) || $_POST['pw'] == "") {
			$form->addError("pw",LOGIN_PASS_EMPTY);
		}
		else if(!$database->login($_POST['user'],$_POST['pw'])) {
			$form->addError("pw",LOGIN_PW_ERROR);
		}
		if($form->returnErrors() > 0) {
			$_SESSION['errorarray'] = $form->getErrors();
			$_SESSION['valuearray'] = $_POST;
			
			header("Location: index.php");
		}
		else {
			setcookie("COOKUSR",$_POST['user'],time()+COOKIE_EXPIRE,COOKIE_PATH);
			$session->login($_POST['user']);
			header("Location: action.php?action=loginAvatar&function=login");
		}
	}
	
	private function Logout() {
		global $session,$database;
		$database->activeModify($session->username,1);
		$session->Logout();
		header("Location: index.php");
	}
	
	private function validEmail($email) {
	  $regexp="/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
	  if ( !preg_match($regexp, $email) ) {
		   return false;
	  }
	  return true;
	}
	
	public function generateCity($uid) {
		global $database;
		$iid = $database->generateIsland();
		$citypos = $database->generateCityPos($iid);
		$cid = $database->addCity($iid,$uid,$citypos,1);
		//$_SESSION['cid'] = $cid;
		//header("Location: d.php?r=".$cid);
	}
	
	public function changeAvatarValues($post){
		global $database,$session;
		if(!isset($post['actionRequest']) || ($post['actionRequest'] != $session->checker))
		 header("Location: action.php?view=error");
		//Change username
		if(isset($post['name']) && $post['name']!="")
		 $database->updateUserField($session->uid,"username",$post['name'],1);
		//Change password
		if(isset($post['oldPassword']) && isset($post['newPassword']) && isset($post['newPasswordConfirm']))
		 if($post['newPassword'] == $post['newPasswordConfirm']){
		  $oldpass = $database->getUserField($session->uid,"password",0);
		  $oldpass = md5($oldpass);
		  if($oldpass == $post['oldPassword'])
		   $database->updateUserField($session->uid,"password",$post['newPassword'],1);
		 }
	}
	public function changeEmail($post){
		global $database,$session;
		if(!isset($post['actionRequest']) || ($post['actionRequest'] != $session->checker))
		 header("Location: action.php?view=error");
		//Change password
		if(isset($post['email']) && isset($post['password'])){
		  $oldpass = $database->getUserField($session->uid,"password",0);
		  $oldpass = md5($oldpass);
		  if($oldpass == $post['password'])
		   $database->updateUserField($session->uid,"email",$post['email'],1);
		 }
	}
	
};
$account = new CAccount;
?>