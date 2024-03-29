
// Tableaux constituer de margin, colors et degrés.
let random_margin = ["-5px", "1px", "5px", "10px", "7px"];
let random_colors = [
	'lightgoldenrodyellow',
	'lightblue',
	'lightgreen',
	'lightpink',
	'lightcoral',
	'lightskyblue',
	'lightsalmon',
	'plum',
	'lightseagreen'
];
let random_degree = [
	"rotate(3deg)",
	"rotate(1deg)",
	"rotate(-1deg)",
	"rotate(-3deg)",
	"rotate(-5deg)",
	"rotate(-8deg)",
];
let index = 0;

// Variable pour gerer le zoom du tableau AU CLICK

const tab = document.getElementById('set');
const img = document.getElementById('all_notes');


tab.addEventListener("dblclick", (e) => {
	const x = e.clientX - e.target.offsetLeft;
	const y = e.clientY - e.target.offsetTop;

	console.log(x,y);

	tab.style.transformOrigin = `${x}px ${y}px`;
	tab.style.transform = "scale(2)";
});

tab.addEventListener("mouseleave", () =>{
	tab.style.transformOrigin = "center";
	tab.style.transform = "scale(1)";
})




document.onmousedown = clearMenus;

window.onload = document.querySelector("#user_input").select();

// The button that manages the creation of post-its
document.querySelector(".add_note").addEventListener("click", () => {
	document.querySelector("#modal").style.display = "block";
	document.getElementById("user_input").style.width = "276px";
	document.getElementById("user_input").style.height = "276px";
	document.getElementById("user_input").style.fontSize = "20px";

});

// Le button qui supprime l'ajout du post-it
document.querySelector("#hide").addEventListener("click", () => {
	document.querySelector("#modal").style.display = "none";
	document.getElementById("user_input").value = '';
	document.getElementById("user_input").style.fontWeight = "normal";
	document.getElementById("user_input").style.textAlign = "left";
	document.getElementById("user_input").style.fontStyle = "normal";
	document.getElementById("user_input").style.textTransform = "capitalize";
});


// Le button qui valide post-it
document.querySelector("#check-icon").addEventListener("click", () => {
  const text = document.querySelector("#user_input");
  const style = getComputedStyle(text);
  createStickyNote(text.value, style);
  document.querySelector("#modal").style.display = "none";


});


// Allows to define our note to create
createStickyNote = (text, style) => {
	let note = document.createElement("div");
	note.className = "note";

	//Create the option button for the note
	let optionButton = document.createElement('button');
	optionButton.className = 'option-button';
	optionButton.onmousedown = noteMenu;
	let optionIcon = document.createElement('img');
	optionIcon.src = 'images/palette.svg';
	optionIcon.className = 'option-icon';
	optionButton.appendChild(optionIcon);
	note.appendChild(optionButton);

	// Create a delete button
	let deleteButton = document.createElement('button');
	deleteButton.className = 'delete-note';
	deleteButton.onmousedown = (() => {setTimeout(deleteNote.bind(deleteButton), 355);}); //Add a delay to let user see button press
	let deleteIcon = document.createElement('img');
	deleteIcon.src = 'images/trash.svg';
	deleteIcon.className = 'delete-icon';
	deleteButton.appendChild(deleteIcon);
	note.appendChild(deleteButton);



	let details = document.createElement("div");
	details.className = "details";
	note.appendChild(details);

	let noteText = document.createElement("textarea");
	noteText.textContent = text;

	document.getElementById("user_input").style.width = "70px";
	document.getElementById("user_input").style.height = "50px";
	document.getElementById("user_input").style.fontSize = "10px";

	noteText.style.width = style.width
	noteText.style.height = style.height
	noteText.style.fontSize = style.fontSize

	noteText.style.fontWeight = style.fontWeight
	noteText.style.fontStyle = style.fontStyle
	noteText.style.textAlign = style.textAlign
	noteText.style.textTransform = style.textTransform

	details.appendChild(noteText);

	if (index > random_colors.length - 1)
		index = 0;

	// Allows you to define a random margin colors and degrees.
	note.setAttribute("style", `background-color:${random_colors[index++]}; 
	transform:${random_degree[Math.floor(Math.random() * random_degree.length)]}; 
	position: absolute`);
	// margin:${random_margin[Math.floor(Math.random() * random_margin.length)]};


	// Allows you to move the post-its
	$(note).draggable({stack: "#set div"});


	// Allows mouse over to enlarge the post-it
	note.addEventListener("mouseenter", function () {
		note.style.transform = "scale(1.2)";
	});

	// Allows the mouse to shrink the post-it
	note.addEventListener("mouseleave", function () {
		note.style.transform = "scale(1)";
	});


	document.querySelector("#all_notes").appendChild(note);

	// Allows you to erase the text and the style once the post-it is validated.
	document.getElementById("user_input").value = '';
	document.getElementById("user_input").style.fontWeight = "normal";
	document.getElementById("user_input").style.textAlign = "left";
	document.getElementById("user_input").style.fontStyle = "normal";
	document.getElementById("user_input").style.textTransform = "capitalize";

	/**
	 * deleteNote deletes a note whose delete button has been pressed
	 */
	function deleteNote() {
		note.remove();
	}

}

