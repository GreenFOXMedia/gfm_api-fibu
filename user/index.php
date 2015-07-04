<?php 
	session_start();
	if(isset($_SESSION["user_login"]) && $_SESSION["user_login"] == "true" && $_SESSION["permission"] == "user"){
		?>
			Hallo <?php echo $_SESSION["username"] ?>
		<?php
	}
	else {
		header("Location: ../");
	}
?>