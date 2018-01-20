<?php
	$przeglad = get_posts( array(
		'category_name' => 'Przegląd tygodniowy',
		'numberposts' => 7
		
	) );
	
	$reportaze = get_posts( array(
		'category_name' => 'Reportaże',
		'numberposts' => 12,
		
	) );
	
?>
<div class="row">
	<div class="col-md-12 section_title">
		<a href='<?php echo get_category_link( getCatByName( 'Przegląd tygodniowy' ) ); ?>'>
			<h1>Przegląd</h1>
		</a>
	</div>
</div>
<!-- /.row -->
<div class="row clear reportaze">
	<div class="col-12 ">
		<h2 class="red_title">Przegląd tygodniowy</h2>
		<div class="row no-gutters">
			<?php
			foreach( $przeglad as $num => $item ):
			if( $num === 0 ):
			?>
			<a class="link_post big col-12" href="<?php the_permalink( $item->ID ); ?>">
				<div class="post_news_big" style='background-image: url(<?php echo getPostImg( $item->ID, 'full' ); ?>);'>
					<?php echo genPostIcon( $item->ID ); ?>
					<img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/media/cover_img.png">
					<span><?php echo $item->post_title; ?></span>
				</div>
			</a>
			<?php else: ?>
			<a class="link_post col-6" href="<?php the_permalink( $item->ID ); ?>">
				<div class="post_news_small col-12" style='background-image: url(<?php echo getPostImg( $item->ID, 'large' ); ?>);'>
					<?php echo genPostIcon( $item->ID ); ?>
				</div>
				<span class="post_news_small_tiitle d-block col-12"><?php echo $item->post_title; ?></span>
			</a>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="col-md-12">
				<a class="load_more" item-segment='przeglad' item-cat='<?php echo getCatByName( 'Przegląd tygodniowy' ); ?>'>
					ZAŁADUJ WIĘCEJ
				</a>
				
			</div>
		</div>
		<!-- /.row -->
	</div>
</div>
<div class="row">
	<div class="col-md-12 section_title">
		<a href='<?php echo get_category_link( getCatByName( 'Reportaże' ) ); ?>'>
			<h1>Reportaże</h1>
		</a>
	</div>
</div>
	<!-- /.col-xl-9 -->
<div class="row clear reportaze">
	<div class="col-12 clear-mobile">
		<h2 class="red_title">Reportaże</h2>
		<ul class="top_news_list row">
			<?php foreach( $reportaze as $item ): ?>
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
			<?php endforeach; ?>
		</ul>
		<a class="load_more" item-segment='reportaze' item-cat='<?php echo getCatByName( 'Reportaże' ); ?>'>
			ZAŁADUJ WIĘCEJ
		</a>
	</div>
</div>