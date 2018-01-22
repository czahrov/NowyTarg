<div class="col-lg-3 clear-mobile section_title sidebar-single">
	<div class='d-none d-xl-block'>
		<?php  if( !isMobile() ) do_action( 'get_ad', 'single_sidebar_top' ); ?>
	</div>
	<?php get_template_part( "template/segment-sidebar", "more" ); ?>
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