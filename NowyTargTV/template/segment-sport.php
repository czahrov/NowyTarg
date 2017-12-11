<?php
	$data = array(
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => '',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => '',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => '',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => '',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => '',
			
		),
		
		
	);
	
?>
<div class="col-xl-9 section_title">
	<h1>Sport</h1>
	<div class="row clear">
		<div class="col-xl-8">
			<a class="link_post" href="<?php echo $data[0]['url']; ?>">
				<div class="overview" style='background-image: url(<?php echo $data[0]['img']; ?>);'>
					<img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/media/cover_img.png">
					<span><?php echo $data[0]['title']; ?></span>
				</div>
			</a>
		</div>
		<?php for( $i=1; $i<count( $data ); $i++ ): ?>
		<div class="col-md-6 col-xl-4">
			<a class="link_post" href="<?php echo $data[$i]['url']; ?>">
				<div class="overview_small" style='background-image: url(<?php echo $data[$i]['img']; ?>);'></div>
				<span class="post_news_small_tiitle"><?php echo $data[$i]['title']; ?></span>
			</a>
		</div>
		<?php endfor; ?>
	</div>
	<!-- /.row -->
</div>
