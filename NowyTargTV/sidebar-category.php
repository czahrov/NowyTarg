<?php
	$wydarzenia = array(
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'type' => 'video',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'type' => 'video',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'type' => '',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'type' => '',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'type' => 'img',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'type' => 'img',
			
		),
		
	);
	
?>
<?php
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
	
?>
<?php
	$promo = array(
		array(
			'img' => 'http://via.placeholder.com/280x160?text=obrazek',
			'url' => '#',
		),
		
	);
	
?>

<div class="col-xl-3 clear-mobile section_title">
	<h1>Wydarzenia</h1>
	<ul class="top_news_list row">
		<?php foreach( $wydarzenia as $item ): ?>
		<li class='col-sm-6 col-xl-12'>
			<a href="<?php echo $item['url']; ?>">
				<?php
					echo $item['title'];
					if( $item['type'] === 'video' ):
				?>
				<i class="fa fa-play-circle-o"></i>
				<?php elseif( $item['type'] === 'img' ): ?>
				<i class="fa fa-picture-o"></i>
				<?php endif; ?>
			</a>
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