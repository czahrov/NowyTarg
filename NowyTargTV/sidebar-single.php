<?php
	$wiecej = getLatestNews( array( 'numberposts' => 5 ) );
	
?>
<div class="col-lg-3 clear-mobile section_title sidebar-single">
	<div class='d-none d-xl-block'>
		<?php  if( !isMobile() ) do_action( 'get_ad', 'single_sidebar_top' ); ?>
	</div>
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
	<!-- będzie się działo -->
	<?php get_template_part( "template/segment-sidebar", "bedzie_sie_dzialo" ); ?>
	<div class='d-none d-xl-block'>
		<?php if( !isMobile() ) do_action( 'get_ad', 'single_sidebar_mid' ); ?>
	</div>
	<!-- najnowsze wideo -->
	<?php get_template_part( "template/segment-sidebar", "najnowsze_video" ); ?>
	<!-- filmy -->
	<?php get_template_part( "template/segment-sidebar", "video_promocyjne" ); ?>
	
</div>