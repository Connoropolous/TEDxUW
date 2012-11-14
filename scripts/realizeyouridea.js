//
//
// A-HA! SECTION
		createCloud=document.createElement('button');
		createCloud.setAttribute('class','submit');
		createCloud.setAttribute('value','submit');
		createCloud.setAttribute('onclick','createEdge()');
		
		
		var usercloudVal;
		var stage;
				
function organizeCloud() {	
		gameFinished = true;
        mouseCanMove = false;
		
		$('#Surface').remove();
		arrangeWords(collectedWords);
		
		$('#formDiv').css('display','block');
		
		$("#formDiv").html("<img src='/images/Canvas_instruction.png' class='canvasInstr' />");
		$('.canvasInstr').animate({ opacity:0.8 },2000).delay(7000).animate({ opacity:0.0 },2000, function() { $('#formDiv').html(""); document.getElementById('formDiv').appendChild(createCloud); });
}
	
function createEdge() {
	
	stage.toDataURL({
	  callback: function(dataUrl){
		usercloudVal = dataUrl;
		usercloud.setAttribute('value',dataUrl);
		$('#container').remove();
	    createCloud.setAttribute('onclick','finalize()');
		$("#formDiv").html("<h2 class='red'>What's Your Edge?</h2>Reflect on your canvas and describe what gives you an edge.<img src='" + usercloudVal + "' class='edgecloud' width='500' height='300' />");
		document.getElementById('formDiv').appendChild(createCloud);
		document.getElementById('formDiv').appendChild(UserSubmitForm);
	  },
	  mimeType: 'image/png',
	  quality: 0.8
	});
	
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

function finalize() {
	document.getElementById('formDiv').removeChild(createCloud);
	$('#finalUser .submit').css('display','block');
	$('#formUseredgeNotHidden').fadeOut('fast', function() {
		$('#formUsernameNotHidden').fadeIn('fast');
	});
}