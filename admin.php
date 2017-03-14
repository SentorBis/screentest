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
	  	ini_set('display_errors',1);
		error_reporting(E_ALL | E_STRICT);
		
		try {
			$connec = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=password');
		} catch (PDOException $e) {
			echo "Error : " . $e->getMessage() . "<br/><br/>";
			echo "The application failed to connect to the database.<br/>";
			die();
		}
		
		$hide = 0;
		
		// MODIFY ENTRY IN DATABASE
		
		if(isset($_POST['submit'])) {
			
			$cat = $_POST['category'];
			$a0 = $_POST['tanswer'];
			$a1 = $_POST['wanswer1'];
			$a2 = $_POST['wanswer2'];
			$a3 = $_POST['wanswer3'];
			$sql = "UPDATE screentest.Question SET cat_id=$cat, answer0='$a0', answer1='$a1', answer2='$a2', answer3='$a3', validated=true WHERE screen_id=" . $_POST['id'];

			if ($connec->query($sql)) {
				echo "<p>L'entrée " . $_POST['id'] . ", ayant (désormais) pour réponse " . $a0 . ", a été éditée et validée. Elle pourra désormais apparaître dans le quiz.</p>";
			} else {
				echo "<p>L'entrée " . $_POST['id'] . ", qui devrait avoir pour réponse " . $a0 . ", n'a pas pu être éditée et validée. Dites à l'admin de se sortir les doigts du boule.</p>";
			}
			
			
		} else if(isset($_POST['delete'])) {
			if ($connec->query("DELETE FROM screentest.Question WHERE screen_id=" . $_POST['id'])) {
				echo "<p>L'entrée " . $_POST['id'] . ", ayant pour réponse " . $_POST['tanswer'] . ", a été supprimée de la base de données";
				if (unlink($_POST['img'])) {
					echo " et l'image correspondante effacée du serveur.</p>";
				} else {
					echo " mais l'image correspondante n'a pas pu être effacée. Notez l'adresse suivante et notifiez-en l'administrateur : " . $_POST['img'] . "</p>";
				}
			} else {
				echo "<p>L'entrée " . $_POST['id'] . ", ayant pour réponse " . $_POST['tanswer'] . ", n'a pas pu être supprimée. Dites à l'administrateur de se bouger le cul et de corriger ça.</p>";
			}
		}
	  
	    // INSERT VALUE INTO FORM
		
		$stmt = $connec->prepare("SELECT * FROM screentest.Question WHERE validated=false LIMIT 1");
		$stmt->execute();
		$row = $stmt->fetch();
		
		if($row['image'] != NULL) {
			print "<h3>Screenshot de l'entrée sélectionnée: </h3>";
			print "<img src=\"" . $row['image'] . "\" width=\"400\"></img><br>";
			print "<label>Nom de fichier: " . $row['image'] . "</label><br>";
		} else {
			print "<h3>Toutes les entrées en attente de validation ont été traitées.</h3>";
			$hide = 1;
		}
		
		$screen_id = $row['screen_id'];
		$cat = $row['cat_id'];
		$a0 = $row['answer0'];
		$a1 = $row['answer1'];
		$a2 = $row['answer2'];
		$a3 = $row['answer3'];
		$img = $row['image'];
	  ?>
	  
	  <div id="adminForm"><h3>Données modifiables (éditer si nécessaire) :</h3>
	
	  <form action="admin.php" method="post" enctype="multipart/form-data">
		<p><label>Catégorie :</label><br/>
		<select name="category">
          <option value="1" <?php if($cat == 1) {echo 'selected';}?>>Film</option>
          <option value="2" <?php if($cat == 2) {echo 'selected';}?>>Série</option>
          <option value="3" <?php if($cat == 3) {echo 'selected';}?>>Jeu vidéo</option>
          <option value="4" <?php if($cat == 4) {echo 'selected';}?>>Dessin animé</option>
        </select></p>
		
        <p><label>Bonne réponse :</label><br/>
		<input type="text" name="tanswer" <?php echo 'value="' . $a0 . '"';?> maxlength="50"></p>
		<p><label>Mauvaises réponses :</label><br/>
        <input type="text" name="wanswer1" <?php echo 'value="' . $a1 . '"';?> maxlength="50">
        <input type="text" name="wanswer2" <?php echo 'value="' . $a2 . '"';?> maxlength="50">
        <input type="text" name="wanswer3" <?php echo 'value="' . $a3 . '"';?> maxlength="50"></p>
		<input type="hidden" name="id" <?php echo 'value="' . $screen_id . '"';?>>
		<input type="hidden" name="img" <?php echo 'value="' . $img . '"';?>>
        <p><button class="half" type="submit" name="submit">Valider l'entrée</button> <button class="half" type="submit" name="delete">Supprimer l'entrée</button></p>
      </form></div>
	
	<h2>Règles d'utilisation de l'outil de modération :</h2>
	<p>Cette page permet de modifier les entrées de la base de données n'ayant pas encore été vérifiées par un modérateur. Si l'image est inappropriée ou de trop mauvaise qualité, veuillez cliquer sur "Supprimer l'entrée" pour enlever l'entrée concernée. Sinon, vérifiez que la catégorie choisie et les réponses données sont acceptables (c'est-à-dire que la bonne réponse est bonne et que les autres sont des réponses plausibles pour le screenshot). Corrigez les fautes si possible. Mettez le titre de l'oeuvre en langue originale (romanisée le cas échéant). Quand vous jugez que tout est bon, cliquez sur "Valider l'entrée".</p> 
	</center>
	
	<?php
		if ($hide) {
			echo '<script type="text/javascript"> document.getElementById("adminForm").style.display = \'none\'; </script>';
		}
	?>
	
	<footer>
	  <p>Website created by Grégoire Labasse (#6607969)</p>
	</footer>
  </body>
</html>