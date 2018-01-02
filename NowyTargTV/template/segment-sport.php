<?php
	$data = getSport( array(
		'numberposts' => 5,
		
	) );
	
?>
<div class="col-xl-9 section_title">
	<h1>Sport</h1>
	<div class="row clear">
		<div class="col-xl-8">
			<?php $item = $data[0]; ?>
			<a class="link_post big" href="<?php the_permalink( $item->ID, 'large' ); ?>">
				<?php echo genPostIcon( $item->ID ); ?>
				<div class="overview" style='background-image: url(<?php echo getPostImg( $item->ID, 'large' ); ?>);'>
					<img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/media/cover_img.png">
					<span><?php echo $item->post_title; ?></span>
				</div>
			</a>
		</div>
		<?php
			for( $i=1; $i<count( $data ); $i++ ):
			$item = $data[$i];
		?>
		<div class="col-md-6 col-xl-4">
			<a class="link_post" href="<?php the_permalink( $item->ID ); ?>">
				<div class="overview_small" style='background-image: url(<?php echo getPostImg( $item->ID, 'medium' ); ?>);'>
					<?php echo genPostIcon( $item->ID ); ?>
				</div>
				<span class="post_news_small_tiitle"><?php echo $item->post_title; ?></span>
			</a>
		</div>
		<?php endfor; ?>
	</div>
	<!-- /.row -->
</div>
