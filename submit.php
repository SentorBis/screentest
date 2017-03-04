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
          <option value="1">Film</option>
          <option value="2">Série</option>
          <option value="3">Jeu vidéo</option>
          <option value="4">Dessin animé</option>
        </select></p>
		
        <p><label>Bonne réponse (origine du screenshot) :</label><br/>
		<input type="text" name="tanswer" placeholder="Enter correct answer" maxlength="10"></p>
		<p><label>Mauvaises réponses (essayer de donner des mauvaises réponses crédibles) :</label><br/>
        <input type="text" name="wanswer1" placeholder="Enter a wrong answer" maxlength="10">
        <input type="text" name="wanswer2" placeholder="Enter a wrong answer" maxlength="10">
        <input type="text" name="wanswer3" placeholder="Enter a wrong answer" maxlength="10"></p>
        <p><button type="submit" name="submit">Soumettre</button></p>
      </form>
	  
	  <p><?php
		ini_set('display_errors',1);
		error_reporting(E_ALL | E_STRICT);
	  if(isset($_POST['submit'])) {
		  try {
				$connec = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=password');
		  } catch (PDOException $e) {
			  echo "Error : " . $e->getMessage() . "<br/><br/>";
			  echo "The application failed to connect to the database.<br/>";
			  die();
		  }
		  
		
		  if(isset($_POST['new_screenshot'])) {
			$file = $_POST['new_screenshot'];
			echo $file;
		  } else {
			  echo 'File not set';
		  }
		  
		  /*$img = fopen($file_name, 'r') or die("Cannot read image\n");
		  echo $file . ' : ' . filesize($file) . ' bytes.';*/
		  /*$data = fread($img, filesize($file));
		  $es_data = pg_escape_bytea($data);
		  fclose($img);
		  
		  $cat = $_POST['category'];
		  $a1 = $_POST['tanswer'];
		  $a2 = $_POST['wanswer1'];
		  $a3 = $_POST['wanswer2'];
		  $a4 = $_POST['wanswer3'];*/
		  
/*$img = fopen($file_name, 'r') or die("cannot read image\n");
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