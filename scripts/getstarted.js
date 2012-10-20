
var canvas = document.getElementById('Surface');
var ctx = canvas.getContext('2d');

ASSET_MANAGER.downloadAll(function() {
	  		$('#game').css('display','block');
	  		$('#game').css('background', 'url(images/LoopStream_peters2.png) no-repeat top left');
	  		game.init(ctx);
	  		WelcomeScreen();
		});

var frm,inp1Label,inp,sbmt;
var frm2,inp2Label,inp2,sbmt2;

// variables for the form which will submit to the database if they click donate
var formId, UserSubmitForm, usercloud, useredge, username, useremail, photoPermission, photoPermissionLabel, userSubmit;

var addTheConcepts = new Array(8);
for (var i = 1; i < 9; i++) {
	addTheConcepts[i - 1] = eval("var concept"+(i));
}

// the Google Plusone 
var po;

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
	photoPermission.setAttribute('id','formPhotoPermissionNotHidden');
	photoPermission.setAttribute('value','agree');
	
	photoPermissionLabel=document.createElement('label');
	var quickText = document.createTextNode("TEDxUW can use my photo.");
	photoPermissionLabel.setAttribute('for','formPhotoPermissionNotHidden');
	photoPermissionLabel.appendChild(quickText);
	
	userSubmit=document.createElement('input');
	userSubmit.setAttribute('name','finalSubmit');
	userSubmit.setAttribute('type','submit');
	userSubmit.setAttribute('class', 'donate');
	userSubmit.setAttribute('value','Donate');
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
	UserSubmitForm.appendChild(photoPermissionLabel);
	UserSubmitForm.appendChild(userSubmit);
     
 
 //
 //  WELCOME SCREEN SECTION

function WelcomeScreen() {
	
		//ctx.drawImage(ASSET_MANAGER.getAsset('images/LoopStream_peters2.png'), 0, 0, 1024, 568);
		
		$('[placeholder]').focus(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
				  input.val('');
				  input.removeClass('placeholder');
				}
			  }).blur(function() {
				var input = $(this);
				if (input.val() == '' || input.val() == input.attr('placeholder')) {
				  input.addClass('placeholder');
				  input.val(input.attr('placeholder'));
				}
			  }).blur();
				
		
		$("#myform").validate({
			debug: false,
			rules: {
				email: "required",
			},
			messages: {
				email: "Enter a valid email.",
			},
			submitHandler: function(form) {
				 runQuery();
				return false;
					
			}
		});
	
}

function runQuery() {
	
	game.start();
    mouseCanMove = true;
	
	var i = 0;
	var tempquery = document.forms["emailForm"]["email"].value;
	useremail.setAttribute('value',tempquery);
	
	document.getElementById('formDiv').innerHTML = '';
	$('#formDiv').css('display','none');
						
}

function f() {
     return false;
}