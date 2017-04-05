// c'est plus simple de juste tout mettre là, on n'a de toute façon pas l'utilité de pouvoir générer deux instances de quiz dans une seule page
var category;
var currentQuestion;
var questions;
var score;
var totalQuestion;
var answered;
var countDownDate;
var TIMERSEC = 10;
var timerini = false;
var seconds;


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
			document.getElementById("score").innerHTML = "Score: <strong>" + score + " points</strong>";
			timerini = true;
			if (currentQuestion == 1) {
				countDownDate = setCountdown(TIMERSEC);
			} else countReset();
		}
	};
	xhttp.open("GET", "getQuestion.php?q="+qId, true);
	xhttp.send();
}

function answer( ans ) {
	if (!answered) {
		answered = true;
		timerini = false; // on arrête le timer
		if ( ans == '' ) {
			document.getElementById("timer").innerHTML = "<strong>Temps écoulé !</strong>"; 	
		} else if ( ans != 'A' ) {
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
			setTimeout(function() {
				getQuestion( questions[currentQuestion] );
			}, 1000);
		} else {
			setTimeout(function() {
				omedetou();
			}, 1000);
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

// Prend en compte le temps pris
function upScore() {
	var basepoints = 100;
	var modifier = 1;
	score += basepoints*seconds;
}

// COUNT.JS, ENFIN DANS LE GAME
// A DEBUGUER
function setCountdown( delay ) {
	var count = new Date();
	count.setSeconds(count.getSeconds() + delay + 1);
	return count;
}

// Code emprunté à W3Schools et adapté pour ce timer
var count = setInterval(function() {

    var now = new Date().getTime();
    
    var distance = countDownDate - now;
    
    seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
	if (timerini) {
		if (seconds < 10) {
			document.getElementById("timer").innerHTML = "Temps restant: <strong>0" + seconds + "s</strong>"; 
		} else {
			document.getElementById("timer").innerHTML = "Temps restant: <strong>" + seconds + "s</strong>"; 
		}
		
		if (distance < 0) {
			answer('');
		}
	}
}, 500);

function countReset() {
	countDownDate = setCountdown(TIMERSEC);
	count();
}