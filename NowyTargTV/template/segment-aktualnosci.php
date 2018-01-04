<?php
	$data = getAktualnosci( array(
		'numberposts' => 11,
		
	) );
	
?>
<div class="row section_title aktualnosci">
	<div class="col-md-12">
		<h1>Aktualności</h1>
	</div>
	<div class="col-xl-6">
		<?php $item = $data[0]; ?>
		<a class="link_post big" href="<?php the_permalink( $item->ID ); ?>">
			<div class="post_news_big" style='background-image: url(<?php echo getPostImg( $item->ID, 'full' ); ?>);'>
				<?php echo genPostIcon( $item->ID ); ?>
				<img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/media/cover_img.png">
				<span><?php echo $item->post_title; ?></span>
			</div>
		</a>
	</div>
	<!-- /.col-md-6 -->
	<div class="col-xl-3 clear-mobile">
		<div class='row'>
			<?php
				for( $i=1; $i<=2; $i++ ):
				$item = $data[$i];
			?>
			<a class="link_post col-12 col-md-6 col-xl-12" href="<?php the_permalink( $item->ID ); ?>">
				<div class="post_news_small" style='background-image: url(<?php echo getPostImg( $item->ID, 'full' ); ?>);'>
					<?php echo genPostIcon( $item->ID ); ?>
				</div>
				<span class="post_news_small_tiitle"><?php echo $item->post_title; ?></span>
			</a>
			<?php endfor; ?>
		</div>
	</div>
	<!-- /.col-md-3 -->
	<div class="col-xl-3 clear-mobile">
		<h2 class="red_title">Najnowsze wiadomości</h2>
		<ul class="top_news_list row">
			<?php for( $i=3; $i<count( $data ); $i++ ): ?>
			<li class='col-md-6 col-xl-12'>
				<?php printf( "<a href='%s'>%s%s</a>",
					get_the_permalink( $data[$i]->ID ),
					$data[$i]->post_title,
					genPostIcon( $item->ID )
					
				); ?>
			</li>
			<?php endfor;?>
		</ul>
	</div>
	<!-- /.col-md-3 -->
</div>
