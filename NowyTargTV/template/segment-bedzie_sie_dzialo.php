<?php
	$num = empty( getUstawienia()[ 'bedzie_num' ] )?( 5 ):( (int)getUstawienia()[ 'bedzie_num' ][0] );
	$data = getBedzieSieDzialo( array(
		'numberposts' => $num,
		
	) );
	
?>
<div class="col-md-9 section_title wydarzenia">
	<a href='<?php echo get_category_link( getCatByName( 'Będzie się działo' ) ); ?>'>
		<h1>Będzie się działo</h1>
	</a>
	<div class='slider'>
		<div class="row clear view">
			<?php foreach( $data as $num => $item ): ?>
			<div class="col-12 col-md-6 col-xl-4 item">
				<a class="link_post" href="<?php the_permalink( $item->ID ); ?>">
					<div class="overview_small_photo" style='background-image: url(<?php echo getPostImg( $item->ID, 'medium' ); ?>);'></div>
					<span class="post_news_small_tiitle">
						<?php echo $item->post_title; ?>
					</span>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
		<div class='pagin'>
			<div class='item'></div>
		</div>
		<div class='arrow left fa fa-chevron-circle-left'></div>
		<div class='arrow right fa fa-chevron-circle-right'></div>
		
	</div>
	<div class="clear">
		<?php do_action( 'get_ad', 'home_slider' ); ?>
	</div>
	<!-- /.row -->
</div>
