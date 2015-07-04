<h2>Widgets bearbeiten</h2>
<?php
	global $handler;


	$handler->showUploader();

	if(isset($_POST["upload_zip"]) && !empty($_FILES)){
		$handler->handleUpload($_FILES);
	}
	
	$handler->getWidgetList();



?>