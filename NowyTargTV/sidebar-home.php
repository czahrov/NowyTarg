<?php
	$video = array(
		array(
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
		),
		array(
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
		),
		
	);
	$promo = array(
		array(
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
		),
		
	);
	$tags = array(
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		array(
			'url' => '#',
			'name' => 'lorem ipsum',
		),
		
	);
	
?>
<div class="col-xl-3 section_title sidebar">
	<!-- najnowsze wideo -->
	<h1 class=''>Najnowsze Video</h1>
	<?php foreach( $video as $item ): ?>
	<a class="last_video_box clear" href='<?php echo $item['url']; ?>'>
		<div class="play_icon"></div>
		<img src="<?php echo $item['img']; ?>">
	</a>
	<?php endforeach; ?>
	<!-- filmy -->
	<h1 class="clear">Filmy Promocyjne</h1>
	<?php foreach( $promo as $item ): ?>
	<div class="last_video_box clear" href='<?php echo $item['url']; ?>'>
		<div class="play_icon"></div>
		<img src="<?php echo $item['img']; ?>">
	</div>
	<?php endforeach; ?>
	<!-- znaczniki -->
	<h1 class="clear">Znaczniki portalu</h1>
	<ul class="hash_tags">
		<?php foreach( $tags as $item ): ?>
		<li>
			<a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>
		</li>
		<?php endforeach; ?>
	</ul>
	<!-- rozkład jazdy -->
	<h1 class="clear">Rozkład jazdy</h1>
	<div class="last_video_box clear">
		<img src="<?php echo get_template_directory_uri(); ?>/media/mzk.png">
	</div>
</div>