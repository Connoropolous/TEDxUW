
	
	<?php
		$imageSizes = array(100, 110, 120, 130, 120, 110, 100);
		$ideas = ft_api_get_finalized_submissions(1); ?>
		<?php
		for ($i = 8; $i <= 14; $i++) {
			$x = 1;
			$k = 0; 
			while($i+$x < 200){
				$idea[$k] = $ideas[$i*$x - 1];
				$x += 21;
				$k += 1; 
			}
		
		
	?> 
	<div class="personGrandparent">
	<div id="personParent<? echo $i ?>">
	<div class="person" id="person<? echo $i ?>">
            	<?php for($j = 0;$j <= $k; $j++) { ?>
            
            	
            	<?php if(isset($idea[$j]["photourl"]) == false ){
    				#$photourl = "images/anonymous.jpg";
					$photourl = $idea[$j]["usercloud"];
    			}
    			else {
	    			$photourl = $idea[$j]["photourl"];
	
    			}
    			?>
            
            	 <a href="<?php echo $photourl; ?>" class="fancybox" title="<?php echo $idea[$j]["username"]?>" rel="gallery"><img src="<?php echo $photourl; ?>"
            	 
            	class="personImage" style="width:<?php echo $imageSizes[$i-8]."px"?>;height:<?php echo $imageSizes[$i-8]."px"?>;"
            	 
	        
            	 />
            	 
            	 </a>
	            	<?php } ?>
            </div>
            </div><!--PersonParent-->
            </div><!--PersonGrandparent-->
	<?php } ?>
	

	
	