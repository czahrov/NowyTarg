<?php
	$wydarzenia = getWydarzenia( array( 'numberposts' => 6 ) );
	
	$video = getLatestVideo( array( 'numberposts' => 2 ) );
	
	$promo = getLatestVideo( array( 
		'numberposts' => 2,
		'category__in' => array( getCatByName( 'Filmy promocyjne' ) ),
		
	) );
	
?>

<div class="col-xl-3 clear-mobile section_title">
	<h1>Wydarzenia</h1>
	<ul class="top_news_list row">
		<?php foreach( $wydarzenia as $item ): ?>
		<li class='col-sm-6 col-xl-12'>
			<a href="<?php the_permalink( $item->ID ); ?>">
				<?php echo $item->post_title; ?>
				<?php echo genPostIcon( $item->ID ); ?>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
	<div class='d-none d-xl-block'>
		<?php do_action( 'get_ad', 'tag_sidebar' ); ?>
	</div>
	<h1 class="clear">Najnowsze Video</h1>
	<?php foreach( $video as $item ): ?>
	<a href='<?php the_permalink( $item->ID ); ?>' class="last_video_box clear">
		<?php echo genPostIcon( $item->ID ); ?>
		<img src="<?php echo getPostImg( $item->ID ); ?>">
	</a>
	<?php endforeach; ?>
	<h1 class="clear">Filmy Promocyjne</h1>
	<?php foreach( $promo as $item ): ?>
	<a href='<?php the_permalink( $item->ID ); ?>' class="last_video_box clear">
		<?php echo genPostIcon( $item->ID ); ?>
		<img src="<?php echo getPostImg( $item->ID ); ?>">
	</a>
	<?php endforeach; ?>
</div>