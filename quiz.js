// c'est plus simple de juste tout mettre là, on n'a de toute façon pas l'utilité de pouvoir générer deux instances de quiz dans une seule page
var category;
var currentQuestion;
var questions;
var score;
var totalQuestion;
var answered;

function startQuiz( questionArray ) {
	questions = questionArray;
	category = questionArray[0];
	currentQuestion = 1;
	totalQuestion = questionArray.length - 1;
	score = 0;
	getQuestion( questions[currentQuestion] );
}

function getQuestion( qId ){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("quiz").innerHTML = this.responseText;
			answered = false;
			document.getElementById("titre").innerHTML = "Question " + currentQuestion + " (sur " + totalQuestion + ")";
			document.getElementById("score").innerHTML = "Score: " + score + " points";
		}
	};
	xhttp.open("GET", "getQuestion.php?q="+qId, true);
	xhttp.send();
}

function answer( ans ) {
	if (!answered) {
		answered = true;
		if ( ans != 'A' ) {
			document.getElementById(ans).style.background = "red";
			document.getElementById(ans).style.background = "-webkit-linear-gradient(red, indianred)";
			document.getElementById(ans).style.background = "-o-linear-gradient(red, indianred)";
			document.getElementById(ans).style.background = "-moz-linear-gradient(red, indianred)";
			document.getElementById(ans).style.background = "linear-gradient(red, indianred)";
			document.getElementById(ans).style.border = "indianred solid 1px;"
		}	
		document.getElementById('A').style.background = "lightgreen";
		document.getElementById('A').style.background = "-webkit-linear-gradient(lightgreen, green)";
		document.getElementById('A').style.background = "-o-linear-gradient(lightgreen, green)";
		document.getElementById('A').style.background = "-moz-linear-gradient(lightgreen, green)";
		document.getElementById('A').style.background = "linear-gradient(lightgreen, green)";
		document.getElementById('A').style.border = "green solid 1px;"
		
		if (ans == 'A') {
			upScore();
			document.getElementById("score").innerHTML = "Score: " + score + " points";
		}
		currentQuestion++;
		
		if (currentQuestion <= totalQuestion) {
			getQuestion( questions[currentQuestion] );
		} else {
			omedetou();
		}
	}
}

function omedetou() {
	if (score > 0) {
		document.getElementById("quiz").innerHTML = "<h1>Félicitations, votre score est de " + score + " points !</h1>" +
			"<p><form action=\"quiz.php\" method=\"post\"><button type=\"submit\" name=\"chose(" + category + ")\">Réessayer un quiz de cette catégorie</button></form></p>" +
			"<p><form action=\"quiz.php\" method=\"get\"><button type=\"submit\">Tenter un quiz d'une autre catégorie</button></form></p>";
	} else {
		document.getElementById("quiz").innerHTML = "<h1>Votre score est de " + score + " points, et à votre place je serais pas trop fier franchement.</h1>\n" +
			"<p>(mais c'est pas grave hein, on a tous nos qualités et nos défauts, c'est juste que votre qualité, c'est visiblement pas la culture...)</p>\n" +
			"<p><form action=\"quiz.php\" method=\"post\"><button type=\"submit\" name=\"chose(" + category + ")\">Réessayer un quiz de cette catégorie</button></form></p>" +
			"<p><form action=\"quiz.php\" method=\"get\"><button type=\"submit\">Tenter un quiz d'une autre catégorie</button></form></p>";
	}
}

// A AMELIORER POUR PRENDRE EN COMPTE LE TEMPS PRIS
function upScore() {
	var basepoints = 100;
	var modifier = 1;
	score += basepoints*modifier;
}