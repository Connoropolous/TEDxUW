<!DOCTYPE html>
<html>
<head>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="user-scalable=no, width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="people.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
<script src="scripts/jquery.easing.1.3.js" type="text/javascript"></script>

<script src="peopleLoops/jquery.cycle.all.js" type="text/javascript"></script>

<head>
        <link rel="stylesheet" href="fancybox/jquery.fancybox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="fancybox/jquery.fancybox.pack.js"></script>

    </head>
    
    


<title>Gallery</title>

<?php
	require_once("formtools/global/api/api.php");
	ft_api_clear_form_sessions();
?>

</head>

<body>


<div id="mainCanvas">

	<div id="row1">
		<?php include("peopleLoops/firstLoop.php"); ?> 
	</div><!--row1-->

	
	<div id="row2">
		<?php include("peopleLoops/secondLoop.php"); ?>	
	</div><!--row2-->
	
	<div id="row3">
		<?php include("peopleLoops/thirdLoop.php"); ?>			
	</div><!--row3-->
	<div id="navbar">
		<div id="prev"></div>
		<a href="http://localhost/~lucaszw/TEDxUW/people.php"><div id="reload"></div></a>
		<div id="next"></div>
	</div><!--navBar-->
	
	<?php
		for ($i = 1; $i <= 21 ; $i ++){ ?>
		<script>
		
		$('<?php echo "#person".$i?>').cycle({ 
    fx:      'scrollRight', 
     next:   '#next', 
    prev:	'#prev',
    timeout:  0, 
     easing:  'easeInOutBack'

});

            $('.fancybox').fancybox({
               'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	true
            });    
            </script>
	<?php } ?>


	</div><!--mainCanvas-->

	
</body>
</html>



	
