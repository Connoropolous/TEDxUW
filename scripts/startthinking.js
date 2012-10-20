
var canvas = document.getElementById('Surface');
var ctx = canvas.getContext('2d');
var starters = [];

// iniitialize starters
starters.push("awe");
starters.push("inspire");
starters.push("enlighten");
starters.push("unexpected");
starters.push("intersections");
starters.push("compassion");
starters.push("jovial");
starters.push("flip flop");
starters.push("prosperity");
starters.push("silly");
starters.push("gregarious");
starters.push("Poutine");
starters.push("Ping Pong Ball");
starters.push("Shower");
starters.push("doctor");
starters.push("dental hygenist");
starters.push("treehouse");
starters.push("charisma");
starters.push("security");
starters.push("Oliver Twist");

starters.push("wrestling");
starters.push("middle east");
starters.push("naked");
starters.push("zombie");
starters.push("apocalypse");  // change
starters.push("spartan");
starters.push("bark");
starters.push("woof");
starters.push("cow");
starters.push("buzz");
starters.push("snore");
starters.push("sneeze");
starters.push("religion");
starters.push("snorkel");
starters.push("skip");
starters.push("oil");
starters.push("burn");
starters.push("moonlight");
starters.push("bridge");

starters.push("random");
starters.push("orange");
starters.push("joke");
starters.push("ram");
starters.push("hockey");
starters.push("hero");
starters.push("villain");
starters.push("alien");
starters.push("dinosaur");
starters.push("las vegas");
starters.push("tiger");
starters.push("hybrid");
starters.push("obese");
starters.push("space");
starters.push("victory");
starters.push("palendrome");
starters.push("phone");
starters.push("keyboard");
starters.push("flinstones");
starters.push("digital");

starters.push("game");
starters.push("search engine");
starters.push("Hong Kong");
starters.push("Batman");
starters.push("grizzly bear");
starters.push("television");
starters.push("internet");
starters.push("school");
starters.push("otter");
starters.push("museum");
starters.push("art");
starters.push("culture");
starters.push("BP");
starters.push("exclamation");
starters.push("Michael Jackson");
starters.push("prescription");
starters.push("nose");
starters.push("globe"); // replace
starters.push("exit");
starters.push("sport");

starters.push("online");
starters.push("social media");
starters.push("disability");
starters.push("advantage");
starters.push("tennis");
starters.push("nothingness");
starters.push("Prada");
starters.push("teeth");
starters.push("Vampire");
starters.push("Twilight");
starters.push("Food");
starters.push("vegetarian");
starters.push("Vikings");
starters.push("lunch");
starters.push("drug");
starters.push("politics");
starters.push("iphone");
starters.push("Star Trek");
starters.push("faith");
starters.push("futurism");

$(document).ready(function(){
	
});

ASSET_MANAGER.downloadAll(function() {
	  		$('#game').css('display','block');
	  		$('#game').css('background', 'url(images/LoopStream_peters.png) no-repeat top left');
	  		game.init(ctx);
	  		WelcomeScreen();
		});

var frm,inp1Label,inp,sbmt;
var frm2,inp2Label,inp2,sbmt2;

// variables for the form which will submit to the database if they click donate
var formId, IdeaSubmitForm,query,idea,username, useremail, useremailPermission, userEmailPermissionLabel, ideaSubmit;

var addTheConcepts = new Array(8);
for (var i = 1; i < 9; i++) {
	addTheConcepts[i - 1] = eval("var concept"+(i));
}

// the Google Plusone 
var po;


