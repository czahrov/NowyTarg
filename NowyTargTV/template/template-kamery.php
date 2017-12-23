<?php
/*
	Template Name: Kamery Online
*/
	
	get_header();
	get_template_part( 'template/part', 'top' );
	
	$kamery = get_posts( array(
		'category_name' => 'kamera-online',
		
	) );
	
?>
<div id='kamery' class='container'>
	<div class='row'>
		<?php
			foreach( $kamery as $item ):
			$title = get_post_meta( $item->ID, 'title', true );
			$img = wp_get_attachment_image_url( get_post_meta( $item->ID, 'img', true ), 'full' );
			$uri = get_post_meta( $item->ID, 'uri', true );
		?>
		<a class='item col-12 col-sm-4 col-lg-3 col-xl-2' href='<?php echo $uri; ?>' target='_blank'>
			<?php if( !empty( $img ) ): ?>
			<div class='img' style='background-image:url(<?php echo $img; ?>);'>
				<div class='wrapper'></div>
			</div>
			<?php endif; ?>
			<div class='title text-center d-flex align-items-center justify-content-center'>
				<div class='icon fa fa-play-circle'></div>
				<div class='text'><?php echo $title; ?></div>
				
			</div>
			
		</a>
		<?php endforeach; ?>
		
	</div>
	
</div>

<?php
	get_template_part( 'template/part', 'bot' );
	get_footer();
?>