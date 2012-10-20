///
///
///
///  ASSET MANAGER

//soundManager.url = 'swf/';
//soundManager.flashVersion = 9;
//soundManager.debugFlash = false;
//soundManager.debugMode = false;

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

function AssetManager() {
    this.successCount = 0;
    this.errorCount = 0;
    this.cache = {};
    this.downloadQueue = [];
    // this.soundsQueue = [];
}

AssetManager.prototype.queueDownload = function(path) {
    this.downloadQueue.push(path);
}

//AssetManager.prototype.queueSound = function(id, path) {
//    this.soundsQueue.push({id: id, path: path});
//}

AssetManager.prototype.downloadAll = function(callback) {
    if (this.downloadQueue.length === 0 && this.soundsQueue.length === 0) {
        callback();
    }
    
    //this.downloadSounds(callback);
    
    for (var i = 0; i < this.downloadQueue.length; i++) {
        var path = this.downloadQueue[i];
        var img = new Image();
        var that = this;
        img.addEventListener("load", function() {
            console.log(this.src + ' is loaded');
            that.successCount += 1;
            if (that.isDone()) {
                callback();
            }
        }, false);
        img.addEventListener("error", function() {
            that.errorCount += 1;
            if (that.isDone()) {
                callback();
            }
        }, false);
        img.src = path;
        this.cache[path] = img;
    }
}

AssetManager.prototype.getAsset = function(path) {
    return this.cache[path];
}

AssetManager.prototype.isDone = function() {
    return ((this.downloadQueue.length) == this.successCount + this.errorCount);
	//return ((this.downloadQueue.length + this.soundsQueue.length) == this.successCount + this.errorCount);
}


///
///
///
///   Timer

function Timer() {
    this.gameTime = 0;
    this.maxStep = 0.05;
    this.wallLastTimestamp = 0;
}

Timer.prototype.tick = function() {
    var wallCurrent = Date.now();
    var wallDelta = (wallCurrent - this.wallLastTimestamp) / 1000;
    this.wallLastTimestamp = wallCurrent;
    
    var gameDelta = Math.min(wallDelta, this.maxStep);
    this.gameTime += gameDelta;
    return gameDelta;
}


///
///
///
/// Game Engine

function GameEngine() {
    this.entities = [];
    this.ctx = null;
    this.click = null;
    this.mouse = null;
    this.timer = new Timer();
    this.surfaceWidth = null;
    this.surfaceHeight = null;
    this.halfSurfaceWidth = null;
    this.halfSurfaceHeight = null;
}

GameEngine.prototype.init = function(ctx) {
    console.log('game initialized');
    this.ctx = ctx;
    this.surfaceWidth = this.ctx.canvas.width;
    this.surfaceHeight = this.ctx.canvas.height;
    this.halfSurfaceWidth = this.surfaceWidth/2;
    this.halfSurfaceHeight = this.surfaceHeight/2;
	this.startInput();
}

GameEngine.prototype.start = function() {
    console.log("starting game");
    var that = this;
    (function gameLoop() {
		if (!pauseGame) {
        	that.loop();
		}
        requestAnimFrame(gameLoop, that.ctx.canvas);
    })();
}

var eListener1 = null;
var eListener2 = null;

GameEngine.prototype.startInput = function() {
    var getXandY = function(e) {
        var x =  e.clientX - that.ctx.canvas.getBoundingClientRect().left - (that.ctx.canvas.width/2);
        var y = e.clientY - that.ctx.canvas.getBoundingClientRect().top - (that.ctx.canvas.height/2);
        return {x: x, y: y};
    }
    
    var that = this;
    
    this.ctx.canvas.addEventListener("click", function(e) {
		console.log("clicked");
        that.click = getXandY(e);
        e.stopPropagation();
        e.preventDefault();
    }, false);
    
    this.ctx.canvas.addEventListener("mousemove", function(e) {
		e.preventDefault();
        that.mouse = getXandY(e);
    }, false);
}

GameEngine.prototype.addEntity = function(entity) {
	console.log("added an entity");
    this.entities.push(entity);
}

