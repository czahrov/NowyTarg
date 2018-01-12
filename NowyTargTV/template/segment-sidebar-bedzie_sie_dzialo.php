<?php
	$data = getBedzieSieDzialo( array( 'numberposts' => 6 ) );
	
?>
<h1>Będzie się działo</h1>
<ul class="top_news_list row">
	<?php foreach( $data as $item ): ?>
	<li class='col-sm-6 col-lg-12'>
		<a href="<?php the_permalink( $item->ID ); ?>"><?php echo $item->post_title; ?></a>
	</li>
	<?php endforeach; ?>
	
</ul>