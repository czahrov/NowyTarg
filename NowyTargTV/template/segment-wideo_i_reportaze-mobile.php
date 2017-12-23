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
		<h1>video i reportaże</h1>
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
				<div class="post_news_big" style='background-image: url(<?php echo getPostImg( $item->ID ); ?>);'>
					<?php echo genPostIcon( $item->ID ); ?>
					<img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/media/cover_img.png">
					<span><?php echo $item->post_title; ?></span>
				</div>
			</a>
			<?php else: ?>
			<a class="link_post col-6" href="<?php the_permalink( $item->ID ); ?>">
				<div class="post_news_small col-12" style='background-image: url(<?php echo getPostImg( $item->ID ); ?>);'>
					<?php echo genPostIcon( $item->ID ); ?>
				</div>
				<span class="post_news_small_tiitle d-block col-12"><?php echo $item->post_title; ?></span>
			</a>
			<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.col-xl-9 -->
	<div class="col-12 clear-mobile">
		<h2 class="red_title">Reportaże</h2>
		<ul class="top_news_list">
			<?php foreach( $reportaze as $item ): ?>
			<li class='col-12'>
				<?php printf( "<a href='%s'>%s%s</a>",
					get_the_permalink( $item->ID ),
					$item->post_title,
					genPostIcon( $item->ID )
					
				); ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>