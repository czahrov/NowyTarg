<?php
	$data = getKultura( array( 'numberposts' => 5 ) );
	
?>
<div class="col-12 section_title kultura">
	<h1>Kultura</h1>
	<div class='row kultura'>
		<?php foreach( $data as $item ): ?>
		<a href="<?php the_permalink( $item->ID ); ?>" class="item col-12">
			<div class="img_news_list d-flex">
				<div class="col-5 col-sm-4 img_link" style='background-image:url( <?php echo getPostImg( $item->ID ); ?> );'></div>
				<p class='col'>
					<?php echo $item->post_title; ?>
					<?php echo genPostIcon( $item->ID ); ?>
				</p>
			</div>
		</a>
		<div class="dashed col-12"></div>
		<?php endforeach; ?>
		
	</div>
</div>