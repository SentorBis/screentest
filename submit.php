<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<title>ScreenTest - Soumettre un nouveau screen</title>
    <link rel="stylesheet" type="text/css" href="myStyle.css">
  </head>
  
  <header>
    <h3>Screentest</h3>
  </header>
  
  <body>
    <ul>
	  <li><a href="index.php">Accueil</a></li>
	  <li><a href="quiz.php">Nouveau quiz</a></li>
	  <li><a class="active" href="submit.php">Proposer un screenshot</a></li>
	  <li><a href="about.html">A propos</a></li>
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
			
			//Test generateUniqueFilename
			$numtest++;
			if (strcmp(generateUniqueFilename(), generateUniqueFilename()) != 0) {
				$success++;
			} else {
				$failures++;
				$errors += "generateUniqueFilename: La fonction a produit deux filenames identiques.<br>";
			}
			
			echo '<p>' . $numtest . ' tests effectués: ' . $success . ' tests complétés avec succès, ' . $failures . ' tests ont rencontré des erreurs.</p>';
			if ($failures > 0) {
				echo $errors . "</p>";
			}
		}
	?>
	
	  <h1>Soumettre un screenshot :</h1>
	  <form action="submit.php" method="post" enctype="multipart/form-data">
		<p><label>Screenshot (format JPG ou PNG, maximum 300Ko) :</label><br/>
	    <input type="file" name="new_screenshot" ></p>
		<p><label>Catégorie :</label><br/>
		<select name="category">
		  <option value="0" selected></option>
          <option value="1">Film</option>
          <option value="2">Série</option>
          <option value="3">Jeu vidéo</option>
          <option value="4">Dessin animé</option>
        </select></p>
		
        <p><label>Bonne réponse (origine du screenshot) :</label><br/>
		<input type="text" name="tanswer" placeholder="Enter correct answer" maxlength="50"></p>
		<p><label>Mauvaises réponses (essayer de donner des mauvaises réponses crédibles) :</label><br/>
        <input type="text" name="wanswer1" placeholder="Enter a wrong answer" maxlength="50">
        <input type="text" name="wanswer2" placeholder="Enter a wrong answer" maxlength="50">
        <input type="text" name="wanswer3" placeholder="Enter a wrong answer" maxlength="50"></p>
        <p><button type="submit" name="submit">Soumettre</button></p>
      </form>
	  
	  <p><?php
	  	ini_set('display_errors',1);
		error_reporting(E_ALL | E_STRICT);
		
		// Fonction servant à générer un nom de fichier ayant des chances minimes de déjà exister.
		function generateUniqueFilename() {
			$now = getdate();
			$tktnum = array(
				$now['mday'] + $now['seconds'],
				$now['mon'] + $now['minutes'],
				$now['year'] - 2000 + $now['hours'],
				rand(0,100)
			);
			
			$i = 0;
			while($i < 4){
				if ($tktnum[$i] > 99) {
					$tktnum[$i] -= 100;
				} else if ($tktnum[$i] < 10) {
					$tktnum[$i] = '0' . $tktnum[$i];
					$i++;
				} else {
					$i++;
				}
			}
			
			$filename = $tktnum[0] . $tktnum[1] . $tktnum[2] . $tktnum[3];
			return $filename;
		}

	  if(isset($_POST['submit'])) {
		  
		  if($_FILES['new_screenshot']['size'] == 0) {
			  echo 'Vous devez choisir une image.';
		  } else if ( $_POST['category'] == 0 || !(isset($_POST['tanswer'])) || !(isset($_POST['wanswer1'])) || !(isset($_POST['wanswer2'])) || !(isset($_POST['wanswer3'])) ) {
			  echo 'Vérifiez que vous avez bien rempli tous les champs et choisi une catégorie valide.';
		  } else {
			  
			  /****************CONNECTION BASE DE DONNEES [FONCTIONNE]*/
			  try {
					$connec = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=password');
			  } catch (PDOException $e) {
				  echo "Error : " . $e->getMessage() . "<br/><br/>";
				  echo "The application failed to connect to the database.<br/>";
				  die();
			  }
			  
			  //FILE UPLOAD
			  //Le code de base provient de W3Schools, et a été arrangé pour les besoins du site.
			  
			$target_dir = "screens/";
			$tmp = explode(".", $_FILES["new_screenshot"]["name"]);
			$target_file = $target_dir . generateUniqueFilename() . "." . end($tmp);
			$uploadOk = 1;
			
			// basename($_FILES["new_screenshot"]["name"])
			
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["new_screenshot"]["tmp_name"]);
				if($check !== false) {
					//echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "Votre fichier n'est pas une image.<br>";
					$uploadOk = 0;
				}
			}
			// Make triple extra sure the filename isn't taken
			while (file_exists($target_file)) {
				$target_file = $target_dir . generateUniqueFilename() . "." . end($tmp);
			}
			
			// Check file size
			if ($_FILES["new_screenshot"]["size"] > 300000) {
				echo "Votre fichier est trop lourd.<br>";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
				echo "Seuls les fichiers de type JPG, JPEG ou PNG sont acceptés.<br>";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Votre fichier n'a pas pu être uploadé.<br>";
			// if everything is ok, try to upload file
			} else {
				
				/*****************************************************************
				**********UPLOAD APPROUVE, LE CODE SUIVANT L'UPLOAD EST ICI*******
				*****************************************************************/
				if (move_uploaded_file($_FILES["new_screenshot"]["tmp_name"], $target_file)) {
					
					echo "Le fichier ". basename( $_FILES["new_screenshot"]["name"]). " a été uploadé. <br>";
					
					$cat = $_POST['category'];
					// s'assure qu'on insère des apostrophes doublées pour que le SQL les interprète comme des apostrophes simples
					$a1 = str_replace("'", "''",$_POST['tanswer']);
					$a2 = str_replace("'", "''",$_POST['wanswer1']);
					$a3 = str_replace("'", "''",$_POST['wanswer2']);
					$a4 = str_replace("'", "''",$_POST['wanswer3']);
					
					$sql = "INSERT INTO screentest.Question(image, answer0, answer1, answer2, answer3, cat_id) VALUES ('$target_file', '$a1', '$a2', '$a3', '$a4', '$cat')";
					$connec->query($sql);
					
					// pour les tests on enlève le fichier après coup
					//unlink($target_file);
					//echo "Le fichier ". basename( $_FILES["new_screenshot"]["name"]). " a été subséquement viré parce que enlever des tonnes d'images de Maître Capello en boucle c'est pas mon idée du fun (virer la fonctionnalité après). <br>";
					
				} else {
					echo "Désolé, il y a eu une erreur lors de l'upload de votre fichier, celui-ci n'a pas pu être mis en ligne.<br>";
				}
			}
			// le PDO est automatiquement fermé
		  }
	  }
	  ?></p>
	</center>
	
	<footer>
	<p>Website created by Grégoire Labasse (#6607969)</p>
	</footer>
  </body>
</html>