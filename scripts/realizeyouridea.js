//
//
// A-HA! SECTION
		createCloud=document.createElement('button');
		createCloud.setAttribute('class','submit');
		createCloud.setAttribute('value','submit');
		createCloud.setAttribute('onclick','createEdge()');
		
		ZoomWrapper=document.createElement('div');
		ZoomWrapper.setAttribute('id', 'zoomwrapper');
		
		
		var usercloudVal;
				
function organizeCloud() {	
		gameFinished = true;
        mouseCanMove = false;
		
		for (var i=1; i<=8; i++)
		{
			SpanText = document.createElement('span');
			SpanText.setAttribute('id', 'TED' + i);
			p = document.createElement('div');
			p.setAttribute('class', 'polaroid');
			p.appendChild(SpanText);
			zoomprops=document.createElement('div');
			zoomprops.setAttribute('id','zoom' + i);
			zoomprops.setAttribute('class','zoomProps');
			zoomprops.appendChild(p);
			ZoomWrapper.appendChild(zoomprops);
		}
		
		$('#game').prepend(ZoomWrapper);
		
		$(function(){
        var zoom = new ZoomView('#zoom1','#zoom1 :first');
		var zoom2 = new ZoomView('#zoom2','#zoom2 :first');
		var zoom3 = new ZoomView('#zoom3','#zoom3 :first');
		var zoom4 = new ZoomView('#zoom4','#zoom4 :first');
		var zoom5 = new ZoomView('#zoom5','#zoom5 :first');
		var zoom6 = new ZoomView('#zoom6','#zoom6 :first');
		var zoom7 = new ZoomView('#zoom7','#zoom7 :first');
		var zoom8 = new ZoomView('#zoom8','#zoom8 :first');
		});
		
		updatetextfromarray(collectedWords);
		
		$('#formDiv').css('display','block');
		
		$("#formDiv").html("<img src='/images/Canvas_instruction.png' class='canvasInstr' />");
		$('.canvasInstr').animate({ opacity:0.8 },2000).delay(7000).animate({ opacity:0 },2000, function() { $('#formDiv').html(""); document.getElementById('formDiv').appendChild(createCloud); });
}
	
function editNodeText(id, newText)
{
	var node = document.getElementById(id);
	
	while (node.firstChild)
		node.removeChild(node.firstChild);
	
	node.appendChild(document.createTextNode(newText));
	
	if (Math.random() > 0.5)
	{
		document.getElementById(id).style.color = "red";
	}
}
function updatetextfromarray(collected)
{
	for (var i=1;i<collected.length+1;i++)
	{
		var id = "TED" + i;
		editNodeText(id, collected[i-1]);
	}
}
	
function createEdge() {
	
	var html2obj = html2canvas($('body'));

	var queue  = html2obj.parse();
	var wordcloud = html2obj.render(queue);
	usercloudVal = wordcloud.toDataURL();
	usercloud.setAttribute('value',usercloudVal);
	
	$('#zoomwrapper').remove();
	createCloud.setAttribute('onclick','finalize()');

	$("#formDiv").html("<h2 class='red'>What's Your Edge?</h2>Reflect on your canvas and describe what gives you an edge.<img src='" + usercloudVal + "' class='edgecloud' width='500' height='300' />");
	document.getElementById('formDiv').appendChild(createCloud);
	document.getElementById('formDiv').appendChild(UserSubmitForm);
	
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