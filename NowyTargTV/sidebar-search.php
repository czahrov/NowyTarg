<?php
	
	
?>

<div class="col-xl-3 clear-mobile section_title">
	<!-- będzie się działo -->
	<?php get_template_part( "template/segment-sidebar", "bedzie_sie_dzialo" ); ?>
	<div class='d-none d-xl-block'>
		<?php do_action( 'get_ad', 'search_sidebar' ); ?>
	</div>
	<!-- najnowsze wideo -->
	<?php get_template_part( "template/segment-sidebar", "najnowsze_video" ); ?>
	<!-- filmy -->
	<?php get_template_part( "template/segment-sidebar", "video_promocyjne" ); ?>
	
</div>