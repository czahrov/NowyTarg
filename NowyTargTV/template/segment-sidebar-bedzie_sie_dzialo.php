<?php
	$data = getBedzieSieDzialo( array( 'numberposts' => 6 ) );
	
?>
<h1>Będzie się działo</h1>
<ul class="top_news_list row">
	<?php
		foreach( $data as $item ):
	?>
	
	<a href="<?php the_permalink( $item->ID ); ?>" class="item col-12 col-md-6 col-lg-12">
		<div class="img_news_list d-flex">
			<div class="img_link col-4 col-lg-3 col-xl-4" style='background-image:url( <?php echo getPostImg( $item->ID ); ?> );'>
				<?php echo genPostIcon( $item->ID ); ?>
			</div>
			<p class='col'>
				<?php echo $item->post_title; ?>
			</p>
		</div>
	</a>
	
	<?php
		endforeach;
	?>
</ul>