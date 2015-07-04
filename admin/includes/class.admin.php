<?php
require "../config.class.php";
class AdminActions extends Config {
	private $widgets_table = "gfm_admin_dashboard_widgets";

	public function showActiveWidgets(){
		$this->SQL("SELECT * FROM $this->widgets_table WHERE widget_active = '1'");
		$this->fetchObject();
		$count = count($this->results);
		if($count > 1){
			for ($i=1; $i <= $count; $i++) {
				echo "<div class='widget' id='".$this->results[$i]->widget_class."'>";
				include dirname(dirname(dirname(__FILE__)))."/widgets/".strtolower($this->results[$i]->widget_class)."/".strtolower($this->results[$i]->widget_class).".php";
				echo "</div>";
			}
		} else {
			echo "<div class='widget' id='".$this->results->widget_class."'>";
			include dirname(dirname(dirname(__FILE__)))."/widgets/".strtolower($this->results->widget_class)."/".strtolower($this->results->widget_class).".php";
			echo "</div>";
		}	
	}
}

$admin = new AdminActions();
?>