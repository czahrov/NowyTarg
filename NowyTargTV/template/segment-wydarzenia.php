<?php
	$data = array(
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
		),
		
	);
	
?>
<div class="col-md-9 section_title wydarzenia">
	<h1>Wydarzenia</h1>
	<div class='slider'>
		<div class="row clear view">
			<?php foreach( $data as $num => $item ): ?>
			<div class="col-md-6 col-xl-4 item">
				<a class="link_post" href="<?php echo $item['url']; ?>">
					<div class="overview_small_photo" style='background-image: url(<?php echo $item['img']; ?>);'></div>
					<span class="post_news_small_tiitle">
						<?php echo $item['title'] . $num; ?>
					</span>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
		<div class='pagin'>
			<div class='item'></div>
		</div>
		<div class='arrow left fa fa-chevron-circle-left'></div>
		<div class='arrow right fa fa-chevron-circle-right'></div>
		
	</div>
	<div class="clear">
		<?php do_action( 'get_ad', 'large' ); ?>
	</div>
	<!-- /.row -->
</div>
