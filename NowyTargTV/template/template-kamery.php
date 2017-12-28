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
	<?php do_action( 'breadcrumb' ); ?>
	<div class='row'>
		<?php
			foreach( $kamery as $item ):
			$title = get_post_meta( $item->ID, 'title', true );
			$typ = get_post_meta( $item->ID, 'typ', true );
			
			if( $typ === 'ipcamlive' ):
			$alias = get_post_meta( $item->ID, 'alias', true );
		?>
		<div class='item col-12 col-md-6 col-xl-4 d-flex flex-column'>
			<iframe class='' src="http://ipcamlive.com/player/player.php?alias=<?php echo $alias; ?>" frameborder="0" allowfullscreen></iframe>
			<div class='title text-center d-flex align-items-center justify-content-center'>
				<div class='icon fa fa-play-circle'></div>
				<div class='text'><?php echo $title; ?></div>
				
			</div>
			
		</div>
		<?php
			else:
			$img = wp_get_attachment_image_url( get_post_meta( $item->ID, 'img', true ), 'full' );
			$uri = get_post_meta( $item->ID, 'uri', true );
		?>
		<a class='item col-12 col-md-6 col-xl-4 d-flex flex-column' href='<?php echo $uri; ?>' target='_blank'>
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
		<?php endif; ?>
		<?php endforeach; ?>
		
	</div>
	
</div>

<?php
	get_template_part( 'template/part', 'bot' );
	get_footer();
?>