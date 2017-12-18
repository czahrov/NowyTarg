<?php
	$current_cat = get_category( wp_get_post_categories( get_post()->ID )[0] );
	$wiecej = get_posts( array(
		'exclude' => array( get_post()->ID ),
		'numberposts' => 5,
		'category' => $current_cat->cat_ID,
		
	) );
	
	$wydarzenia = getWydarzenia( array( 'numberposts' => 6 ) );
	
	$video = getLatestVideo( array( 'numberposts' => 2 ) );
	
	$promo = getLatestVideo( array( 
		'numberposts' => 2,
		'category__in' => array( getCatByName( 'Filmy promocyjne' ) ),
		
	) );
	
?>
<div class="col-lg-3 clear-mobile section_title">
	<?php do_action( 'get_ad', 'vertical' ); ?>
	<h1 class="clear">Zobacz więcej</h1>
	<div class='row'>
		<?php foreach( $wiecej as $item ): ?>
		<div class="see-more-ex col-md-6 col-lg-12">
			<a href="<?php echo the_permalink( $item->ID ); ?>">
				<img src="<?php echo getPostImg( $item->ID ); ?>">
				<p>
					<?php echo $item->post_title; ?>
				</p>
			</a>
		</div>
		<?php endforeach; ?>
		
	</div>
	<h1>Wydarzenia</h1>
	<ul class="top_news_list row">
		<?php foreach( $wydarzenia as $item ): ?>
		<li class='col-sm-6 col-lg-12'>
			<a href="<?php the_permalink( $item->ID ); ?>"><?php echo $item->post_title; ?></a>
		</li>
		<?php endforeach; ?>
		
	</ul>
	<?php do_action( 'get_ad', 'vertical' ); ?>
	<h1 class="clear">Najnowsze Video</h1>
	<?php foreach( $video as $item ): ?>
	<a href='<?php echo the_permalink( $item->ID ); ?>' class="last_video_box clear">
		<div class="play_icon"></div>
		<img src="<?php echo getPostImg( $item->ID ); ?>">
	</a>
	<?php endforeach; ?>
	<h1 class="clear">Filmy Promocyjne</h1>
	<?php foreach( $promo as $item ): ?>
	<a href='<?php the_permalink( $item->ID ); ?>' class="last_video_box clear">
		<div class="play_icon"></div>
		<img src="<?php echo getPostImg( $item->ID ); ?>">
	</a>
	<?php endforeach; ?>
</div>