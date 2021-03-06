<?php $dress = $GLOBALS['CC_CLOSET_DATA']['dress']; 

?>

	
		<div class="col-sm-5 main-image off small closet-summary-image">
			<?php
			if ( $thumbnail = get_the_post_thumbnail($dress->ID, 'dress-large') ) {
				echo $thumbnail;
			} else { 
				echo '<img src="' . get_bloginfo( 'template_directory' ) . '/_/img/Dress-Placeholder_01.png" />';
			}
			?>
		</div>
		<div class="col-sm-7">
			<?php
				$perma = get_post_permalink( $dress->ID );
				$designer = get_field('dress_designer', $dress->ID );
				$description = get_field('dress_description', $dress->ID );
				$size = get_field('dress_size', $dress->ID );
	
				echo ws_ifdef_do( $perma, ws_ifdef_concat('<a href="', $perma, '" >') );
				echo ws_ifdef_do( $designer, ws_ifdef_concat('<h1 class="uppercase dress-designer">',$designer,'</h1>') );
				echo ws_ifdef_do( $perma, '</a>' );
	
				echo ws_ifdef_do( $description, ws_ifdef_concat('<h6 class="dress-description">',$description,'</h6>') );
				echo ws_ifdef_do( wp_get_current_user(), ws_ifdef_do( $size, ws_ifdef_concat('<p class="h7">SIZE: <span class="numerals h8">',$size,'</span></p>') ) );
	
			?>
		</div>
	
		<div class="col-xs-12 visible-xs">
			<hr/>
		</div>
		
