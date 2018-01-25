<?php
	if( isMobile() ){
		$num = empty( getUstawienia()[ 'more_mob_num' ] )?( 5 ):( (int)getUstawienia()[ 'more_mob_num' ][0] );
		
	}
	else{
		$num = empty( getUstawienia()[ 'more_num' ] )?( 5 ):( (int)getUstawienia()[ 'more_num' ][0] );
		
	}
	
	$wiecej = getLatestNews( array(
		'numberposts' => $num,
		
	) );
	
?>
<h1 class="clear">Zobacz więcej</h1>
<div class='row'>
	<?php foreach( $wiecej as $item ): ?>
	<div class="see-more-ex col-md-6 col-lg-12">
		<a href="<?php echo the_permalink( $item->ID ); ?>">
			<div class='img' style='background-image:url( <?php echo getPostImg( $item->ID, 'large' ); ?> )'></div>
			<p>
				<?php echo $item->post_title; ?>
			</p>
		</a>
	</div>
	<?php endforeach; ?>
	
</div>