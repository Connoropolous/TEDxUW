// JavaScript Document

function donate() {
	
	notDonate = false;
	
	$('#timeline').animate({backgroundPosition: '605px 0px'});
	
	var tempidea = document.forms["ideaForm"]["idea"].value;
	idea.setAttribute('value',tempidea);
	document.getElementById('formDiv').removeChild(frm2);
	var tempfrm = document.getElementById('formDiv');
	document.getElementById('game').removeChild(tempfrm);
	
	$("#explainDonate").html("See how your donation will make an impact:<br><br>$5 ensures THEMUSEUM will continue to awe, inspire and enlighten visitors through quality programming and exhibits. <br><br> $10 makes sure Ben can join his class on a field trip to THEMUSEUM through subsidized admission <br><br> $17 buys local, organic ingredients to make a fresh pot of soup for Monday's lunch at Cafe M. <br><br> $25 will buy enough foam bricks to build a tower reaching the 2nd floor. <br><br> $41 equals enough craft supplies for 25 families like Grandma June and her granddaughter Isabelle to bond every week over the tot-time craft. <br><br> $89 fills a transport truck with enough gas to ship memorabilia from the Hockey Hall of Fame for our upcoming exhibit ARENA| The Art of Hockey from Toronto to THEMUSEUM in downtown Kitchener.<br><br> $120 buys a Family Membership for a new immigrant family to integrate them into their new home in Waterloo Region.");

	$("#donateForm").html("To add your unique idea to the Ocean of Ideas, please donate to THEMUSEUM!");
	document.getElementById('donateForm').appendChild(IdeaSubmitForm);
	
	$('#explainDonate').css('display','block');

	$("#gameTitleDiv").fadeIn('slow', function(){});
	
	$("#finalIdea").validate({
			debug: false,
			rules: {
				username: "required",
				useremail: {
					required: true,
					email: true
				}
			},
			messages: {
				username: "Put in a name to submit your idea by.",
				useremail: "A valid email will help us get in touch with you.",
			},
			submitHandler: function(form) {
				// do other stuff for a valid form
				$('#timeline').animate({backgroundPosition: '805px 0px'});
				myWindow = window.open('http://streme.ca/donate.htm', 'width=500, height=500', 'target=_blank');
				document.getElementById('finalIdea').submit();		
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