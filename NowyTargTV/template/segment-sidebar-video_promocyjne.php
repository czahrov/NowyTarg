<?php
	if( isMobile() ){
		$num = empty( getUstawienia()[ 'promocyjne_mob_num' ] )?( 2 ):( (int)getUstawienia()[ 'promocyjne_mob_num' ][0] );
		
	}
	else{
		$num = empty( getUstawienia()[ 'promocyjne_num' ] )?( 2 ):( (int)getUstawienia()[ 'promocyjne_num' ][0] );
		
	}
	
	$promo = getLatestVideo( array( 
		'numberposts' => $num,
		'category__in' => array( getCatByName( 'Filmy promocyjne' ) ),
		
	) );
	
?>
<h1 class="clear">Filmy Promocyjne</h1>
<div class='row'>
	<?php foreach( $promo as $item ): ?>
	<a class="last_video_box clear col-12 col-md-6 col-lg-12" href='<?php the_permalink( $item->ID ); ?>'>
		<?php echo genPostIcon( $item->ID ); ?>
		<img src="<?php echo getPostImg( $item->ID, 'large' ); ?>">
	</a>
	<?php endforeach; ?>
</div>