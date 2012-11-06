<!DOCTYPE html>
<html>

<head>
	<meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="user-scalable=no, width=device-width" />
	
    <link href="playgame.css" rel="stylesheet" type="text/css">
    
     <script src="http://cdn.jquerytools.org/1.2.6/jquery.tools.min.js"></script>
     <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
     <script type="text/javascript" src="scripts/jquery.backgroundpos.min.js"></script>
     <script type="text/javascript" src="scripts/http.js"></script> 

	<?php
	  require_once("formtools/global/api/api.php");
	?>

</head>

<body>
	<script type="text/javascript">
              var gameBegun = false;
              var gameFinished = false;
              
              function endGame() {	
                  if (gameBegun) {
                      gameFinished = true;
                  }
              }
     </script>
    <div id="WelcomeAndPlay">         
        
        <div id="game">
             <canvas id="Surface" width="1024" height="568"></canvas>
             	
                <script type="text/javascript" src="gameplay.js"></script>
                <script type="text/javascript" src="scripts/wordlist.js"></script>
				<script type="text/javascript" src="scripts/getstarted.js"></script>
     			<script type="text/javascript" src="scripts/realizeyouridea.js"></script>         
                
             <div id="gameTitleDiv">
             		<div id="explainDonate"></div>
             		<div id="donateForm"></div>
             		<div class="clearfloat"></div>
             </div>
             <div id="formDiv">
             	<h1 class="title">Define your <span class="red">edge</span></h1>
                <p class="explanation">This installation is designed to help you identify and explore what gives you an edge. Choose words that you feel <br><span class="red">connect with your successes or potential.</span></p>
             	<form name="emailForm" method="GET" action="/" id="myform" autocomplete="off">
                	<label for="form1input">Enter your email address to begin:</label>
                	<input id="form1input" class="input" type="text" name="email" ></input>
                    <div class="clearfloat"></div>
                	<label for="form1checkbox">Check this box if you don't want us to share your TEDxUW photo alongside your <span class="red">edge</span> statement: </label>
                	<input id="form1checkbox" type="checkbox" name="photoPermission" ></input>
                	<input type="submit" class="submit" name="emailSubmit" id="email" value="Get Started" ></input>
             	</form>
             </div>           
        </div>
    </div>
      
</body>

</html>
