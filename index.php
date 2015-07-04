<?php
	// if(!is_dir("setup")){
	session_start();
	error_reporting("OFF");
	$_SESSION["BASE_PATH"] = dirname(__FILE__)."/";
	$_SESSION["ADMIN_PATH"] = dirname(__FILE__)."/admin/";
	$_SESSION["USER_PATH"] = dirname(__FILE__)."/user/";
	$_SESSION["INCLUDE_PATH"] = dirname(__FILE__)."/includes/";
	$_SESSION["ADMIN_INCLUDE_PATH"] = $_SESSION["ADMIN_PATH"]."/includes/";
	$_SESSION["USER_INCLUDE_PATH"] = $_SESSION["USER_PATH"]."/includes/";
	
	if(isset($_SESSION["user_login"]) && $_SESSION["user_login"] == "true"){
		$forceTo = $_SESSION["permission"];
		header("Location: ".$forceTo."/");
	} else {
	include "includes/loginHandler.class.php";
	if(isset($_SERVER["REQUEST_METHOD"])){
		switch ($_SERVER["REQUEST_METHOD"]) {
			case 'POST':
				$action->checkLogin();
				break;
			case 'GET':

				break;
			case 'PUT':

				break;
			case 'DELETE':

				break;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>GreenFOX Media | Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div class="container">
		<div class="LoginWindow">
			<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
				<input name="fibu_username" value="" type="text">
				<input name="fibu_password" value="" type="password">
				<select name="fibu_choice">
					<option value="admin">Admin</option>
					<option value="user">User</option>
				</select>
				<button type="submit">Einloggen</button>
			</form>
		</div>
	</div>
</body>
</html>
<?php
	}
// } else {
// 	header("Location: setup/?step=welcome");
// }
?>