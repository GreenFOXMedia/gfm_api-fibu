<?php
session_start();

require "config.class.php";
class FrontendActions extends Config {
	
	private $user_tbl = "gfm_fibu_users";

	public function checkLogin(){
		switch ($_POST["fibu_choice"]) {
			case 'admin':
				$this->doLogin($_POST["fibu_username"], $_POST["fibu_password"], $_POST["fibu_choice"]);
				break;
			case 'user':
				$this->doLogin($_POST["fibu_username"], $_POST["fibu_password"], $_POST["fibu_choice"]);
				break;
			default:
				echo "Invalid Login Action";
				break;
		}
	}

	private function doLogin($username, $password, $role){
		$this->SQL("SELECT * FROM $this->user_tbl WHERE username = '$username'");
		$cnt = mysql_num_rows($this->temp_data);
		if($cnt == "1"){
			$this->fetchObject();
			if($role !== $this->results->role){
				echo "Sie haben nicht die entsprechenden Rechte! Bitte wenden Sie sich an den Administrator.";
			} else {
				if($this->results->username === $username && $this->results->password === md5($password)){
					
					$_SESSION["user_login"] = "true";
					$_SESSION["permission"] = $this->results->role;
					$_SESSION["session_id"] = session_id();
					$_SESSION["username"] = $this->results->first_name;
					$_SESSION["uid"] = $this->results->uid;

					header("Location: ".$role."/");
				}
			}
		} else{
			echo "Kein Benutzer gefunden";
		}
	}
	public function test(){
		echo "test";
	}
}

$action = new FrontendActions();

?>