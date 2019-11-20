

const helloWorld = function(){
	const text = $("Text");
	alert("Hello, World");
	// $("Text").style.fontSize= "24pt"

	setInterval(()=>{
		text.style.fontSize = (text.style.fontSize == "") ? "14pt" : parseInt(text.style.fontSize)+2+"pt";
	},500);

}

const handle_onChange = function(){
	const text = $("Text");
	alert("Change Text Style");
	text.style.fontWeight = ($("Bling").checked == true) ? "bold" : "none";
	text.style.color = ($("Bling").checked == true) ? "green" : "black";
	text.style.textDecoration = ($("Bling").checked == true) ? "underline" : "none";
};

const handle_snoopify = function(){
	const text= $("Text");
	text.value = text.value.toUpperCase();
	const text_value =  text.value.split(".");
	text.value = text_value.join("-izzle\n");
}