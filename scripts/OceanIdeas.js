// JavaScript Document

window.requestAnimFrame = (function(){
      return  window.requestAnimationFrame       ||
              window.webkitRequestAnimationFrame ||
              window.mozRequestAnimationFrame    ||
              window.oRequestAnimationFrame      ||
              window.msRequestAnimationFrame     ||
              function(/* function */ callback, /* DOMElement */ element){
                window.setTimeout(callback, 1000 / 60);
              };
})();


function Timer() {
    this.gameTime = 0;
    this.maxStep = 1;
    this.wallLastTimestamp = 0;
}

Timer.prototype.tick = function() {
    var wallCurrent = Date.now();
    var wallDelta = (wallCurrent - this.wallLastTimestamp);
    this.wallLastTimestamp = wallCurrent;
    
    var gameDelta = Math.min(wallDelta, this.maxStep);
    this.gameTime += gameDelta;
    return gameDelta;
}

function GameEngine() {
    this.entities = [];
	this.timer = new Timer();
}

GameEngine.prototype.start = function() {
    console.log("starting game");
    var that = this;
    (function gameLoop() {
        that.loop();
        requestAnimFrame(gameLoop, document.body);
    })();
}

GameEngine.prototype.loop = function() {
    this.update();
	this.clockTick = this.timer.tick();
}

GameEngine.prototype.addEntity = function(entity) {
	console.log("added an entity");
    this.entities.push(entity);
}

GameEngine.prototype.update = function() {
	
	var entitiesCount = this.entities.length;
	
	for (var i = 0; i < entitiesCount; i++) {
		var entity = this.entities[i];
		entity.update();
	}				
	
}

//
//
//

function Entity(id) {
    this.id = id;
	this.status = "free";
	this.radius = 0;
	this.angle = Math.floor(Math.random()*360);
	this.cycle = 0;
	this.rotator = 1;
	this.speed = Math.floor(Math.random()*6) + 10;
	this.myEvent = null;
}

Entity.prototype.update = function() {
	
	var tm = Math.floor(ocean.timer.gameTime) % 5;
	
	if (tm == 0) {
		var imgID = "img"+this.id;
		var ideaID = "idea"+this.id;
		var elem = document.getElementById(ideaID);
		var imgElem = document.getElementById(imgID);
		
		if (this.status == "still") {
			imgElem.height = 113 + (10*Math.sin(this.radius/4));
			imgElem.width = 113 + (10*Math.sin(this.radius/4));
			this.radius += 1;
			if (this.radius == 360) {this.radius = 0;}
		}
		
		else if (this.status == "mousedown") { 
		 elem.style.top=(mousey-286)+"px";
		 elem.style.left=(mousex-208)+"px";
   		}
		
		else if (this.status == "free") {
		 var spotTop = parseInt(elem.style.top);
		 var spotLeft = parseInt(elem.style.left);
		 
		 dirX = this.speed * Math.sin(this.angle);
		 dirY = this.speed * Math.cos(this.angle); 
		 
		 if (spotTop+dirY > 0 && spotTop+dirY < 5000) spotTop+=dirY;
		 else {
			 this.angle += Math.floor(Math.random()*180) - 90;
		 }
		 if (spotLeft+dirX > 0 && spotLeft+dirX < 5000) spotLeft+=dirX;
		 else {
			 this.angle += Math.floor(Math.random()*180) - 90;
		 }         
				  
		 elem.style.top=spotTop+"px";
		 elem.style.left=spotLeft+"px";
		 
		 if (this.rotator == -1){	
	     	this.angle -= 1;
		 	this.cycle -= 1;
		 }
		 else if (this.rotator == 1) {
			this.angle += 1;
			this.cycle += 1;
		 }
		 if (this.cycle == 2 || this.cycle == 0) {
			 this.rotator = -this.rotator;
		 }
   		}
	}
}


//
//
//

var ocean = new GameEngine();
ocean.start();