GameEngine.prototype.update = function() {
    var entitiesCount = this.entities.length;
    
    for (var i = 0; i < entitiesCount; i++) {
        var entity = this.entities[i];
        
        if (!entity.removeFromWorld) {
            entity.update();
        }
    }
    
    for (var i = this.entities.length-1; i >= 0; --i) {
        if (this.entities[i].removeFromWorld) {
            this.entities.splice(i, 1);
        }
    }
	
}

GameEngine.prototype.draw = function(callback) {
    this.ctx.clearRect(0, 0, this.ctx.canvas.width, this.ctx.canvas.height);
    this.ctx.save();
    this.ctx.translate(this.ctx.canvas.width/2, this.ctx.canvas.height/2);
    for (var i = 0; i < this.entities.length; i++) {
        this.entities[i].draw(this.ctx);
    }
    if (callback) {
        callback(this);
    }
    this.ctx.restore();
}

GameEngine.prototype.loop = function() {
    this.clockTick = this.timer.tick();
    this.update();
    this.draw();
    this.click = null;
}


///
///
///
/// Entities

function Entity(game, x, y) {
    this.game = game;
    this.x = x;
    this.y = y;
    this.removeFromWorld = false;
}

Entity.prototype.update = function() {
}

Entity.prototype.draw = function(ctx) {
    //if (this.game.showOutlines && this.radius) {
    //    ctx.beginPath();
    //    ctx.strokeStyle = "green";
    //    ctx.arc(this.x, this.y, this.radius, 0, Math.PI*2, false);
    //    ctx.stroke();
    //    ctx.closePath();
    //}
}

Entity.prototype.outsideScreen = function() {
    return (this.x > this.game.halfSurfaceWidth || this.x < -(this.game.halfSurfaceWidth) ||
        this.y > this.game.halfSurfaceHeight || this.y < -(this.game.halfSurfaceHeight));
}

///
///
///
/// Background

function Background(game, x, y)
{
	Entity.call(this, game, x, y)
	this.FlowBG= ASSET_MANAGER.getAsset('images/LoopStream_peters2.png');
	this.StaticBG= ASSET_MANAGER.getAsset('images/ConstantStreamGradient.png');
	this.x = 0;
	this.y = 0;
	this.width1 = 1024;
	this.height1 = 568;
}
Background.prototype = new Entity();
Background.prototype.constructor = Background;

Background.prototype.update = function() {
		if (bgMoving) {
			if (this.width1 > 2048) {
				this.width1 = 1024;
				this.height1 = 568;
			}
			this.width1*=1.008;
			this.height1*=1.008;
		}
	}

Background.prototype.draw = function(ctx) {
	var x1 = this.x - this.width1/2;
	var y1 = this.y - this.height1/2;
	
	ctx.drawImage(this.FlowBG, x1, y1, this.width1, this.height1);
	//ctx.drawImage(this.StaticBG, 512, 384, 1024, 568);
	
	Entity.prototype.draw.call(this, ctx); 
}


// ************************************
//  Glimmer
//
// 
// ************************************
function Glimmer(game)
{
	Entity.call(this, game, -4, -113);
	this.sprite = ASSET_MANAGER.getAsset('images/glimmer.png');
    this.radius = 40;
	this.vx = 0;
	this.vy = 0;
	this.conceptSpotWords = [];
	this.rad = 0; 
}
Glimmer.prototype = new Entity();
Glimmer.prototype.constructor = Glimmer;
  
  // ------------------------------------
  // Ball's logic
  
  Glimmer.prototype.update = function() 
  {  
  	  this.radius = 40 + (this.conceptSpotWords.length*2)
	  
	  if (this.game.mouse && mouseCanMove) {  
        this.vx = (this.game.mouse.x-this.x)/15;
        this.vy = (this.game.mouse.y-this.y)/15;
      }
	  
	  else if (!mouseCanMove) {
		  
		if (notDonate) {   
        	this.vx = (-4-this.x)/15;
        	this.vy = (-113-this.y)/15;
		}
		else if (!notDonate) {
			this.vx = (256-this.x)/15;
        	this.vy = (-200-this.y)/15;
		}
		
		this.radius = (40 + (this.conceptSpotWords.length*2)) + (3*Math.sin(this.rad/4));
		this.rad += 0.5;
		if (this.rad == 360) {this.rad = 0;}
	
      }
	  
	  this.x+=this.vx;			
	  this.y+=this.vy;	
	  
	  Entity.prototype.update.call(this);
  }
  
  // ------------------------------------
  // Ball's Render
  Glimmer.prototype.draw = function(ctx) {
		var x = this.x - this.radius;
		var y = this.y - this.radius;
		
	    for (var i = 0; i < this.conceptSpotWords.length; i++) {
			var wordX = this.x + 56;
			var wordY = this.y - 56 + (i * 15);
			ctx.fillStyle = "white";
			ctx.font = "1em 'HelveticaLTStdRoman'";
			ctx.fillText(this.conceptSpotWords[i], wordX, wordY);
		}
		
		ctx.drawImage(this.sprite, x, y, this.radius*2, this.radius*2);
    		    
    	Entity.prototype.draw.call(this, ctx);
	}
	

