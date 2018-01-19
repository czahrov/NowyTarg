<?php
	$data = getKultura( array( 'numberposts' => 6 ) );
	
?>
<div class="col-12 section_title kultura">
	<a href='<?php echo get_category_link( getCatByName( 'Kultura' ) ); ?>'>
		<h1>Kultura</h1>
	</a>
	<div class='row kultura'>
		<?php foreach( $data as $item ): ?>
		<a href="<?php the_permalink( $item->ID ); ?>" class="item col-12 col-md-6 col-xl-12">
			<div class="img_news_list d-flex">
				<div class="col-5 col-sm-4 img_link" style='background-image:url( <?php echo getPostImg( $item->ID, 'medium' ); ?> );'></div>
				<p class='col'>
					<?php echo $item->post_title; ?>
					<?php echo genPostIcon( $item->ID ); ?>
				</p>
			</div>
		</a>
		<?php endforeach; ?>
		<div class="col-md-12">
			<a class="load_more" item-segment='kultura' item-cat='<?php echo getCatByName( 'Kultura' ); ?>'>
				ZAŁADUJ WIĘCEJ
			</a>
			
		</div>
		
	</div>
</div>