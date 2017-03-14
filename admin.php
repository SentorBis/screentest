<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<meta http-equiv="pragma" content="no-cache" />
	<title>ScreenTest - DB Admin</title>
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
	  <h2>Modération des screenshots proposés :</h2>
	
	  <?php
	  
	    // INSERT VALUE INTO FORM
		ini_set('display_errors',1);
		error_reporting(E_ALL | E_STRICT);
		
		try {
			$connec = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=password');
		} catch (PDOException $e) {
			echo "Error : " . $e->getMessage() . "<br/><br/>";
			echo "The application failed to connect to the database.<br/>";
			die();
		}
		
		$stmt = $connec->prepare("SELECT * FROM screentest.Question WHERE validated=false LIMIT 1");
		$stmt->execute();
		$row = $stmt->fetch();
		
		print "<h3>Screenshot de l'entrée sélectionnée: </h3>";
		print "<img src=\"" . $row['image'] . "\" width=\"400\"></img><br>";
		print "<label>Nom de fichier: " . $row['image'] . "<br>";
		
		$screen_id = $row['screen_id'];
		$cat = $row['cat_id'];
		$a0 = $row['answer0'];
		$a1 = $row['answer1'];
		$a2 = $row['answer2'];
		$a3 = $row['answer3'];
		$ok = $row['validated'];
	  ?>
	  
	  <h3>Données modifiables :</h3>
	
	  <form action="admin.php" method="post" enctype="multipart/form-data">
		<p><label>Catégorie :</label><br/>
		<select name="category">
          <option value="1" <?php if($cat == 1) {echo ' selected';}?>>Film</option>
          <option value="2" <?php if($cat == 2) {echo ' selected';}?>>Série</option>
          <option value="3" <?php if($cat == 3) {echo ' selected';}?>>Jeu vidéo</option>
          <option value="4" <?php if($cat == 4) {echo ' selected';}?>>Dessin animé</option>
        </select></p>
		
        <p><label>Bonne réponse :</label><br/>
		<input type="text" name="tanswer" <?php echo 'value=' . $a0;?> maxlength="50"></p>
		<p><label>Mauvaises réponses :</label><br/>
        <input type="text" name="wanswer1" <?php echo 'value=' . $a1;?> maxlength="50">
        <input type="text" name="wanswer2" <?php echo 'value=' . $a2;?> maxlength="50">
        <input type="text" name="wanswer3" <?php echo 'value=' . $a3;?> maxlength="50"></p>
        <p><button type="submit" name="submit">Soumettre</button></p>
      </form>
	
	</center>
	
	<footer>
	  <p>Website created by Grégoire Labasse (#6607969)</p>
	</footer>
  </body>
</html>