// ************************************
// Class Item
//	  Represent the items that the user's ball can collide to
// ************************************
function Concepts(game, value, angle)
{
	// CONSTRUCTOR
	Entity.call(this, game, 0, 0);
    this.radial_distance = 0;
    this.angle = angle;
    this.speed = 50;
    this.sprite = value;
    this.radius = 5;
	this.fontSize = 0.1;
    this.setTrajectory();
	this.transparency = 0;
}
Concepts.prototype = new Entity();
Concepts.prototype.constructor = Concepts;
	
	Concepts.prototype.setTrajectory = function() {
		this.x = this.radial_distance * Math.cos(this.angle);
		this.y = this.radial_distance * Math.sin(this.angle);
	}
	
	Concepts.prototype.update = function() {
		
		if (!this.outsideScreen()) {

			if ((this.radius>12 && this.joinGlimmer() && this.game.glimmer.conceptSpotWords.length < 8) && mouseCanMove) {  /// PICKED UP AN IDEA
				addTheConcepts[this.game.glimmer.conceptSpotWords.length].setAttribute('value',this.sprite);   // set the corresponding form Concept Spot to this concept's value. 
				this.game.glimmer.conceptSpotWords.push(this.sprite);   // add the concept's value to the glimmer's word list
				strload(this.sprite);  //  search primal for this word and add those words to our words array
				this.removeFromWorld = true;   // remove the entity
			}
			else {
				this.setTrajectory();
				this.radial_distance += this.speed * this.game.clockTick;
				this.radius+=0.1;
				if (this.fontSize < 3) {
					this.fontSize+=0.05;
				}
				if (this.transparency<1) {
					this.transparency+=0.004;
				}
				//if (this.sprite.style!==undefined) {
					//this.sprite.style.opacity = this.transparency;
					//this.sprite.style.filter = 'alpha(opacity=' + this.transparency*100 + ')';
				//}
			}
		}
		else if (this.outsideScreen()){
			this.removeFromWorld = true;	
		}
		
		Entity.prototype.update.call(this);
	}
	
	// ------------------------------------
	// Check if the concept collides with the Glimmer
	Concepts.prototype.joinGlimmer = function() 
	{
		var distance_squared = (((this.x-this.game.glimmer.x) * (this.x-this.game.glimmer.x)) + ((this.y-this.game.glimmer.y) * (this.y-this.game.glimmer.y)));
		var radii_squared = (this.radius + this.game.glimmer.radius) * (this.radius + this.game.glimmer.radius);
		return distance_squared < radii_squared; 	
	}
	
	Concepts.prototype.draw = function(ctx) {
		var x = this.x - this.radius;
		var y = this.y - this.radius;
		
		if (this.radius > 12) {
			ctx.beginPath();
	    	ctx.arc(x, y, this.radius, 0, 2 * Math.PI, false);
 
    		ctx.fillStyle = "#FF3333";
    		ctx.fill();
		}
		
		ctx.fillStyle = "white";
		ctx.font = this.fontSize + "em Helvetica";
		ctx.fillText(this.sprite, x, y);
		
				
		Entity.prototype.draw.call(this, ctx);
	}

///
///
///
/// Streme

function Streme() {
    GameEngine.call(this);
    this.timeleft = 3000;
}

Streme.prototype = new GameEngine();
Streme.prototype.constructor = Streme;

Streme.prototype.start = function() {
    this.glimmer = new Glimmer(this);
    this.background = new Background(this, 0, 0);
    this.addEntity(this.background);
	this.addEntity(this.glimmer);
    GameEngine.prototype.start.call(this);
}

