<?php

	$video = getLatestVideo( array( 'numberposts' => 2 ) );
	
?>

<h1 class="clear">Najnowsze Video</h1>
<?php foreach( $video as $item ): ?>
<a href='<?php the_permalink( $item->ID ); ?>' class="last_video_box clear">
	<?php echo genPostIcon( $item->ID ); ?>
	<img src="<?php echo getPostImg( $item->ID, 'large' ); ?>">
</a>
<?php endforeach; ?>