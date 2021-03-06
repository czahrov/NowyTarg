<?php	
	$num_p = empty( getUstawienia()[ 'przeglad_num' ] )?( 5 ):( (int)getUstawienia()[ 'przeglad_num' ][0] );
	$przeglad = get_posts( array(
		'category_name' => 'Przegląd tygodniowy',
		'numberposts' => $num_p,
		
	) );
	
	$num_r = empty( getUstawienia()[ 'reportaze_num' ] )?( 8 ):( (int)getUstawienia()[ 'reportaze_num' ][0] );
	$reportaze = get_posts( array(
		'category_name' => 'Reportaże',
		'numberposts' => $num_r,
		
	) );
	
?>
<div class="row clear reportaze">
	<div class="col-xl-9 ">
		<div class="section_title">
			<a href='<?php echo get_category_link( getCatByName( 'Przegląd tygodniowy' ) ); ?>'>
				<h1>Przegląd</h1>
			</a>
		</div>
		<h2 class="red_title">Przegląd tygodniowy</h2>
		<div class="row">
			<div class="col-xl-8">
				<?php $item = $przeglad[0]; ?>
				<a href="<?php the_permalink( $item->ID ) ?>" class="link_post big">
					<div class="overview" style='background-image: url(<?php echo getPostImg( $item->ID, 'full' ); ?>);'>
						<?php echo genPostIcon( $item->ID ); ?>
						<img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/media/cover_img.png">
						<span><?php echo $item->post_title ?></span>
					</div>
				</a>
			</div>
			<?php
				for( $i=1; $i<count( $przeglad ); $i++ ):
				$item = $przeglad[$i];
			?>
			<div class="col-md-6 col-xl-4">
				<a class="link_post" href="<?php echo the_permalink( $item->ID ); ?>">
					<div class="overview_small" style='background-image: url(<?php echo getPostImg( $item->ID, 'full' ); ?>);'>
						<?php echo genPostIcon( $item->ID ); ?>
					</div>
					<span class="post_news_small_tiitle"><?php echo $item->post_title; ?></span>
				</a>
			</div>
			<?php endfor; ?>
		</div>
		<a class='gocategory' href='<?php echo get_category_link( getCatByName( 'Przegląd tygodniowy' ) ); ?>'>
			Zobacz więcej
		</a>
		<!-- /.row -->
	</div>
	<!-- /.col-xl-9 -->
	<div class="col-xl-3 clear-mobile">
		<div class="section_title">
			<a href='<?php echo get_category_link( getCatByName( 'Reportaże' ) ); ?>'>
				<h1>Reportaże</h1>
			</a>
		</div>
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
		<a class='gocategory' href='<?php echo get_category_link( getCatByName( 'Reportaże' ) ); ?>'>
			Zobacz więcej
		</a>
		
	</div>
</div>