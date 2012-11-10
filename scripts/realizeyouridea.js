//
//
// A-HA! SECTION
		createCloud=document.createElement('button');
		createCloud.setAttribute('value','submit');
		createCloud.setAttribute('onclick','createEdge()');
		
		var dataUrl;
				
function organizeCloud() {	
		gameFinished = true;
        mouseCanMove = false;
		$("#formDiv").html("This is the page where you organize your cloud.");
		
		
		usercloud = canvas.toDataURL();
		
		document.getElementById('formDiv').appendChild(createCloud);
		
		$('#formDiv').fadeIn('slow', function(){});
}
	
function createEdge() {
		
	alert(usercloud); 

	window.open(usercloud, "toDataURL() image", "width=600, height=200");	
		
	document.getElementById('formDiv').removeChild(createCloud);

	$("#formDiv").html("This is the page where you identify your edge.");
	document.getElementById('formDiv').appendChild(UserSubmitForm);
	
	$("#gameTitleDiv").fadeIn('slow', function(){});
	
	$("#finalUser").validate({
			debug: false,
			rules: {
				useredge: "required",
				username: "required",
			},
			messages: {
				useredge: "You need to add your edge.",
				username: "You need to add your name.",
			},
			submitHandler: function(form) {
				// do other stuff for a valid form
				document.getElementById('finalUser').submit();		
			}
		});

}