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
	  <li><a class="active" href="index.php">Accueil</a></li>
	  <li><a href="quiz.php">Nouveau quiz</a></li>
	  <li><a href="submit.php">Proposer un screenshot</a></li>
	  <li><a href="about.html">A propos</a></li>
	  <li><a href="chrono.html">Test Javascript (dev)</a></li>
	  <li><a href="query.php">Test PHP + PostgreSQL (dev)</a></li>
	</ul>
	<center>
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
		// BUG : SEMBLE Y AVOIR UN PROBLEME AVEC LA BOUCLE ET L'USAGE DE $i
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
			  
			  /****************CONNECTION BASE DE DONNEES [FONCTIONNE]
			  try {
					$connec = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=password');
			  } catch (PDOException $e) {
				  echo "Error : " . $e->getMessage() . "<br/><br/>";
				  echo "The application failed to connect to the database.<br/>";
				  die();
			  }*/
			  
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
					echo "File is not an image.<br>";
					$uploadOk = 0;
				}
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				echo "Sorry, file already exists.<br>";
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["new_screenshot"]["size"] > 300000) {
				echo "Sorry, your file is too large.<br>";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
				echo "Sorry, only JPG, JPEG & PNG files are allowed.<br>";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Votre fichier n'a pas pu être uploadé.<br>";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["new_screenshot"]["tmp_name"], $target_file)) {
					echo "Le fichier ". basename( $_FILES["new_screenshot"]["name"]). " a été uploadé. <br>";
				} else {
					echo "Désolé, il y a eu une erreur lors de l'upload de votre fichier, celui-ci n'a pas pu être mis en ligne.<br>";
				}
			}
		  }
		  
		  //RAPPEL : l'image a été uploadée et son adresse est $target_file
		  
		  //A FAIRE : mettre l'upload à proprement parler à la fin
		  //A FAIRE : check nombre de caractères effectivement inputés (le dernier char ?)
		  
		  $cat = $_POST['category'];
		  $a1 = $_POST['tanswer'];
		  $a2 = $_POST['wanswer1'];
		  $a3 = $_POST['wanswer2'];
		  $a4 = $_POST['wanswer3'];
		  
/**************************TEMPLATE INSERTION IMAGE DB [?]
$img = fopen($file_name, 'r') or die("cannot read image\n");
$data = fread($img, filesize($file_name));

$es_data = pg_escape_bytea($data);
fclose($img);

$query = "INSERT INTO images(id, data) Values(1, '$es_data')";
pg_query($con, $query); 

pg_close($con); 
		  
		  
		  $sql = 'SELECT cat_id, cat_name, description FROM screentest.Category';
		  foreach ($connec->query($sql) as $row) {
			  print $row['cat_id'] . " ";
			  print $row['cat_name'] . "--> ";
			  print $row['description'] . "<br>";
		  }*/
	  }
	  ?></p>
	</center>
	
	<footer>
	<p>Website created by Grégoire Labasse (#6607969)</p>
	</footer>
  </body>
</html>