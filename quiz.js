// c'est plus simple de juste tout mettre là, on n'a de toute façon pas l'utilité de pouvoir générer deux instances de quiz dans une seule page
var category;
var currentQuestion;
var questions;
var score;
var totalQuestion;

/*var newQuiz = function ( questionArray ) {
	this.questions = questionArray;
	this.currentQuestion = 1;
	this.score = 0;
	this.category = questionArray[0];
	this.start = function() {
		document.getElementById("quiz").innerHTML = "<p>" + category + "</p>";
	};
}*/

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
			document.getElementById("titre").innerHTML = "Question " + currentQuestion + " (sur " + totalQuestion + ")";
			document.getElementById("score").innerHTML = "Score: " + score + " points";
		}
	};
	xhttp.open("GET", "getQuestion.php?q="+qId, true);
	xhttp.send();
}

function answer( ans ) {
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
	getQuestion( questions[currentQuestion] );
}

// A AMELIORER POUR PRENDRE EN COMPTE LE TEMPS PRIS
function upScore() {
	var basepoints = 100;
	var modifier = 1;
	score += basepoints*modifier;
}

function gotoQuiz( catChosen ) {
	document.getElementById("selectQuiz").style.display = 'none';
	document.getElementById("quiz").style.display = 'block';
	category = catChosen;
	score = 0;
	//document.write("Category = " + category);
}