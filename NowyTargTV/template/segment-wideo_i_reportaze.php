<?php
	$przeglad = get_posts( array(
		'category_name' => 'Przegląd tygodniowy',
		'numberposts' => 5
		
	) );
	
	$reportaze = get_posts( array(
		'category_name' => 'Reportaże',
		'numberposts' => 10,
		
	) );
	
?>
<div class="row">
	<div class="col-md-12 section_title">
		<h1>video i reportaże</h1>
	</div>
</div>
<!-- /.row -->
<div class="row clear reportaze">
	<div class="col-xl-9 ">
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
		<h2 class="red_title">Reportaże</h2>
		<ul class="top_news_list row">
			<?php foreach( $reportaze as $item ): ?>
			<li class='col-md-6 col-xl-12'>
				<?php printf( "<a href='%s'>%s%s</a>",
					get_the_permalink( $item->ID ),
					$item->post_title,
					genPostIcon( $item->ID )
					
				); ?>
			</li>
			<?php endforeach; ?>
		</ul>
		<a class='gocategory' href='<?php echo get_category_link( getCatByName( 'Reportaże' ) ); ?>'>
			Zobacz więcej
		</a>
		
	</div>
</div>