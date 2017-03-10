<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<title>ScreenTest</title>
    <link rel="stylesheet" type="text/css" href="myStyle.css">
	<?php
			chmod("quiz.php", 0777);
			chmod("query.php", 0777);
	?>
  </head>
  
  <header>
    <h3>Screentest</h3>
  </header>
  
  <body>
	  <ul>
	    <li><a class="active" href="index.php">Accueil</a></li>
	    <li><a href="quiz.php">Nouveau quiz</a></li>
	    <li><a href="submit.php">Proposer un screenshot</a></li>
	    <li><a href="about.html">A propos</a></li>
		<li><a href="chrono.html">Test Javascript (dev)</a></li>
		<li><a href="query.php">Test PHP + PostgreSQL (dev)</a></li>
	  </ul>
	  <center>
	
	<?php
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
	
	    <h1>Vous voulez des quiz qui vous font tenter de deviner d'où proviennent des screenshots tirés aléatoirement d'une base de données à laquelle les utilisateurs peuvent ajouter leurs propres screenshots ?</h1>
	    <p>1. Vous êtes au bon endroit.<br>
	    2. Vous cherchez des trucs bizarres.</p>
		<form action="quiz.php">
			<input type="submit" value="Commencer un quiz" class="home" />
		</form>
	  </center>
  
	  <footer>
		<p>Website created by Grégoire Labasse (#6607969)</p>
	  </footer>
	</body>
</html>