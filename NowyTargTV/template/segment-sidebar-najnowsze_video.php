<?php
	if( isMobile() ){
		$num = empty( getUstawienia()[ 'video_mob_num' ] )?( 2 ):( (int)getUstawienia()[ 'video_mob_num' ][0] );
		
	}
	else{
		$num = empty( getUstawienia()[ 'video_num' ] )?( 2 ):( (int)getUstawienia()[ 'video_num' ][0] );
		
	}
	
	$video = getLatestVideo( array( 
		'numberposts' => $num,
		
	) );
	
?>

<h1 class="clear">Najnowsze Video</h1>
<div class='row'>
	<?php foreach( $video as $item ): ?>
	<a class="last_video_box clear col-12 col-md-6 col-lg-12" href='<?php the_permalink( $item->ID ); ?>'>
		<?php echo genPostIcon( $item->ID ); ?>
		<img src="<?php echo getPostImg( $item->ID, 'large' ); ?>">
	</a>
	<?php endforeach; ?>
</div>