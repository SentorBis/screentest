<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<meta http-equiv="pragma" content="no-cache" />
	<title>ScreenTest - Quiz</title>
    <link rel="stylesheet" type="text/css" href="myStyle.css">
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
	
	  <h3>Requête SQL par PHP en utilisant un PDO pour obtenir le contenu actuel de la table Category :</h3>
	
	  <p><?php
		ini_set('display_errors',1);
		error_reporting(E_ALL | E_STRICT);
		try {
			$connec = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=Homere69');
		} catch (PDOException $e) {
			echo "Error : " . $e->getMessage() . "<br/><br/>";
			echo "The application failed to connect to the database.<br/>";
			die();
		}
		$sql = 'SELECT cat_id, cat_name, description FROM screentest.Category';
		foreach ($connec->query($sql) as $row) {
			print $row['cat_id'] . " ";
			print $row['cat_name'] . "--> ";
			print $row['description'] . "<br>";
		}
	  ?></p>
	</center>
	
	<footer>
	  <p>Website created by Grégoire Labasse (#6607969)</p>
	</footer>
  </body>
</html>