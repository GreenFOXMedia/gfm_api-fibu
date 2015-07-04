<?php

class Config {
	private $host = "localhost";
	private $user = "root";
	private $pass = "d98bcd98bc";
	private $base = "green_fox_media";
	private $dbConnection = false;

	public $temp_data = null;
	public $results = null;

	public $baseURI;

	public $widget_table = "gfm_admin_dashboard_widgets";
	public $customer_table = "gfm_customer";
	public $projects_table = "gfm_projects";
	public $billings_table = "gfm_billings";

	public function __construct(){
		mysql_connect($this->host, $this->user, $this->pass);
		$s = mysql_select_db($this->base);
		if($s){
			$this->dbConnection = true;
		}
	}

	public function LoadBaseURI(){
		$this->baseURI = dirname(__FILE__);
	}

	public function baseURI(){
		$this->LoadBaseURI();
		return $this->baseURI;
	}

	public function SQL($stmt){
		$this->temp_data = mysql_query($stmt) or die (mysql_error());
	}

	public function fetchObject(){
		$count = mysql_num_rows($this->temp_data);
		if($count > 1){
			for($i = 1; $i <= $count; $i++){
				$this->results[$i] = mysql_fetch_object($this->temp_data);
			}
		} else {
			$this->results = mysql_fetch_object($this->temp_data);
		}
	}
}
?>