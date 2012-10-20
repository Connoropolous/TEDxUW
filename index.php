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
    <div id="WelcomeAndPlay">         
        
        <div id="game">
             <canvas id="Surface" width="1024" height="568"></canvas>
             	
                <script type="text/javascript" src="gameplay.js"></script>
				<script type="text/javascript" src="scripts/startthinking.js"></script>
     			<script type="text/javascript" src="scripts/realizeyouridea.js"></script>         
     			<script type="text/javascript" src="scripts/supportthemuseum.js"></script>
                <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
                
             <div id="gameTitleDiv">
             		<div id="explainDonate"></div>
             		<div id="donateForm"></div>
             		<div id="bigLogo"></div><div class="clearfloat"></div>
             </div>
             <div id="formDiv">
             	<form name="questionForm" method="GET" action="/" id="myform" autocomplete="off" >
                	<p>I want to think about...</p>
                	<input id="form1input" class="input" type="text" name="question" ></input>
                	<input type="submit" class="submit" name="ideaSubmit" id="think" value="Think!" ></input>
             	</form>
             </div>           
        </div>
    </div>
     <div id="bottomThings">
             <iframe id="likeButton" src="https://www.facebook.com/plugins/like.php?href=http://streme.ca" scrolling="no" frameborder="0" style="border:none; width:50px; height:24px"></iframe>
             <div id="tweet">
                    <a href="http://twitter.com/share" class="twitter-share-button" data-text="Check out this interesting game about ideas from THEMUSEUM!" data-count="none" data-via="THEMUSEUM">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
             </div>
             <div class="g-plusone" data-annotation="none" data-href="http://streme.ca"></div> 
             <div class="clearfloat"></div>
         </div>  
      
</body>

</html>
