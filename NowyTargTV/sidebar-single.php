<?php
	/* $post = get_post();
	$cats = wp_get_post_categories( $post->ID, array() );
	
	$posts = get_posts( array(
		'category' => $cats[0],
		'numberposts' => 5,
		
	) ); */
	
	$wiecej = array(
		array(
			'title' => 'Lorem ipsum tytuł',
			'url' => '#',
			'img' => 'http://via.placeholder.com/280x160?text=obrazek',
			
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'url' => '#',
			'img' => 'http://via.placeholder.com/280x160?text=obrazek',
			
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'url' => '#',
			'img' => 'http://via.placeholder.com/280x160?text=obrazek',
			
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'url' => '#',
			'img' => 'http://via.placeholder.com/280x160?text=obrazek',
			
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'url' => '#',
			'img' => 'http://via.placeholder.com/280x160?text=obrazek',
			
		),
		
	);
	
	$wydarzenia = array(
		array(
			'title' => 'Lorem ipsum tytuł',
			'url' => '#',
			
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'url' => '#',
			
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'url' => '#',
			
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'url' => '#',
			
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'url' => '#',
			
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'url' => '#',
			
		),
		
	);
	
	$video = array(
		array(
			'img' => 'http://via.placeholder.com/280x160?text=obrazek',
			'url' => '#',
			
		),
		array(
			'img' => 'http://via.placeholder.com/280x160?text=obrazek',
			'url' => '#',
			
		),
		
	);
	
	$promo = array(
		array(
			'img' => 'http://via.placeholder.com/280x160?text=obrazek',
			'url' => '#',
			
		),
		
	);
	
?>
<div class="col-lg-3 clear-mobile section_title">
	<?php do_action( 'get_ad', 'vertical' ); ?>
	<h1 class="clear">Zobacz więcej</h1>
	<div class='row'>
		<?php foreach( $wiecej as $item ): ?>
		<div class="see-more-ex col-md-6 col-lg-12">
			<a href="<?php echo $item['url']; ?>">
				<img src="<?php echo $item['img']; ?>">
				<p>
					<?php echo $item['title']; ?>
				</p>
			</a>
		</div>
		<?php endforeach; ?>
		
	</div>
	<h1>Wydarzenia</h1>
	<ul class="top_news_list row">
		<?php foreach( $wydarzenia as $item ): ?>
		<li class='col-sm-6 col-lg-12'>
			<a href="<?php echo $item['url'] ?>"><?php echo $item['title']; ?></a>
		</li>
		<?php endforeach; ?>
		
	</ul>
	<?php do_action( 'get_ad', 'vertical' ); ?>
	<h1 class="clear">Najnowsze Video</h1>
	<?php foreach( $video as $item ): ?>
	<a href='<?php echo $item['url']; ?>' class="last_video_box clear">
		<div class="play_icon"></div>
		<img src="<?php echo $item['img']; ?>">
	</a>
	<?php endforeach; ?>
	<h1 class="clear">Filmy Promocyjne</h1>
	<?php foreach( $promo as $item ): ?>
	<a href='<?php echo $item['url']; ?>' class="last_video_box clear">
		<div class="play_icon"></div>
		<img src="<?php echo $item['img']; ?>">
	</a>
	<?php endforeach; ?>
</div>