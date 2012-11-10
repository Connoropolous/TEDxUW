//
//
// A-HA! SECTION
		createCloud=document.createElement('button');
		createCloud.setAttribute('value','submit');
		createCloud.setAttribute('onclick','createEdge()');
		
		ZoomWrapper=document.createElement('div');
		ZoomWrapper.setAttribute('id', 'zoomwrapper');
		
		
		var usercloudVal;
				
function organizeCloud() {	
		gameFinished = true;
        mouseCanMove = false;
		$("#formDiv").html("This is the page where you organize your cloud.");
		
		//usercloudVal = canvas.toDataURL();
		//usercloud.setAttribute('value',usercloudVal);
		
		document.getElementById('formDiv').appendChild(createCloud);
		
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
		
		$('#formDiv').fadeIn('slow', function(){});
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