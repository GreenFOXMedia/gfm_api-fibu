<?php include "includes/display.php"; ?>
<?php
	isset($_POST["step"]) ? $step = $_POST["step"] : $step = "welcome";
?>
<!DOCTYPE html>
<html>
<head>
	<title>GreenFOX Media | Setup</title>
	<link rel="stylesheet" type="text/css" href="css/setup-styles.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<div class="admin-menu">
		<ul>
			<li><?php $setup->getStep($step) ?></li>
		</ul>
	</div>
	<div class="container">
		<div class="inset">
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
		<?php
			switch ($step) {
				case 'welcome':
					$setup->showWelcomeScreen();
					break;

				case '1':
					$setup->showDatabaseSetup();
					break;

				case '2':
					$setup->showUserSetup();
					break;

				case '3':
					$setup->showSetupSummary();
					break;

				case '4':
					$setup->showFinishScreen();
					break;
				
				default:
					$setup->showWelcomeScreen();
					break;
			}
		?>
		</div>
	</div>
</body>
</html>