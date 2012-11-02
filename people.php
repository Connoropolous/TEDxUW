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


<?php  $imageText = "data:image/png;base64,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"; ?>


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
    			<?php if(isset($idea["photourl"]) == false ){
    				$photourl = "images/anonymous.jpg";
    			}
    			else {
	    			$photourl = $idea["photourl"];
	
    			}
    			?>
            	<img src="<?php echo $photourl; ?>" />
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



	