Streme.prototype.update = function() {
	
	//initialize mouse listeners
	if (this.timer.gameTime > 5 && mouseCanMove == null) {
		$('#gameTitleDiv').fadeOut('slow')
		gameBegun = true;
	}
	
	// add new concepts
	if (words.length > 0) {
		if (((this.timer.gameTime > 2 && this.lastConceptAddedAt == null) || (this.timer.gameTime - this.lastConceptAddedAt) > 2) && !gameFinished) {
			
			if ((words.length % 4) == 0) {
				var wordFromArray = Math.floor(Math.random()*starters.length);
				var value = starters[wordFromArray];
				words.splice((words.length - 1), 1);
			}
			else {
				var wordFromArray = Math.floor(Math.random()*words.length);
				var value = words[wordFromArray];
				words.splice(wordFromArray, 1);
			}
			if (value == "States") value = "Canada";
			
			this.addEntity(new Concepts(this, value, Math.floor(Math.random() * Math.PI * 2)));	
			
			this.lastConceptAddedAt = this.timer.gameTime;
		}
	}
	else if(words.length == 0) {
		 for (var i = 0; i < 10; i++) {
			 var wordFromArray = Math.floor(Math.random()*starters.length);
			 var value = starters[wordFromArray];
			 words.push(value);
		 }
	}
	//this.timeleft --;
    
	// add new inspiration
	if (inspirationTracker < 11) {
		if (((mouseCanMove && this.lastInspirationAddedAt == null) || (this.timer.gameTime - this.lastInspirationAddedAt) > 25) && !gameFinished) {
			var value = inspirations[inspirationTracker];
					
			$('#inspirations').html(value);
			$('#inspirations').fadeIn('slow',
				function() {
					$('#inspirations').delay(4000).fadeOut('slow')
				});	
			
			inspirationTracker+=1; 
			
			console.log("added an inspiration"); 
			
			this.lastInspirationAddedAt = this.timer.gameTime;
		}
	}
	
	// end game when...
    if ((game.glimmer.conceptSpotWords.length == 8 && !gameFinished) || gameFinished) {
		if (!doneSwitch) {
			realizeIt();
			doneSwitch = true;
		}
    }
    
    GameEngine.prototype.update.call(this);
}

Streme.prototype.draw = function() {
	
    GameEngine.prototype.draw.call(this, function(game) {
    	game.drawTime();
    });
}

Streme.prototype.drawTime = function() {
//    this.ctx.fillStyle = "white";
//    this.ctx.font = "bold 2em 'NewRegular'";
//    this.ctx.fillText("Time: " + this.timeleft, -this.ctx.canvas.width/2 + 50, this.ctx.canvas.height/2 - 80);
}

var game = new Streme();
var ASSET_MANAGER = new AssetManager();
var words = [];
var inspirations = [];
var inspirationTracker = 0; 
var pauseGame = false;
var mouseCanMove = null;
var bgMoving = true;

var notDonate = true;


var doneSwitch = false; 

ASSET_MANAGER.queueDownload('images/ConstantStreamGradient.png');
ASSET_MANAGER.queueDownload('images/bg_menu.png');
ASSET_MANAGER.queueDownload('images/LoopStream.png');
ASSET_MANAGER.queueDownload('images/LoopStream_peters2.png');
ASSET_MANAGER.queueDownload('images/glimmer.png');
ASSET_MANAGER.queueDownload('images/Picture1.png');
 
// initialize inspirations
inspirations.push("Gravitate towards words that inspire your idea, leave the rest behind.");
inspirations.push("Where you start won't always be where you end up.");
inspirations.push("Use this as an enlightening experience of the human thought process.");
inspirations.push("'Imagination is more important than knowledge' Albert Einstein");
inspirations.push("There's no need to know the answer, just let the words inspire you.");
inspirations.push("Focus on the process, do not worry about the outcome.");
inspirations.push("While keywords between users may be the same, our individual experiences create the context.");
inspirations.push("Hearing or reading new words leads to new concepts .");
inspirations.push("Awe, inspire and enlighten.");
inspirations.push("Welcome the unexpected intersection of seemingly unrelated words.");
inspirations.push("Add your diverse voice to the Ocean of Ideas.");


