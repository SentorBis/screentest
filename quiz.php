<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
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
	  </ul>
	<center>
	  <?php
		try {
			$dbuser = 'postgres';
			$dbpass = 'Homere69';
			$host = 'localhost';
			$dbname='screentest';

			$connec = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		} catch (PDOException $e) {
			echo "Error : " . $e->getMessage() . "<br/>";
			die();
		}
		
		$sql = 'SELECT cat_id, cat_name, description FROM Category';
		foreach ($connec->query($sql) as $row) {
			print $row['cat_id'] . " ";
			print $row['cat_name'] . "-->";
			print $row['description'] . "<br>";
		}
	  ?>
	  
	  <h1>Question X (sur Y)</h1>
	  <img src="winners_dont_cheat.jpg" width="400"></img>
	  <p>Ce screenshot provient de :</p>
	  <p class="answer">Réponse A</p>
	  <p class="answer">Réponse B</p>
	  <p class="answer">Réponse C</p>
	  <p class="answer">Réponse D</p>
	</center>
	
	<footer>
	  <p>Website created by Grégoire Labasse (#6607969)</p>
	</footer>
  </body>
</html>