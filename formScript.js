
function updateNote() {
	var texte = document.getElementById("noteSur20");
	var range = document.getElementById("note");
	
	texte.innerText = range.value;
}

function validateForm() {
	if (document.getElementById("professeur").value === "" || document.getElementById("professeur").value === "Choissez un Professeur pour ce créneau") {
		alert("Veuillez choisir un professeur.");
		return false;
	}
	return true;
}
