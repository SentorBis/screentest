<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<meta http-equiv="pragma" content="no-cache" />
	<title>ScreenTest - Quiz</title>
	<script type="text/javascript" src="quiz.js"></script>
    <link rel="stylesheet" type="text/css" href="myStyle.css">
  </head>
  
  <header>
	<h3>Screentest</h3>
  </header>
  
  <body>
	  <ul>
		<li><a href="index.php">Accueil</a></li>
		<li><a class="active" href="quiz.php">Nouveau quiz</a></li>
		<li><a href="submit.php">Proposer un screenshot</a></li>
		<li><a href="about.html">A propos</a></li>
	  </ul>
	  
	  <center><?php
	  	ini_set('display_errors',1);
		error_reporting(E_ALL | E_STRICT);
		
		// DEBUG
		
		if(isset($_GET['debug'])) {
			echo '<h1>Mode debug</h1>';
			$numtest = 0;
			$success = 0;
			$failures = 0;
			$errors = "<p>";
			
			echo "<p>Aucun test n'a été implémenté pour cette page.<p>";
			
			echo '<p>' . $numtest . ' tests effectués: ' . $success . ' tests complétés avec succès, ' . $failures . ' tests ont rencontré des erreurs.</p>';
			if ($failures > 0) {
				echo $errors . "</p>";
			}
		}
	?>
	  
	  <div id="quiz"><?php
		ini_set('display_errors',1);
		error_reporting(E_ALL | E_STRICT);
		
		try {
			$connec = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=password');
		} catch (PDOException $e) {
			echo "Error : " . $e->getMessage() . "<br/><br/>";
			echo "The application failed to connect to the database.<br/>";
			die();
		}
		
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			// L'UTILISATEUR A FAIT SA SELECTION
			
			$cat;
			
			for ($i = 1; $i <= 4; $i++) {
				$chose = 'chose(' . $i . ')';
				if (isset($_POST[$chose])) {
					$cat = $i;
					break;
				}
			}
			
			// NOTE : donner la possibilité de choisir la note plus tard p-ê
			$limite = 20;
			$sql = 'SELECT screen_id FROM screentest.Question WHERE cat_id=' . $cat . ' AND validated=true ORDER BY RANDOM() LIMIT ' . $limite;
			
			// calc nombre de lignes (donc de questions)
			$sel = $connec->prepare($sql);
			$sel->execute();
			$count = $sel->rowCount();
			
			/*// Génération du quiz
			***************Fonction de test utilisée avant d'implémenter l'appel AJAX, je le laisse au cas où***********
			print "<h1 id='titre'>Question 1 (sur $count)</h1>\n";
			print "<div id='screen'><img src=\"winners_dont_cheat.jpg\" width=\"400\"></div>\n";
			print "<p>Ce screenshot provient de :</p>\n";
			print "<button id='A'>Bakemonogatari</button>\n<button id='B'>Sayonara Zetsubou-sensei</button>\n<button id='C'>Tsukuyomi: Full Moon</button>\n<button id='D'>Tsukihime</button>\n\n";*/
			
			if ($count > 0) {
				echo "<script type='text/javascript'>\n\t\tvar quizquest = [" . $cat;
				foreach ($connec->query($sql) as $row) {
					echo ", " . $row['screen_id'];
				}
				echo "];\n\t\tstartQuiz(quizquest);\n\t</script>";
			} else {
				print "<p>Cette catégorie ne comprend aucune question, désolé.</p>";
			}
			
		} else {
			// L'UTILISATEUR ARRIVE DIRECTEMENT SUR CETTE PAGE
			
			// AFFICHER SELECTION
			$sql = 'SELECT cat_id, cat_name, description FROM screentest.Category';
			print "<h1>Choisissez une catégorie :</h1>\n";
			print "<form action=\"quiz.php\" method=\"post\">\n";
			foreach ($connec->query($sql) as $row) {
				print "<p><button type=\"submit\" name=\"chose(" . $row['cat_id'] . ")\">" . $row['cat_name'] . "</button></p>\n";
			}
			print "</form>\n";
			print "<p>Répondez correctement le plus rapidement possible pour gagner plus de points !</p>";
		}
		//echo '<script type="text/javascript"> document.getElementById("adminForm").style.display = \'none\'; </script>';
	  ?></div></center>
	
	<footer>
	  <p>Website created by Grégoire Labasse (#6607969)</p>
	</footer>
  </body>
</html>