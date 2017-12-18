<?php
	$data = getKultura( array( 'numberposts' => 4 ) );
	
?>
<div class="col-xl-3 section_title">
	<h1>Kultura</h1>
	<div class='row'>
		<?php foreach( $data as $item ): ?>
		<a href="<?php the_permalink( $item->ID ); ?>" class="col-md-6 col-xl-12">
			<div class="row clear img_news_list">
				<div class="img_link">
					<img class="img-fluid mb-3 mb-md-0 img-side" src="<?php echo getPostImg( $item->ID ); ?>" alt="<?php echo $item->post_title; ?>">
				</div>
				<p>
					<?php echo $item->post_title; ?>
					<?php echo genPostIcon( $item->ID ); ?>
				</p>
			</div>
		</a>
		<div class="dashed"></div>
		<?php endforeach; ?>
		
	</div>
</div>
	