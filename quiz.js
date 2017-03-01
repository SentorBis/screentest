var category;

function gotoQuiz( catChosen ) {
	document.getElementById("selectQuiz").style.display = 'none';
	document.getElementById("quiz").style.display = 'block';
	category = catChosen;
	//document.write("Category = " + category);
}