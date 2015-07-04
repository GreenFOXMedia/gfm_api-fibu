<?php

class Setup {

	public $step_1_values = null;
	public $step_2_values = null;
	public $step_3_values = null;

	public function getStep($step){
		switch ($step) {
			case 'welcome':
				echo "Willkommen im Setup";
				break;
			case '1':
				echo "Schritt 1 - Datenbank Einstellungen";
				break;
			case '2':
				echo "Schritt 2 - Benutzer Einstellungen";
				break;
			case '3':
				echo "Schritt 3 - Zusammenfassung";
				break;
			case '4':
				echo "Schritt 4 - Abschluss";
				break;
			default:
				echo "Willkommen im Setup";
				break;
		}
	}

	public function showWelcomeScreen(){
		?>
			<h2>System Installieren</h2>
			<p>Herzlich Willkommen im Installationsassistent</p>
			<p>In wenigen Schritten ist Ihr System eingerichtet und kann im vollen Umfang genutzt werden.<br>
			Um das Setup zu starten klicken Sie bitte auf den Button.
			<input type="hidden" name="step" value="1">
			<button type="submit">Weiter</button>
			</p>
		<?php 
	}

	public function showDatabaseSetup(){
		?>
			<h2>Datenbank</h2>

			<input name="username" placeholder="Datenbank Benutzername">
			<input name="password" placeholder="Datenbank Passwort">
			<input name="hostname" placeholder="Datenbank Host">
			<input name="database" placeholder="Datenbank Name">
			<input name="prefixes" placeholder="Tabellen Präfix">
			<input type="hidden" name="step" value="2">
			<button type="submit">Weiter</button>
			</form>
		<?php 
		foreach ($_POST as $key => $value) {
			$this->step_1_values[$key] = $value;
		}
		// $this->step_1_values = $_POST;

	}

	public function showUserSetup(){
		?>
			<h2>Benutzer</h2>

			<input name="cp_username" placeholder="Admin Benutzername">
			<input name="cp_password" placeholder="Admin Passwort">
			<input name="cp_mail" placeholder="Admin E-Mail">
			<input type="hidden" name="step" value="3">
			<button type="submit">Weiter</button>
		<?php 
			$fo = fopen("config.php", "a+");
			fwrite($fo,"<?php\n");
			foreach ($_POST as $key => $value) {
				fwrite($fo, "$".$key." = '".$value."';\n" );
			}
			fclose($fo);
			// $this->step_2_values = $this->step_1_values.=$_POST;
		
	}

	public function showSetupSummary(){
		
			?>

			<h2>Zusammenfassung</h2>
			<p>
				<?php 
					$fo = fopen("config.php", "a+");
					foreach ($_POST as $key => $value) {
						fwrite($fo, "$".$key." = '".$value."';\n" );
					}
					fclose($fo);
					
				?>
			</p>

			<input type="hidden" name="step" value="3">
			<button type="submit">Weiter</button>
		<?php 

	}

	public function showFinishScreen(){
		?>
			<h2>Setup Erfolgreich!</h2>
			<p>Setup erfolgreich beendet!</p>
		<?php 
	}
}

$setup = new Setup();