//
// Section for defining the hidden Idea Submit form
	IdeaSubmitForm=document.createElement('form');
	IdeaSubmitForm.setAttribute('name','wholeForm');
	IdeaSubmitForm.setAttribute('method','POST');
	IdeaSubmitForm.setAttribute('action','/formtools/process.php');
	IdeaSubmitForm.setAttribute('class', 'myform');
	IdeaSubmitForm.setAttribute('id','finalIdea');
	IdeaSubmitForm.setAttribute('autocomplete','off');
	
	
	formId=document.createElement('input');
	formId.setAttribute('name','form_tools_form_id');
	formId.setAttribute('type','hidden');
	formId.setAttribute('id','formIdHidden');
	formId.setAttribute('value','1');
	
	query=document.createElement('input');
	query.setAttribute('name','query');
	query.setAttribute('type','text');
	query.setAttribute('id','formQueryNotHidden');
	query.setAttribute('class','input');
	
	for (var i = 1; i < 9; i++) {
		addTheConcepts[i -1]=document.createElement('input');
		addTheConcepts[i -1].setAttribute('name','concept'+(i));
		addTheConcepts[i -1].setAttribute('type','text');
		addTheConcepts[i -1].setAttribute('id','formconcept'+(i)+'Hidden');
	}
	
	idea=document.createElement('input');
	idea.setAttribute('name','idea');
	idea.setAttribute('type','text');
	idea.setAttribute('id','formIdeaNotHidden');
	idea.setAttribute('placeholder','Enter the idea you want to submit... ');
	idea.setAttribute('class','input');
	
	username=document.createElement('input');
	username.setAttribute('name','username');
	username.setAttribute('type','text');
	username.setAttribute('id','formUsernameNotHidden');
	username.setAttribute('placeholder','Enter your name...');
	username.setAttribute('class','input');
	
	useremail=document.createElement('input');
	useremail.setAttribute('name','useremail');
	useremail.setAttribute('type','text');
	useremail.setAttribute('id','formUseremailNotHidden');
	useremail.setAttribute('placeholder','Enter your email...');
	useremail.setAttribute('class','input');
	
	useremailPermission=document.createElement('input');
	useremailPermission.setAttribute('name','useremailPermission');
	useremailPermission.setAttribute('type','checkbox');
	useremailPermission.setAttribute('id','formUseremailPermissionNotHidden');
	useremailPermission.setAttribute('value','agree');
	
	useremailPermissionLabel=document.createElement('label');
	var quickText = document.createTextNode("I want to receive news from THEMUSEUM");
	useremailPermissionLabel.setAttribute('for','formUseremailPermissionNotHidden');
	useremailPermissionLabel.appendChild(quickText);
	
	ideaSubmit=document.createElement('input');
	ideaSubmit.setAttribute('name','finalSubmit');
	ideaSubmit.setAttribute('type','submit');
	ideaSubmit.setAttribute('class', 'donate');
	ideaSubmit.setAttribute('value','Donate');
	ideaSubmit.setAttribute('id','formSubmitNotHidden');

	IdeaSubmitForm.appendChild(formId);
	IdeaSubmitForm.appendChild(query);
	IdeaSubmitForm.appendChild(addTheConcepts[0]);
	IdeaSubmitForm.appendChild(addTheConcepts[1]);
	IdeaSubmitForm.appendChild(addTheConcepts[2]);
	IdeaSubmitForm.appendChild(addTheConcepts[3]);
	IdeaSubmitForm.appendChild(addTheConcepts[4]);
	IdeaSubmitForm.appendChild(addTheConcepts[5]);
	IdeaSubmitForm.appendChild(addTheConcepts[6]);
	IdeaSubmitForm.appendChild(addTheConcepts[7]);
	IdeaSubmitForm.appendChild(idea);
	IdeaSubmitForm.appendChild(username);
	IdeaSubmitForm.appendChild(useremail);
	IdeaSubmitForm.appendChild(useremailPermission);
	IdeaSubmitForm.appendChild(useremailPermissionLabel);
	IdeaSubmitForm.appendChild(ideaSubmit);
     
 
 //
 //  WELCOME SCREEN SECTION

function WelcomeScreen() {

		ctx.drawImage(ASSET_MANAGER.getAsset('images/LoopStream_peters.png'), 0, 0, 1024, 568);
			
		var word1FromArray = Math.floor(Math.random()*starters.length);
		var tempVal1 = starters[word1FromArray];
		var word2FromArray = Math.floor(Math.random()*starters.length);
		var tempVal2 = starters[word2FromArray];
		var word3FromArray = Math.floor(Math.random()*starters.length);
		var tempVal3 = starters[word3FromArray];
		inp = document.getElementById('form1input');
		inp.setAttribute('placeholder','Separate keywords by commas. e.g. ' + tempVal1 + ', ' + tempVal2 + ', ' + tempVal3);
		
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
				question: "required",
			},
			messages: {
				question: "Enter at least two keywords to think about.",
			},
			submitHandler: function(form) {
				runQuery(); 
				return f();	
			}
		});
								
		$(".modalInput").overlay();
		
		$('#think').mousedown(function() {
  			$('#think').css('margin-top','3px');
		});
		$('#game').mouseup(function() {
  			$('#think').css('margin-top','0px');
		});
		
		$('#helpBox1').delay(1000).fadeIn('slow', 
			function(){});
	
}


function runQuery() {
	
	game.start();
	mouseCanMove = true;
	
	var logo = document.getElementById('bigLogo');
	document.getElementById('gameTitleDiv').removeChild(logo);
	
	
	var i = 0;
	var tempquery = document.forms["questionForm"]["question"].value;
	query.setAttribute('value',tempquery);
	
	document.getElementById('formDiv').innerHTML = '';
	$('#formDiv').css('display','none');
	
	var word4FromArray = Math.floor(Math.random()*starters.length);
	var tempVal4 = starters[word4FromArray];
	
	tempquery = tempquery.split(", ");
			
	console.log(tempquery.length);		
			
	function myLoop () {           //  create a loop function
  		 setTimeout(function () {   
  		    if (i < tempquery.length) {           
   		      strload(tempquery[i]); 
			  i++;
			  myLoop();            
  		    }
			else if (i == tempquery.length) {           
   		      strload(tempVal4);           
  		    }		
  		 }, 600)
	}
	
	myLoop();
}

function f() {
     return false;
}   