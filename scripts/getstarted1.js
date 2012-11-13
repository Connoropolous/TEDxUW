
var canvas = document.getElementById('Surface');
var ctx = canvas.getContext('2d');

ASSET_MANAGER.downloadAll(function() {
	  		$('#game').css('display','block');
	  		//$('#game').css('background', 'url(images/LoopStream_peters2.png) no-repeat top left');
	  		game.init(ctx);
	  		WelcomeScreen();
		});

var frm,inp1Label,inp,sbmt;
var createCloud;

// variables for the form which will submit to the database if they click donate
var formId, UserSubmitForm, usercloud, useredge, username, useremail, photoPermission, photoPermissionLabel, userSubmit;

// variable which will be passed to the rearrange words screen
var collectedWords;

var addTheConcepts = new Array(8);
for (var i = 1; i < 9; i++) {
	addTheConcepts[i - 1] = eval("var concept"+(i));
}

//
// Section for defining the hidden User Submit form
	UserSubmitForm=document.createElement('form');
	UserSubmitForm.setAttribute('name','wholeForm');
	UserSubmitForm.setAttribute('method','POST');
	UserSubmitForm.setAttribute('action','/formtools/process.php');
	UserSubmitForm.setAttribute('class', 'myform');
	UserSubmitForm.setAttribute('id','finalUser');
	UserSubmitForm.setAttribute('autocomplete','off');
	
	
	formId=document.createElement('input');
	formId.setAttribute('name','form_tools_form_id');
	formId.setAttribute('type','hidden');
	formId.setAttribute('id','formIdHidden');
	formId.setAttribute('value','1');
	
	usercloud=document.createElement('input');
	usercloud.setAttribute('name','usercloud');
	usercloud.setAttribute('type','text');
	usercloud.setAttribute('id','formUsercloudHidden');
	usercloud.setAttribute('class','input');
	
	for (var i = 1; i < 9; i++) {
		addTheConcepts[i -1]=document.createElement('input');
		addTheConcepts[i -1].setAttribute('name','concept'+(i));
		addTheConcepts[i -1].setAttribute('type','text');
		addTheConcepts[i -1].setAttribute('id','formconcept'+(i)+'Hidden');
	}
	
	useredge=document.createElement('input');
	useredge.setAttribute('name','useredge');
	useredge.setAttribute('type','text');
	useredge.setAttribute('id','formUseredgeNotHidden');
	useredge.setAttribute('placeholder',"What's your edge?");
	useredge.setAttribute('class','input');
	
	username=document.createElement('input');
	username.setAttribute('name','username');
	username.setAttribute('type','text');
	username.setAttribute('id','formUsernameNotHidden');
	username.setAttribute('placeholder','Enter your name...');
	username.setAttribute('class','input');
	
	useremail=document.createElement('input');
	useremail.setAttribute('name','useremail');
	useremail.setAttribute('type','text');
	useremail.setAttribute('id','formUseremailHidden');
	useremail.setAttribute('class','input');
	
	photoPermission=document.createElement('input');
	photoPermission.setAttribute('name','photoPermission');
	photoPermission.setAttribute('type','checkbox');
	photoPermission.setAttribute('id','formPhotoPermissionHidden');
	
	userSubmit=document.createElement('input');
	userSubmit.setAttribute('name','finalSubmit');
	userSubmit.setAttribute('type','submit');
	userSubmit.setAttribute('class', 'submit');
	userSubmit.setAttribute('value','Submit!');
	userSubmit.setAttribute('id','formSubmitNotHidden');

	UserSubmitForm.appendChild(formId);
	UserSubmitForm.appendChild(usercloud);
	UserSubmitForm.appendChild(addTheConcepts[0]);
	UserSubmitForm.appendChild(addTheConcepts[1]);
	UserSubmitForm.appendChild(addTheConcepts[2]);
	UserSubmitForm.appendChild(addTheConcepts[3]);
	UserSubmitForm.appendChild(addTheConcepts[4]);
	UserSubmitForm.appendChild(addTheConcepts[5]);
	UserSubmitForm.appendChild(addTheConcepts[6]);
	UserSubmitForm.appendChild(addTheConcepts[7]);
	UserSubmitForm.appendChild(useredge);
	UserSubmitForm.appendChild(username);
	UserSubmitForm.appendChild(useremail);
	UserSubmitForm.appendChild(photoPermission);
	UserSubmitForm.appendChild(userSubmit);
     
 
 //
 //  WELCOME SCREEN SECTION

function WelcomeScreen() {
	
		$('#email').bind('touchstart', function() {
			$('#email').css('background-position','0px 0px');
		});
		$('#email').bind('touchend', function() {
			$('#email').css('background-position','0px -150px');
		});
			  
	    // draw the background image
		//ctx.drawImage(ASSET_MANAGER.getAsset('images/LoopStream_peters2.png'), 0, 0, 1024, 568);	
		
		// don't let them proceed unless they enter a valid email.
		$("#myform").validate({
			debug: false,
			rules: {
				email: "required",
			},
			messages: {
				email: "Enter a valid email.",
			},
			submitHandler: function(form) {
				game.start();
				
				var i = 0;
				var tempquery1 = $('#form1input').attr('value');
				useremail.setAttribute('value',tempquery1);
				
				var tempquery2 = $('#form1checkbox').attr('checked');
				if ( tempquery2 === "checked" )  {
					photoPermission.setAttribute('checked',tempquery2);
				}
								
				$('#formDiv').html("<h2 class='red'>Welcome to the Word Stream</h2><div class='instr'>Here's your instructions...</div>");
				$('#formDiv .instr').html("Here's your instructions...");
				setTimeout (function() { 
					$('#formDiv .instr').html("In a moment, you'll be able to tap or drag the red X around the screen...");
					setTimeout (function() { 
						$('#formDiv .instr').html("As you move, pick up words that resonate with your successes or potential...");
						setTimeout (function() { 
							$('#formDiv .instr').html("...by hovering over their red dot. Avoid words you don't like!");
							setTimeout (function() { 
								$('#formDiv .instr').html("You have to grab 8 words. But take your time, and use your intuition!");
								setTimeout (function() { 
									$('#formDiv .instr').html("Have fun!");
									setTimeout (function() { 
										$('#formDiv').html("");
										$('#formDiv').css('display','none');
										mouseCanMove = true;
									}, 2000);
								}, 4000);
							}, 4000);
						}, 4000);
					}, 4000);
				}, 4000);
				
				//don't reload the page. stop that default event
				return false;
					
			}
		});
	
}


function f() {
     return false;
}