<?php
	$video = getLatestVideo( array( 'numberposts' => 2 ) );
	
	$promo = getLatestVideo( array( 
		'numberposts' => 1,
		'category__in' => array( getCatByName( 'Filmy promocyjne' ) ),
		
	) );
	
	$tags = getTagCloud();
	
?>
<div class="col-xl-3 section_title sidebar">
	<!-- najnowsze wideo -->
	<h1 class=''>Najnowsze Video</h1>
	<?php foreach( $video as $item ): ?>
	<a class="last_video_box clear" href='<?php the_permalink( $item->ID ); ?>'>
		<div class="play_icon"></div>
		<img src="<?php echo getPostImg( $item->ID, 'medium' ); ?>">
	</a>
	<?php endforeach; ?>
	<!-- filmy -->
	<h1 class="clear">Filmy Promocyjne</h1>
	<?php foreach( $promo as $item ): ?>
	<a href='<?php the_permalink( $item->ID ); ?>' class="last_video_box clear">
		<div class="play_icon"></div>
		<img src="<?php echo getPostImg( $item->ID, 'medium' ); ?>">
	</a>
	<?php endforeach; ?>
	<!-- znaczniki -->
	<h1 class="clear">Znaczniki portalu</h1>
	<ul class="hash_tags">
		<?php foreach( $tags as $item ): ?>
		<li>
			<a href="<?php echo get_tag_link( $item->term_id ); ?>"><?php echo $item->name; ?></a>
		</li>
		<?php endforeach; ?>
	</ul>
	<!-- rozkład jazdy -->
	<h1 class="clear">Rozkład jazdy</h1>
	<div class="last_video_box clear">
		<a href="http://www.mzk.nowytarg.pl/site/rozkladjazdy" target="_blank">
			<img src="<?php echo get_template_directory_uri(); ?>/media/mzk.png">
		</a>
	</div>
</div>