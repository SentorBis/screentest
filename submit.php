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
	</ul>
	<center>
	  <h1>Soumettre un screenshot :</h1>
	  <form method="post" enctype="multipart/form-data">
	    <p><input type="file" name="new_screenshot" ></p>
		<p><select name="my_select">
          <option value="1">Film</option>
          <option value="2">Série</option>
          <option value="3">Jeu vidéo</option>
        </select></p>
        <p><input type="text" name="tanswer" placeholder="Enter correct answer" maxlength="10"></p>
        <p><input type="text" name="wanswer1" placeholder="Enter a wrong answer" maxlength="10"></p>
        <p><input type="text" name="wanswer2" placeholder="Enter a wrong answer" maxlength="10"></p>
        <p><input type="text" name="wanswer3" placeholder="Enter a wrong answer" maxlength="10"></p>
        <p><button type="submit">Soumettre</button></p>
      </form>
	</center>
	
	<footer>
	<p>Website created by Grégoire Labasse (#6607969)</p>
	</footer>
  </body>
</html>