<?php

	include $_SESSION["BASE_PATH"]."config.class.php";
	
	class ActionHandler extends Config {
		
		public function handleAction($action){
			switch ($action) {
				case 'widgets':
					include "widget_uploader/index.php";
					break;
				case 'logout':
					session_destroy();
					unlink($_SESSION);
					header("location: ../");
					break;
				
				default:
					echo "Action ist Ungültig";
					break;
			}
		}

		public function showUploader(){
			?>
			<div class="hint">
				<p>Das Zip-Archiv und die Hauptdatei M&Uuml;SSEN exakt gleich benannt sein!</p>
				<p>FORMAT:</p>
				<p>/{<strong>example_widget</strong>}/{<strong>example_widget</strong>}.php</p>
			</div>
			<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
				<input accept="" name="file" type="file">
				<input type="hidden" name="upload_zip">
				<button type="submit">Hochladen</button>
			</form>
			<?php
		}

		public function handleUpload($file){
			$widget_temp_dir = $_SESSION["BASE_PATH"]."widgets/temp/";
			$widget_dir = $_SESSION["BASE_PATH"]."widgets/";
			
			$file_type = $file["file"]["type"];
			$file_name = $file["file"]["tmp_name"];
			$file_final_name = $file["file"]["name"];

			$zip_file = $widget_temp_dir.$file_final_name;

			switch ($file_type) {
				case 'application/x-zip-compressed':
					
					$upload = move_uploaded_file($file_name, $zip_file );
					if($upload){
						$zip = new ZipArchive();
						$x = $zip->open($zip_file);
						if($x == true){
							$zip->extractTo($widget_dir);
							$zip->close();

							$file_final_name = pathinfo($file_final_name);

							$file_final_name = $file_final_name["filename"];

							$s = split("_", $file_final_name);
							$cs = count($s);
							if($cs > 1){
								$widget_title = null;
								for ($i = 0; $i < $cs; $i++){
									$widget_title .= ucwords($s[$i])." ";
								}
							} else {
								$widget_title = ucwords($file_final_name);
							}
							
							unlink($zip_file);
							$this->SQL("INSERT INTO $this->widget_table VALUES ('', '".$widget_title."', '".$file_final_name."', '1', '1')");
						}
						echo "Upload success";
					}
					else {
						echo "Upload failed!";
					}
					break;
				
				default:
					echo "Filetype '".$file_type. "' is not allowed!";
					break;
			}
		}

		public function getWidgetList(){
			$this->SQL("SELECT * FROM $this->widget_table");
			$this->fetchObject();

			$count = count($this->results);
			for ($i = 1; $i <= $count ; $i++) { 
				echo "<form action='".$_SERVER['PHP_SELF']."' method='get'>";
				echo "<input type='hidden' name='widget_id' readonly value='".$this->results[$i]->widget_id."'>";
				echo "<input name='widget_name' readonly value='".$this->results[$i]->widget_name."'>";
				echo "<input name='widget_class' readonly value='".$this->results[$i]->widget_class."'>";
				echo "<button>Löschen</button>";
				echo "</form>";
			}
		}
	}

	$handler = new ActionHandler();

?>