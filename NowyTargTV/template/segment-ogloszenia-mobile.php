<?php
	$num = empty( getUstawienia()[ 'ogloszenia_mob_num' ] )?( 4 ):( (int)getUstawienia()[ 'ogloszenia_mob_num' ][0] );
	$data =getOgloszenia( array(
		'numberposts' => $num,
		
	) );
	
?>
<div class="col-12 section_title ogloszenia">
	<a href='<?php echo get_category_link( getCatByName( 'Ogłoszenia urzędowe' ) ); ?>'>
		<h1>Ogłoszenia urzędowe</h1>
	</a>
	<div class="row clear city_news no-gutters">
		<?php
			foreach( $data as $num => $item ):
			if( $num === 2 ) do_action( 'get_ad', 'home_ogloszenia' );
		?>
		<div class='item clear col-6 no-gutters'>
			<a href="<?php the_permalink( $item->ID ); ?>" class="list_post col-12">
				<div class="img" style='background-image:url( <?php echo getPostImg( $item->ID, 'large' ); ?> )'></div>
			</a>
			<div class="col-12">
				<h3><?php echo $item->post_title; ?></h3>
				<p><?php echo $item->post_excerpt; ?></p>
				<a href="<?php the_permalink( $item->ID ); ?>" class="wiecej">czytaj dalej</a>
			</div>
		</div>
		<!-- /.row -->
		<?php endforeach; ?>
	</div>
	<?php do_action( 'get_ad', 'home_bot' ); ?>
</div>
