<?php
	$data = getPopulars();
	
?>
<div class="row">
	<div class="col-md-12 section_title">
		<h1>Najbardziej popularne</h1>
	</div>
</div>
<!-- /.row -->
<div class="row clear popularne">
	<?php
		foreach( $data as $item ):
		$cats = wp_get_post_categories( $item->ID, array(
			'term_taxonomy_id' => getBaseCats( array( 'exclude' => getCatByName( 'Popularne' ) ) ),
			
		) );
		$name = get_category( $cats[0] )->name;
		
	?>
	<div class="col-12 no-padding">
		<a href=<?php echo the_permalink( $item->ID ); ?>" class="link_post popular">
			<div class="last1" style='background-image: url(<?php echo getPostImg( $item->ID, 'full' ); ?>);'>
				<?php echo genPostIcon( $item->ID ); ?>
				<div class="post_category_small">
					<?php echo $name; ?>
				</div>
				<img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/media/cover_img.png">
				<span><?php echo $item->post_title; ?></span>
			</div>
		</a>
	</div>
	<?php endforeach; ?>
	
</div>
