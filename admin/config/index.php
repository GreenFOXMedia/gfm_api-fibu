<?php 
	session_start();
	if(!isset($_SESSION["user_login"]) && $_SESSION["user_login"] != "true" && $_SESSION["permission"] != "admin"){
		header("Location: ../");
	}
	else {

		include $_SESSION["INCLUDE_PATH"]."actionHandler.class.php";

		?>
			
		<!DOCTYPE html>
		<html>
		<head>
			<title>GreenFOX Media | Admin</title>
			<link rel="stylesheet" type="text/css" href="../css/admin-styles.css">
			<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
			<script type="text/javascript" src="../js/functions.js"></script>
		</head>
		<body>
			<div class="admin-menu">
				<ul>
					<li><a href="../">Dashboard</a></li>
					<li><a href="?action=users">Benutzer verwalten</a></li>
					<li><a href="?action=widgets">Widgets verwalten</a></li>
					<li><a href="?action=customers">Kunden verwalten</a></li>
					<li><a href="?action=billings">Rechnungen verwalten</a></li>
					<li class='submenu'><?php echo $_SESSION["username"]?>
						<ul>
							<li><a href="?action=settings">Einstellungen</a></li>
							<li><a href="?action=logout">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="container">
				<div class="inset">
					<?php
						$handler->handleAction($_GET["action"]);
					?>
				</div>
			</div>
		</body>
		</html>

		<?php
	}
?>