<?php
	$data = getWydarzenia( array( 'numberposts' => 6 ) );
	
?>
<div class="col-md-9 section_title wydarzenia">
	<h1>Wydarzenia</h1>
	<div class='slider'>
		<div class="row clear view">
			<?php foreach( $data as $num => $item ): ?>
			<div class="col-12 col-md-6 col-xl-4 item">
				<a class="link_post" href="<?php the_permalink( $item->ID ); ?>">
					<div class="overview_small_photo" style='background-image: url(<?php echo getPostImg( $item->ID ); ?>);'></div>
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
