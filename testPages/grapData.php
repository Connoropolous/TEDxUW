<!DOCTYPE html>
<html>
<head>

	<?php
	  require_once("../formtools/global/api/api.php");
	  ft_api_clear_form_sessions();
	?>
    

</head>

<body>

<?php
$ideas = array();
$num_submissions = ft_api_show_submission_count(1);
$forms = ft_api_get_finalized_submissions(1);


	for ($i = 0; $i <= $num_submissions; $i++) {
			echo $forms[$i]["username"];
			echo(" , ");
			
		}
		
		
		
?>

</body>

</html>