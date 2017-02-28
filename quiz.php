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
	  
	  <center><?php
		ini_set('display_errors',1);
		error_reporting(E_ALL | E_STRICT);
		try {
			$connec = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=password');
		} catch (PDOException $e) {
			echo "Error : " . $e->getMessage() . "<br/><br/>";
			echo "The application failed to connect to the database.<br/>";
			die();
		}
		$sql = 'SELECT cat_id, cat_name, description FROM screentest.Category';
		foreach ($connec->query($sql) as $row) {
			print "<p><button>" . $row['cat_name'] . "</button></p>";
		}
	  ?></center>
	  
	<div class="hide"><center>
	  <h1>Question X (sur Y)</h1>
	  <img src="winners_dont_cheat.jpg" width="400"></img>
	  <p>Ce screenshot provient de :</p>
	  <p class="answer">Réponse A</p>
	  <p class="answer">Réponse B</p>
	  <p class="answer">Réponse C</p>
	  <p class="answer">Réponse D</p>
	</center></div>
	
	<footer>
	  <p>Website created by Grégoire Labasse (#6607969)</p>
	</footer>
  </body>
</html>