// Zoom sur le tableau


/**
 noteMenu crée le menu des options de la note.
 */
function noteMenu() {
	let menus = document.getElementsByClassName('note-menu'); // Get all menus

	for (let i = 0; i < menus.length; i++) {
		menus[i].remove();
	}

	let noteMenu = document.createElement('div');
	noteMenu.className = "note-menu";

	let colors = [ // Nine different note colors
		'lightgoldenrodyellow',
		'lightblue',
		'lightgreen',
		'lightpink',
		'lightcoral',
		'lightskyblue',
		'lightsalmon',
		'plum',
		'lightseagreen'
	];

	// Create nine different color buttons
	colors.forEach(color => {
		let colorOption = document.createElement('button');
		colorOption.className = "color-option";
		colorOption.style.backgroundColor = color;
		colorOption.onmousedown = setColor;
		colorOption.ontouchstart = setColor;
		noteMenu.appendChild(colorOption);
	});
	this.parentNode.appendChild(noteMenu); // Add the menu to the note
}

/**
 * setColor sets the color of a note according to the button pressed.
 */
function setColor() {

	let note = this.parentNode.parentNode;
	let newColor = this.style.backgroundColor;

	note.style.backgroundColor = newColor;
}

/**
//  * clearMenus deletes all menus that the mouse does not hover over.
//  * @param {MouseEvent} event
//  */
function clearMenus(event) {
	console.log('Clear menus');
	console.log('ClientX: ' + event.clientX);
	console.log('ClientY: ' + event.clientY);

	let noteMenus = document.getElementsByClassName('note-menu'); // Get all menus

	for (let i = 0; i < noteMenus.length; i++){ // Loop through the menus
		let rect = noteMenus[i].getBoundingClientRect(); // Get the bounding rectangle to know the position

		// If the mouse is not above the menu, then remove it
		if (event.clientX < rect.left || event.clientX > rect.right || event.clientY < rect.top || event.clientY > rect.bottom) {
			if (noteMenus[i].id == 'active') { //Remove the note only on a second click to account for clicking the option button
				noteMenus[i].remove();
			} else {
				noteMenus[i].id = 'active';
			}//End else
		}//End if
	}//End for
}//End clearMenus


function f1() {
  //pour rendre le texte gras en utilisant la méthode DOM
  document.getElementById("user_input").style.fontWeight = "bold";
}

function f2() {
  //pour rendre le texte italique en utilisant la méthode DOM
  document.getElementById("user_input").style.fontStyle = "italic";
}

function f3() {
  //pour rendre l'alignement du texte à gauche en utilisant la méthode DOM
  document.getElementById("user_input").style.textAlign = "left";
}

function f4() {
  //pour centrer l'alignement du texte en utilisant la méthode DOM
  document.getElementById("user_input").style.textAlign = "center";
}

function f5() {
  //pour rendre l'alignement du texte correct en utilisant la méthode DOM
  document.getElementById("user_input").style.textAlign = "right";
}

function f6() {
  //pour rendre le texte en majuscules en utilisant la méthode DOM
  document.getElementById("user_input").style.textTransform = "uppercase";
}

function f7() {
  //pour rendre le texte en minuscules en utilisant la méthode DOM
  document.getElementById("user_input").style.textTransform = "lowercase";
}

function f8() {
  //pour mettre le texte en majuscule en utilisant la méthode DOM
  document.getElementById("user_input").style.textTransform = "capitalize";
}

function f9() {
  //pour que le texte redevienne normal en supprimant toutes les méthodes appliquées
	// en utilisant la méthode DOM
  document.getElementById("user_input").style.fontWeight = "normal";
  document.getElementById("user_input").style.textAlign = "left";
  document.getElementById("user_input").style.fontStyle = "normal";
  document.getElementById("user_input").style.textTransform = "capitalize";
  document.getElementById("user_input").value = " ";
}



