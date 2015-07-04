<?php 
	session_start();

	if(!isset($_SESSION["user_login"]) && $_SESSION["user_login"] != "true" && $_SESSION["permission"] != "admin"){
		header("Location: ../");
	}
	else {
		$incl = $_SESSION["ADMIN_INCLUDE_PATH"];
		include $incl."class.admin.php";
		?>
			
		<!DOCTYPE html>
		<html>
		<head>
			<title>GreenFOX Media | Admin</title>
			<link rel="stylesheet" type="text/css" href="css/admin-styles.css">
			<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
			<script type="text/javascript" src="js/functions.js"></script>
		</head>
		<body>
			<div class="admin-menu">
				<ul>
					<li><a href="">Dashboard</a></li>
					<li><a href="config/?action=users">Benutzer verwalten</a></li>
					<li><a href="config/?action=widgets">Widgets verwalten</a></li>
					<li><a href="config/?action=customers">Kunden verwalten</a></li>
					<li><a href="config/?action=billings">Rechnungen verwalten</a></li>
					<li class='submenu'><?php echo $_SESSION["username"]?>
						<ul>
							<li><a href="config/?action=settings">Einstellungen</a></li>
							<li><a href="config/?action=logout">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="container">
				<div class="inset">
					<h2>Dashboard</h2>
					<div class="widget_area">
						<?php
							$admin->showActiveWidgets();
						?>					
					</div>
				</div>
			</div>
		</body>
		</html>

		<?php
	}
?>