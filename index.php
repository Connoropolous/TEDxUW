<!DOCTYPE html>
<html>

<head>
	<meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="user-scalable=no, width=device-width" />
	
    <link href="playgame.css" rel="stylesheet" type="text/css">
    
     <script src="http://cdn.jquerytools.org/1.2.6/jquery.tools.min.js"></script>
     <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
     <script type="text/javascript" src="scripts/jquery.backgroundpos.min.js"></script>
     <script src="http://www.google.com/jsapi?key=AIzaSyA5m1Nc8ws2BbmPRwKu5gFradvD_hgq6G0" type="text/javascript"></script>
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
             <div id="inspirations">While keywords between users may be the same, our individual experiences create the context.</div>
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
             	<form name="emailForm" method="GET" action="/" id="myform" autocomplete="off">
                	<p>Enter your email...</p>
                	<input id="form1input" class="input" type="text" name="email" ></input>
                	<input type="submit" class="submit" name="emailSubmit" id="email" value="Get Started" ></input>
             	</form>
             </div>           
        </div>
    </div>
      
</body>

</html>
