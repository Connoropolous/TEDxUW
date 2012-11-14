function getDistance(touch1, touch2){
  var x1 = touch1.clientX;
  var x2 = touch2.clientX;
  var y1 = touch1.clientY;
  var y2 = touch2.clientY;
  
  return Math.sqrt(((x2 - x1) * (x2 - x1)) + ((y2 - y1) * (y2 - y1)));
}

function arrangeWords(wordArray){
	stage = new Kinetic.Stage({
        container: 'container',
        width: 1024,
        height: 768
      });
	var layer1 = new Kinetic.Layer();
	var layer2 = new Kinetic.Layer();
	var layer3 = new Kinetic.Layer();
	var layer4 = new Kinetic.Layer();
	var layer5 = new Kinetic.Layer();
	var layer6 = new Kinetic.Layer();
	var layer7 = new Kinetic.Layer();
	var layer8 = new Kinetic.Layer();
	var startDistance = undefined;
	var startScale1 = 1;
	var startScale2 = 1;
	var startScale3 = 1;
	var startScale4 = 1;
	var startScale5 = 1;
	var startScale6 = 1;
	var startScale7 = 1;
	var startScale8 = 1;
	
	var word1 = new Kinetic.Text({
        x: 25,
        y: 25,
        text: wordArray[0],
        fontSize: 50,
        fontFamily: 'Calibri',
        textFill: '#ed3624',
		draggable: true
     });

	var word2 = new Kinetic.Text({
        x: 25,
        y: 100,
        text: wordArray[1],
        fontSize: 50,
        fontFamily: 'Calibri',
        textFill: 'white',
		draggable: true
     });
	 
	 var word3 = new Kinetic.Text({
        x: 25,
        y: 175,
        text: wordArray[2],
        fontSize: 50,
        fontFamily: 'Calibri',
        textFill: '#ed3624',
		draggable: true
     });
	 
	 var word4 = new Kinetic.Text({
        x: 25,
        y: 250,
        text: wordArray[3],
        fontSize: 50,
        fontFamily: 'Calibri',
        textFill: 'white',
		draggable: true
     });
	 
	 var word5 = new Kinetic.Text({
        x: 25,
        y: 325,
        text: wordArray[4],
        fontSize: 50,
        fontFamily: 'Calibri',
        textFill: '#ed3624',
		draggable: true
     });
	 
	 var word6 = new Kinetic.Text({
        x: 25,
        y: 400,
        text: wordArray[5],
        fontSize: 50,
        fontFamily: 'Calibri',
        textFill: 'white',
		draggable: true
     });
	 
	 var word7 = new Kinetic.Text({
        x: 25,
        y: 475,
        text: wordArray[6],
        fontSize: 50,
        fontFamily: 'Calibri',
        textFill: '#ed3624',
		draggable: true
     });
	 
	 var word8 = new Kinetic.Text({
        x: 25,
        y: 550,
        text: wordArray[7],
        fontSize: 50,
        fontFamily: 'Calibri',
        textFill: 'white',
		draggable: true
     });
	
	layer1.on("touchmove", function(evt){
		var touch1 = evt.touches[0];
		var touch2 = evt.touches[1];
	
		if (touch1 && touch2) {
			if (startDistance === undefined) {
				startDistance = getDistance(touch1, touch2);
			}
			else {
				var dist = getDistance(touch1, touch2);
				var scale = (dist / startDistance) * startScale1;
				layer1.setScale(scale);
				layer1.rotateDeg(evt.rotation);
	
				// center layer
				//var x = layer1.width * (1 - scale) / 2;
				//var y = layer1.height * (1 - scale) / 2;
				//layer1.setPosition(x, y);
	
				stage.draw();
			}
		}
	});
	
	layer1.on("touchend", function(){
		startDistance = undefined;
		startScale1 = layer1.scale.x;
	});
	
	layer2.on("touchmove", function(evt){
		var touch1 = evt.touches[0];
		var touch2 = evt.touches[1];
	
		if (touch1 && touch2) {
			if (startDistance === undefined) {
				startDistance = getDistance(touch1, touch2);
			}
			else {
				var dist = getDistance(touch1, touch2);
				var scale = (dist / startDistance) * startScale2;
				layer2.setScale(scale);
				layer2.rotateDeg(evt.rotation);
				
	
				// center layer
				//var x = layer2.width * (1 - scale) / 2;
				//var y = layer2.height * (1 - scale) / 2;
				//layer1.setPosition(x, y);
	
				stage.draw();
			}
		}
	});
	
	layer2.on("touchend", function(){
		startDistance = undefined;
		startScale2 = layer2.scale.x;
	});
	
	layer3.on("touchmove", function(evt){
		var touch1 = evt.touches[0];
		var touch2 = evt.touches[1];
	
		if (touch1 && touch2) {
			if (startDistance === undefined) {
				startDistance = getDistance(touch1, touch2);
			}
			else {
				var dist = getDistance(touch1, touch2);
				var scale = (dist / startDistance) * startScale3;
				layer3.setScale(scale);
				layer3.rotateDeg(evt.rotation);
	
				// center layer
				//var x = layer1.width * (1 - scale) / 2;
				//var y = layer1.height * (1 - scale) / 2;
				//layer1.setPosition(x, y);
	
				stage.draw();
			}
		}
	});
	
	layer3.on("touchend", function(){
		startDistance = undefined;
		startScale3 = layer3.scale.x;
	});
	
	layer4.on("touchmove", function(evt){
		var touch1 = evt.touches[0];
		var touch2 = evt.touches[1];
	
		if (touch1 && touch2) {
			if (startDistance === undefined) {
				startDistance = getDistance(touch1, touch2);
			}
			else {
				var dist = getDistance(touch1, touch2);
				var scale = (dist / startDistance) * startScale4;
				layer4.setScale(scale);
				layer4.rotateDeg(evt.rotation);
	
				// center layer
				//var x = layer1.width * (1 - scale) / 2;
				//var y = layer1.height * (1 - scale) / 2;
				//layer1.setPosition(x, y);
	
				stage.draw();
			}
		}
	});
	
	layer4.on("touchend", function(){
		startDistance = undefined;
		startScale4 = layer4.scale.x;
	});
	
	layer5.on("touchmove", function(evt){
		var touch1 = evt.touches[0];
		var touch2 = evt.touches[1];
	
		if (touch1 && touch2) {
			if (startDistance === undefined) {
				startDistance = getDistance(touch1, touch2);
			}
			else {
				var dist = getDistance(touch1, touch2);
				var scale = (dist / startDistance) * startScale5;
				layer5.setScale(scale);
				layer5.rotateDeg(evt.rotation);
	
				// center layer
				//var x = layer1.width * (1 - scale) / 2;
				//var y = layer1.height * (1 - scale) / 2;
				//layer1.setPosition(x, y);
	
				stage.draw();
			}
		}
	});
	
	layer5.on("touchend", function(){
		startDistance = undefined;
		startScale5 = layer5.scale.x;
	});
	
	layer6.on("touchmove", function(evt){
		var touch1 = evt.touches[0];
		var touch2 = evt.touches[1];
	
		if (touch1 && touch2) {
			if (startDistance === undefined) {
				startDistance = getDistance(touch1, touch2);
			}
			else {
				var dist = getDistance(touch1, touch2);
				var scale = (dist / startDistance) * startScale6;
				layer6.setScale(scale);
				layer6.rotateDeg(evt.rotation);
	
				// center layer
				//var x = layer1.width * (1 - scale) / 2;
				//var y = layer1.height * (1 - scale) / 2;
				//layer1.setPosition(x, y);
	
				stage.draw();
			}
		}
	});
	
	layer6.on("touchend", function(){
		startDistance = undefined;
		startScale6 = layer6.scale.x;
	});
	
	layer7.on("touchmove", function(evt){
		var touch1 = evt.touches[0];
		var touch2 = evt.touches[1];
	
		if (touch1 && touch2) {
			if (startDistance === undefined) {
				startDistance = getDistance(touch1, touch2);
			}
			else {
				var dist = getDistance(touch1, touch2);
				var scale = (dist / startDistance) * startScale7;
				layer7.setScale(scale);
				layer7.rotateDeg(evt.rotation);
	
				// center layer
				//var x = layer1.width * (1 - scale) / 2;
				//var y = layer1.height * (1 - scale) / 2;
				//layer1.setPosition(x, y);
	
				stage.draw();
			}
		}
	});
	
	layer7.on("touchend", function(){
		startDistance = undefined;
		startScale7 = layer7.scale.x;
	});
	
	layer8.on("touchmove", function(evt){
		var touch1 = evt.touches[0];
		var touch2 = evt.touches[1];
	
		if (touch1 && touch2) {
			if (startDistance === undefined) {
				startDistance = getDistance(touch1, touch2);
			}
			else {
				var dist = getDistance(touch1, touch2);
				var scale = (dist / startDistance) * startScale8;
				layer8.setScale(scale);
				layer8.rotateDeg(evt.rotation);
	
				// center layer
				//var x = layer1.width * (1 - scale) / 2;
				//var y = layer1.height * (1 - scale) / 2;
				//layer1.setPosition(x, y);
	
				stage.draw();
			}
		}
	});
	
	layer8.on("touchend", function(){
		startDistance = undefined;
		startScale8 = layer8.scale.x;
	});
	
	layer1.add(word1);
	layer2.add(word2);
	layer3.add(word3);
	layer4.add(word4);
	layer5.add(word5);
	layer6.add(word6);
	layer7.add(word7);
	layer8.add(word8);
	stage.add(layer1);
	stage.add(layer2);
	stage.add(layer3);
	stage.add(layer4);
	stage.add(layer5);
	stage.add(layer6);
	stage.add(layer7);
	stage.add(layer8);
};