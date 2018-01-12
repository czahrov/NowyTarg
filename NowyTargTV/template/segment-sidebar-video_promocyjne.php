<?php
	
	$promo = getLatestVideo( array( 
		'numberposts' => 2,
		'category__in' => array( getCatByName( 'Filmy promocyjne' ) ),
		
	) );
	
?>
<h1 class="clear">Filmy Promocyjne</h1>
<?php foreach( $promo as $item ): ?>
<a href='<?php the_permalink( $item->ID ); ?>' class="last_video_box clear">
	<?php echo genPostIcon( $item->ID ); ?>
	<img src="<?php echo getPostImg( $item->ID, 'large' ); ?>">
</a>
<?php endforeach; ?>