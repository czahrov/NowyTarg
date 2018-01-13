<?php
	$data =getOgloszenia( array( 'numberposts' => 4 ) );
	
?>
<div class="col-xl-9 section_title ogloszenia">
	<h1>Ogłoszenia urzędowe</h1>
	<?php
		foreach( $data as $num => $item ):
		if( $num === 2 ) do_action( 'get_ad', 'home_ogloszenia' );
	?>
	<div class="row clear city_news">
		<a href="<?php the_permalink( $item->ID ); ?>" class="list_post col-sm-4">
			<div class="img" style='background-image:url( <?php echo getPostImg( $item->ID, 'large' ); ?> )'></div>
		</a>
		<div class="col-sm-8">
			<h3><?php echo $item->post_title; ?></h3>
			<p><?php echo $item->post_excerpt; ?></p>
			<a href="<?php the_permalink( $item->ID ); ?>" class="wiecej">czytaj dalej</a>
		</div>
	</div>
	<!-- /.row -->
	<div class="dashed"></div>
	<?php endforeach; ?>
	<a class='gocategory' href='<?php echo get_category_link( getCatByName( 'Ogłoszenia urzędowe' ) ); ?>'>
		Zobacz więcej
	</a>
	<?php do_action( 'get_ad', 'home_bot' ); ?>
</div>
