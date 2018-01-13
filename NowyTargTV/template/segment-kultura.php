<?php
	$data = getKultura( array( 'numberposts' => 5 ) );
	
?>
<div class="col-xl-3 section_title kultura">
	<h1>Kultura</h1>
	<div class='row kultura'>
		<?php foreach( $data as $item ): ?>
		<a href="<?php the_permalink( $item->ID ); ?>" class="item col-md-6 col-xl-12">
			<div class="img_news_list d-flex">
				<div class="col-6 img_link" style='background-image:url( <?php echo getPostImg( $item->ID ); ?> );'></div>
				<p class='col-6'>
					<?php echo $item->post_title; ?>
					<?php echo genPostIcon( $item->ID ); ?>
				</p>
			</div>
		</a>
		<div class="dashed"></div>
		<?php endforeach; ?>
		
	</div>
	<a class='gocategory' href='<?php echo get_category_link( getCatByName( 'Kultura' ) ); ?>'>
		Zobacz więcej
	</a>
	
</div>
	