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
				echo "<div id='screen'><img src=\"" . $row['image'] . "\" width=\"400\"></div>\n";
				echo "<p>Ce screenshot provient de :</p>\n";
				echo "<button id='A'>" . $row['answer0'] . "</button>\n<button id='B'>" . $row['answer1'] . "</button>\n<button id='C'>" . $row['answer2'] . "</button>\n<button id='D'>" . $row['answer3'] . "</button>\n\n";
			}			
		}
		?>
	</body>
</html>
		