f<!DOCTYPE html>
<html>
<head>

<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="user-scalable=no, width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="people.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
<script src="scripts/OceanIdeas.js" type="text/javascript"></script>
<title>Ocean</title>
<?php
	require_once("formtools/global/api/api.php");
	ft_api_clear_form_sessions();
?>
</head>

<body>
  <!--[if lte IE 7]>
  <iframe src="ie7-upgrade/index.php" frameborder="no" style="height: 90px; width: 100%; border: none;"  scrolling="no" ></iframe>
  <![endif]-->

<script type="text/javascript"> 

var mousex;
var mousey; 

$(document).ready(function(){
   $(document).mousemove(function(e){
      mousex = e.pageX;
	  mousey = e.pageY;
   });
    
   $(document).touchmove(function(e){
	  e.preventDefault();
	  var touch = e.touches[0];
	  mousex = touch.pageX;
	  mousey = touch.pageY;
   });
   
})

function toggleText(ideaID) {
		text1 = "content" + ideaID;
		text2 = "#content" + ideaID;
		
		
		myObject = document.getElementById(text1);
		myObjectVB = myObject.style.display;
		
		switch (myObjectVB) {
			case "block":
				$(text2).fadeOut('slow', function() {				
					$(text2).css('display', 'none');				
				});
				this.ocean.entities[ideaID-1].status = "free";	 			
				break;
		
			case "none":
				$(text2).fadeIn('slow', function() {				
					$(text2).css('display', 'block');				
				}); 
				this.ocean.entities[ideaID-1].status = "still";			
				break;
		}
		
}

function grabIdea(ideaID, e) {
		e.preventDefault();
		this.ocean.entities[ideaID-1].status = "mousedown";
}

function dropIdea(ideaID, e) {
		e.preventDefault(); 
		this.ocean.entities[ideaID-1].status = "free";
}

</script>

<?php	
	$ideas = array();
	
	$num_deleted = ft_api_delete_unfinalized_submissions(1, true);
	
	$num_submissions = ft_api_show_submission_count(1);

?>
<br>
<br>
<?php
	$ideas = ft_api_get_finalized_submissions(1);
	
	for ($i = 1; $i <= $num_submissions; $i++) {
		$idea = $ideas[$i - 1];
		
	?> <div class="idea" id="idea<? echo $i ?>">
    		<div class="ideaImage">
            	<img id="<? echo "img", $i ?>" src="images/oceanIdeas<?php echo rand(1, 2) ?>.png" onmousedown="grabIdea(<?php echo $i ?>, event)" onmouseup="dropIdea(<?php echo $i ?>, event)" onclick="toggleText(<?php echo $i ?>)" ontouchmove="event.preventDefault();" />
                <div class="ideaName"><?php echo $idea["username"]; ?></div>
            </div>
            <div class="toggleContent" id="content<?php echo $i ?>">
                <div class="ideaTitle">
                    <h2><?php echo $idea["username"]; ?>'s Idea</h2>
                </div>
                <div class="ideaContent">
                    <div class="ideaIdea"><h2><?php echo $idea["useredge"]; ?></h2></div>
                    <div class="ideaQueries"><h3>Queries: <?php echo $idea["usercloud"]; ?></h3></div>
                </div>
                <div class="ideaConcepts1">
                    <div class="concept1">
                        <?php echo $idea["concept1"]; ?>
                    </div>
                    <div class="clearR"></div>
                    <div class="concept2">
                        <?php echo $idea["concept2"]; ?>
                    </div>
                    <div class="clearR"></div>
                    <div class="concept3">
                        <?php echo $idea["concept3"]; ?>
                    </div>
                    <div class="clearR"></div>
                    <div class="concept4">
                        <?php echo $idea["concept4"]; ?>
                    </div>
                </div>
                <div class="ideaConcepts2">
                    <div class="concept5">
                        <?php echo $idea["concept5"]; ?>
                    </div>
                    <div class="clearL"></div>
                    <div class="concept6">
                        <?php echo $idea["concept6"]; ?>
                    </div>
                    <div class="clearL"></div>
                    <div class="concept7">
                        <?php echo $idea["concept7"]; ?>
                    </div>
                    <div class="clearL"></div>
                    <div class="concept8">
                        <?php echo $idea["concept8"]; ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript"> 
		$('#content<? echo $i ?>').css('display', 'none');
		$('#idea<? echo $i ?>').css('top', '<? echo rand(115, 2000); ?>px');
		$('#idea<? echo $i ?>').css('left', '<? echo rand(115, 2000); ?>px'); 
		var <? echo "mov", $i ?> = new Entity(<? echo $i ?>);
		this.ocean.addEntity(<? echo "mov", $i ?>);
        </script>
	<?php }?>
</body>
</html>



	
