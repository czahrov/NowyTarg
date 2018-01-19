<?php

	$video = getLatestVideo( array( 'numberposts' => 2 ) );
	
?>

<h1 class="clear">Najnowsze Video</h1>
<div class='row'>
	<?php foreach( $video as $item ): ?>
	<a class="last_video_box clear col-12 col-md-6 col-xl-12" href='<?php the_permalink( $item->ID ); ?>'>
		<?php echo genPostIcon( $item->ID ); ?>
		<img src="<?php echo getPostImg( $item->ID, 'large' ); ?>">
	</a>
	<?php endforeach; ?>
</div>