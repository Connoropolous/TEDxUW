// JavaScript Document

function donate() {
	
	notDonate = false;
		
	var tempidea = document.forms["ideaForm"]["idea"].value;
	useredge.setAttribute('value',tempidea);
	document.getElementById('formDiv').removeChild(frm2);
	var tempfrm = document.getElementById('formDiv');
	document.getElementById('game').removeChild(tempfrm);

	$("#donateForm").html("Something...");
	document.getElementById('donateForm').appendChild(UserSubmitForm);
	
	$('#explainDonate').css('display','block');

	$("#gameTitleDiv").fadeIn('slow', function(){});
	
	$("#finalUser").validate({
			debug: false,
			rules: {
				username: "required",
			},
			messages: {
				username: "Put in a name to submit your idea by.",
			},
			submitHandler: function(form) {
				// do other stuff for a valid form
				$('#timeline').animate({backgroundPosition: '805px 0px'});
				document.getElementById('finalUser').submit();		
			}
		});
		
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

}