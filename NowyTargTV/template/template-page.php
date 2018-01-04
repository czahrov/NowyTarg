<?php
/*
	Template Name: Szablon - standardowa strona
*/
	
	get_header();
	get_template_part( 'template/part', 'top' );
	$post = get_post();
	
?>
<div id='page' class='container'>
	<div class='title'></div>
	<div class='content'>
		<?php echo apply_filters( 'the_content', $post->post_content ); ?>
	</div>
	
</div>

<?php
	get_template_part( 'template/part', 'bot' );
	get_footer();
?>