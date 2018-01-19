<?php
	
	$promo = getLatestVideo( array( 
		'numberposts' => 2,
		'category__in' => array( getCatByName( 'Filmy promocyjne' ) ),
		
	) );
	
?>
<h1 class="clear">Filmy Promocyjne</h1>
<div class='row'>
	<?php foreach( $promo as $item ): ?>
	<a class="last_video_box clear col-12 col-md-6 col-xl-12" href='<?php the_permalink( $item->ID ); ?>'>
		<?php echo genPostIcon( $item->ID ); ?>
		<img src="<?php echo getPostImg( $item->ID, 'large' ); ?>">
	</a>
	<?php endforeach; ?>
</div>