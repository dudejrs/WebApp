window.onload = function() {
    $("b_xml").onclick=function(){
    	    // construct a Prototype Ajax.request object
    	    // console.log("click");
    	    new Ajax.Request("books.php",{
    	    	method : "GET",
    	    	parameters : { category : getCheckedRadio($$("input")) },
    	    	onSuccess: showBooks_XML,
    	    	onFailure : ajaxFailed,
    	    	onException : ajaxFailed
    	    });
    }
    $("b_json").onclick=function(){
    	    //construct a Prototype Ajax.request object
    	    new Ajax.Request("books_json.php",{
    	    	method : "GET",
    	    	parameters : {category : getCheckedRadio($$("input"))},
    	    	onSuccess : showBooks_JSON,
    	    	onFailure : ajaxFailed,
    	    	onException : ajaxFailed
    	    })
    }
};

function getCheckedRadio(radio_button){
	for (var i = 0; i < radio_button.length; i++) {
		if(radio_button[i].checked){
			return radio_button[i].value;
		}
	}
	return undefined;
}

function showBooks_XML(ajax) {
	var respond = ajax.responseXML;
	var books = respond.getElementsByTagName("book");
	var container = $("books");
	var containerItem = $$("#books > li");

	containerItem.forEach( (element)=>{
		container.removeChild(element);
	});
	for(var i=0; i<books.length;i++){
		var newItem = document.createElement("li");

		var newItem_text = books[i].getElementsByTagName("title")[0].firstChild.nodeValue+", by ";
		newItem_text += books[i].getElementsByTagName("author")[0].firstChild.nodeValue+" (";
		newItem_text += books[i].getElementsByTagName("year")[0].firstChild.nodeValue+")";

		newItem.appendChild(document.createTextNode(newItem_text));
		container.appendChild(newItem);
	};

}

function showBooks_JSON(ajax) {
	var respond = JSON.parse(ajax.responseText);
	var container = $("books");
	var containerItem = $$("#books > li");
	containerItem.forEach( (element)=>{
		container.removeChild(element);
	});
	for(var  i=0; i<respond.books.length;i++){
		var newItem = document.createElement("li");
		var newItem_text = respond.books[i].title+", by ";
		newItem_text += respond.books[i].author+" (";
		newItem_text += respond.books[i].year+")";

		newItem.appendChild(document.createTextNode(newItem_text));
		container.appendChild(newItem);

	}
}

function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + 
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}
