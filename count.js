function setCountdown( delay ) {
	var count = new Date();
	count.setSeconds(count.getSeconds() + delay + 1);
	return count;
}

var countDownDate = setCountdown(15);

// Code emprunté à W3Schools et adapté pour ce timer
var count = setInterval(function() {

    var now = new Date().getTime();
    
    var distance = countDownDate - now;
    
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
	if (seconds < 10) {
		document.getElementById("timer").innerHTML = "Temps restant: 0" + seconds + "s"; 
	} else {
		document.getElementById("timer").innerHTML = "Temps restant: " + seconds + "s"; 
	}
    
    if (distance < 0) {
        clearInterval(count);
        document.getElementById("timer").innerHTML = "On passe à la question suivante (placeholder text)";
    }
}, 500);

function countReset() {
	countDownDate = setCountdown(15);
	count();
	document.write("counting");
}