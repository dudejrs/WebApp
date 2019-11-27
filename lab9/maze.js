/* CSE3026 : Web Application Development
 * Lab 09 - Maze
 */

"use strict";

var loser = null;  // whether the user has hit a wall

window.onload = function() {

$("end").addEventListener('mouseover',overEnd);

$("start").addEventListener('click',startClick);


};

// called when mouse enters the walls; 
// signals the end of the game with a loss
function overBoundary(event) {
	$$('.boundary').forEach(function(element){
			element.addClassName("youlose");
		});
	alert("you lose! :( ");
	$("status").innerHTML="you lose!";
	$('maze').removeEventListener('mouseleave',overBoundary);
	$$('.boundary').forEach(function(element){
	element.removeEventListener('mouseover', overBoundary);
	});
}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
	$$('.boundary').forEach(function(element){
		element.removeClassName("youlose");
	});
	$$('.boundary').forEach(function(element){
		element.addEventListener('mouseover', overBoundary);
	});
	// $('maze').addEventListener('mouseout',()=>{
	// 	console.log("out");
	// });
	$('maze').addEventListener('mouseleave',overBoundary);



	// $('maze').addEventListener('mousemove',overBody.bind($('maze')));
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
	alert("you win! :)");
	$("status").innerHTML="you win!";
	$('maze').removeEventListener('mouseleave',overBoundary);
	$$('.boundary').forEach(function(element){
	element.removeEventListener('mouseover', overBoundary);
	});
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
	// console.log(event.clientX);
	// if(event.clientX < this.getBoundingClientRect().left){
	// 	overBoundary();
	// }
}



