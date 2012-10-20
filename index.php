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
    
    <script type="text/javascript">
            $(document).ready(function(){
				
                //setTimeout(function(){$('#welcomeScreen').animate({'top':'0'},1500);}, 1000);				
								
                $('#welcomeScreen a').click(function(){
					temp = $('#welcomeScreen').css('top'); 
					if (temp === "0px") {
                    	$('#welcomeScreen').animate({'top':'-635'},1000);
						$('#welcomeScreen a').animate({'top':'635'},100);
						$('#welcomeScreen a').html('intro');
					}
					else if (temp === "-635px") {
                    	$('#welcomeScreen').animate({'top':'0'},1000);
						$('#welcomeScreen a').animate({'top':'618'},100);
						$('#welcomeScreen a').html('close');
					}
				});
            });
        </script>

</head>

<body>
  <!--[if lte IE 7]>
  <iframe src="ie7-upgrade/index.php" frameborder="no" style="height: 90px; width: 100%; border: none;"  scrolling="no" ></iframe>
  <![endif]-->
  	<div id="welcomeScreenWrapper">
  	<div id="welcomeScreen">
    	<h2>What is Streme... </h2>
			<p>This is a community building experiment that asks you to experience how ideas are formed, mirroring the human thought process. </p>
			<p>We're asking you to try a completely new way for THEMUSEUM to collect ideas and small donations from the masses. </p>
			<p>This is your forum. If you like what you've experienced, donate because a portion of every donation will go into improving Streme. Take ownership and watch it grow. </p>

		<h2>Your Goal of Streme...</h2>
			<p>... is to experience the process of how a few simple words can inspire an entirely new idea. Streme is a unique way to share your ideas and be heard while seeing how others do the same. </p>
			<p>It's a bit out there, we know, but humour us and see how your idea develops.</p>

		<h2>Our Goal for Streme... </h2>
			<p>To expand THEMUSEUM experience outside our facility and hear what THEMUSEUM community has to say about anything and everything. </p>
		<a href="#">close</a>
    </div>
    </div>
	<div id="timelineWrapper">
        <div id="timeline">
            <script type="text/javascript">
              var gameBegun = false;
              var gameFinished = false;
              
              function endGame() {	
                  if (gameBegun) {
                      gameFinished = true;
                  }
              }
            </script>
            <a href="/" class="timelineSection" id="timeline1" onmouseover="$('#helpBox1').css('display','block');" onmouseout="" onclick='confirm("Are you sure? You will lose whatever progress on your idea you have made.")'>
                <p>Start Thinking</p>
            </a>
            <div class="timelineSection" id="timeline2" onmouseover="$('#helpBox2').css('display','block');" onmouseout="$('#helpBox2').css('display','none');">
                <p>Experience the Thought Streme</p>
            </div>
            <a href="javascript: endGame()" class="timelineSection" id="timeline3" onmouseover="$('#helpBox3').css('display','block');" onmouseout="$('#helpBox3').css('display','none');">
                <p>Realize <br>Your Idea</p>
            </a>
            <a href="/donate.htm" width="500" height="500" target="_new" class="timelineSection" id="timeline4" onmouseover="$('#helpBox4').css('display','block');" onmouseout="$('#helpBox4').css('display','none');">
                <p>Support THEMUSEUM</p>
            </a>
            <a href="/ocean.php" class="timelineSection" id="timeline5" onmouseover="$('#helpBox5').css('display','block');" onmouseout="$('#helpBox5').css('display','none');">
                <p>Explore the <br> Ocean of Ideas</p>
            </a>
        </div>   
    </div><!-- timelineWrapper --> 
    <div id="WelcomeAndPlay">         
        
        <div id="game">
        	<div id="helpBox1" class="helpBox">Welcome to Streme! New here? <a href="#" onclick="runTutorial(); return false;" style="color:#06F;">click here</a> to get a quick tutorial. If not, go ahead and start thinking!<br> <a href="#" onclick="document.getElementById('helpBox1').style.display = 'none'; return false;" style="color:#06F;">-close this box-</a></div>
            <div id="helpBox2" class="helpBox">Words will drift past you in the Streme, loosely based on the keywords you
entered. Grab 8 words that you like and leave the boring ones behind.</div>
            <div id="helpBox3" class="helpBox">Reflect on these 8 new words and enter the thought that comes to mind in the
blank field, then click 'A Ha!'. </div>
            <div id="helpBox4" class="helpBox">Donate to THEMUSEUM to showcase your idea in the Ocean of Ideas. Even $1 will do!</div>
            <div id="helpBox5" class="helpBox">Explore the ideas of donors just like you in the Ocean of Ideas.</div>
            <div id="inspirations">While keywords between users may be the same, our individual experiences create the context.</div>
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
             
             <div class="modal" id="conceptualBox">
             		<div class="modalContent">
		             <h2>What's The Big Idea?</h2><button class="close"> Close </button><div class="clearfloat"></div>
              
                      <h3>Meaning of Streme</h3>Streme is a play on the words 'Stream' and 'Meme'.<br>
							Stream refers to the human Stream of Conscious and flow of thoughts that regularly run through your mind. 

							Meme is an idea, behaviour or style that is passed from person to person to become a part of culture. The popular YouTube clip 'Evolution of Dance' is an example of a meme. It started as a personal video, shared through social media and blogs to become a part of social culture.<br><br>

						<h3>What is Streme?</h3>
							Streme is the visual interpretation of how an idea is formed. It begins as a thought to its development through our personal stream of consciousness to create an idea. THEMUSEUM will create a virtual community of ideas that represents the thoughts, wishes and reflections of our local community and beyond. <br><br>

						<h3>Why Streme?</h3>
							The goal of Streme is to put a new twist on fundraising. Streme allows the user to have a unique journey into their Stream of Consciousness and after, contribute to THEMUSEUM in two ways: with a financial donation and the donation of an idea. The funds collected from Streme will be used to awe, inspire and enlighten the community through public activities, family programming and world-class exhibits. 
                     </div>        
              </div>
                  
              <div class="modal" id="creditBox">
              		<div class="modalContent">
                      <h2>Credits</h2><button class="close"> Close </button><div class="clearfloat"></div>
                      <br>
                      Concept: Connor Turland, THEMUSEUM
                      <br><br>
                      Developer: Connor Turland
                      <br><br>
                      Project Management: Mad Hatter Technology, Inc.
                      <br><br>
                      Graphic Design: Josh Brak, THEMUSEUM
                      <br><br>
                      Concept mapping powered by: Primal
                      <br><br>
                      <div class="logos">
                        <a href="http://themuseum.ca" target="_blank" style="float:left;"><img src="images/museumLogo.png" /></a>
                        <div class="sublogos">
                        	<a href="http://madhattertech.ca" target="_blank" style="float:left;"><img src="images/logo.png" /></a>
                        	<div style="clear:left; padding-top:26px;"></div>
                        	<a href="http://primal.com" target="_blank" style="float:left;"><img src="images/primalLogo.png" /></a>
                        </div>
                      </div>
                      <div class="clearfloat"></div>
                    </div>
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
