//
//
// A-HA! SECTION
		frm2=document.createElement('form');
		frm2.setAttribute('name','ideaForm');
		frm2.setAttribute('method','GET');
		frm2.setAttribute('action','/');
		frm2.setAttribute('class', 'myform');
		frm2.setAttribute('autocomplete','off');
		frm2.setAttribute('id','ahaForm');		
		
		inp2=document.createElement('input');
		inp2.setAttribute('name','idea');
		inp2.setAttribute('type','text');
		inp2.setAttribute('class','input');
		
		inp2Label=document.createElement('p');
		inp2Label.appendChild(document.createTextNode('This inspires me to think...'));
		
		sbmt2=document.createElement('input');
		sbmt2.setAttribute('name', 'ideaSubmit');
		sbmt2.setAttribute('type','submit');
		sbmt2.setAttribute('class', 'submit');
		sbmt2.setAttribute('value',"A-Ha!");
		sbmt2.setAttribute('id',"aha");
		   
		frm2.appendChild(inp2Label);
		frm2.appendChild(inp2);
		frm2.appendChild(sbmt2);
		
	function realizeIt() {	
		gameFinished = true;
        mouseCanMove = false;
		$('#timeline').animate({backgroundPosition: '395px 0px'});
		document.getElementById('formDiv').appendChild(frm2);
		
		$("#ahaForm").validate({
			debug: false,
			rules: {
				idea: "required",
			},
			messages: {
				idea: "What's your idea?",
			},
			submitHandler: function(form) {
				donate(); 
				return f(); 	
			}
		});
		
		$('#formDiv').fadeIn('slow', function(){});
		
		$('#aha').mousedown(function() {
  			$('#aha').css('margin-top','3px');
		});
		$('#game').mouseup(function() {
  			$('#aha').css('margin-top','0px');
		});
		
	}