<!DOCTYPE html>
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
		
	?> <div class="person" id="person<? echo $i ?>">
    		<div class="personImage">
            	<img src="images/anonymous.jpg" />
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
            </div>
        </div>
        <script type="text/javascript"> 
        </script>
	<?php }?>
</body>
</html>



	
