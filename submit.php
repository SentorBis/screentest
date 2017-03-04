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
	  <form action="insert.php" method="post" enctype="multipart/form-data">
		<p><label>Screenshot (format JPG ou PNG, maximum 300Ko) :</label><br/>
	    <input type="file" name="new_screenshot" ></p>
		<p><label>Catégorie :</label><br/>
		<select name="my_select">
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
        <p><button type="submit">Soumettre</button></p>
      </form>
	</center>
	
	<footer>
	<p>Website created by Grégoire Labasse (#6607969)</p>
	</footer>
  </body>
</html>