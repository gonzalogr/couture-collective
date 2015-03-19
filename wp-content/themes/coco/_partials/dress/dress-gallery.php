<?php
	$images = get_field('dress_images', get_the_ID() );

	if ( $images ) {

		//var_dump($images);

?>

	<div class="row">
		<?php if (count( $images ) > 1) : ?>
		<div class="col-sm-2 hidden-xs">
		<ul class="row">
			<?php for ( $i = 1; $i < count( $images ); $i++ ) : ?>
				<li class="small-image co-sm-12 main-image m">
					<a href="#">
					<img src-giant="<?php echo $images[ $i ]['sizes']['full']; ?>" src-large="<?php echo $images[ $i ]['sizes']['large']; ?>" src="<?php echo $images[ $i ]['sizes']['thumbnail']; ?>" />
					</a>
				</li>

			<?php endfor; ?>
		</ul>
		</div>
	<?php endif; ?>

		<div id="main-image" class="col-sm-10 col-xs-12 main-image off">
			<?php 
			if ( has_post_thumbnail() ) { ?>

				<div src-giant="<?php echo $images[ 0 ]['sizes']['full']; ?>" class="magnifier"></div>
				<img src-giant="<?php echo $images[ $i ]['sizes']['full']; ?>" src-small="<?php echo $images[ 0 ]['sizes']['thumbnail']; ?>" src="<?php echo $images[ 0 ]['sizes']['large']; ?>" />
				
			<?php } else {
				echo '<img src="' . get_bloginfo( 'template_directory' ) . '/_/img/thumbnail-default.jpg" />';
			}
			?>	
			
		</div>
	</div>

<?php
	} else {
?>


<?php
	}
?>