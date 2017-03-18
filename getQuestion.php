<!DOCTYPE html>
<html>
	<body>
	<?php
		ini_set('display_errors',1);
		error_reporting(E_ALL | E_STRICT);
		
		try {
			$connec = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=password');
		} catch (PDOException $e) {
			echo "Error : " . $e->getMessage() . "<br/><br/>";
			echo "The application failed to connect to the database.<br/>";
			die();
		}
		
		if(isset($_GET['q'])) {
			// APPEL AJAX POUR CREER UN NOUVEAU QUIZ
			$sql = 'SELECT * FROM screentest.Question WHERE screen_id=' . $_GET['q'];
			
			// Génération du quiz			
			foreach ($connec->query($sql) as $row) {
				echo "<h1 id='titre'></h1>\n"; // il est plus simple de remplir ça dans le JS, donc on met la balise mais on la laisse vide
				echo "<div class='prescreen'><span id='score'></span><span id='timer'></span></div>";
				echo "<div><img id='screen' src=\"" . $row['image'] . "\" width=\"400\"></div>\n";
				echo "<p>Ce screenshot provient de :\n";
				$thetrueanswerwillalwaysbeAbutwhatever = array(
					'<button id="A" onclick="answer(\'A\')">' . $row['answer0'],
					'<button id="B" onclick="answer(\'B\')">' . $row['answer1'],
					'<button id="C" onclick="answer(\'C\')">' . $row['answer2'],
					'<button id="D" onclick="answer(\'D\')">' . $row['answer3']);
				shuffle($thetrueanswerwillalwaysbeAbutwhatever);
				foreach($thetrueanswerwillalwaysbeAbutwhatever as $ans) {
					echo "$ans</button>";
				}
			}			
		}
		?>
	</body>
</html>
		