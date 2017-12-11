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
			'type' => 'video',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => 'image',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => 'video',
			
		),
		
	);
	
?>
<div class="row">
	<div class="col-md-12 section_title">
		<h1>video i reportaże</h1>
	</div>
</div>
<!-- /.row -->
<div class="row clear reportaze">
	<div class="col-xl-9 ">
		<h2 class="red_title">Przegląd tygodniowy</h2>
		<div class="row">
			<div class="col-xl-8">
				<a href="<?php echo $data[0]['url']; ?>" class="link_post">
					<div class="overview" style='background-image: url(<?php echo $data[0]['img']; ?>);'>
						<img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/media/cover_img.png">
						<span><?php echo $data[0]['title']; ?></span>
					</div>
				</a>
			</div>
			<?php for( $i=1; $i<=4; $i++ ): ?>
			<div class="col-md-6 col-xl-4">
				<a class="link_post" href="<?php echo $data[$i]['url']; ?>">
					<div class="overview_small" style='background-image: url(<?php echo $data[0]['img']; ?>);'></div>
					<span class="post_news_small_tiitle"><?php echo $data[$i]['title']; ?></span>
				</a>
			</div>
			<?php endfor; ?>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.col-xl-9 -->
	<div class="col-xl-3 clear-mobile">
		<h2 class="red_title">Reportaże</h2>
		<ul class="top_news_list row">
			<?php
				for( $i=5; $i<count( $data ); $i++ ):
				$icon = '';
				switch( $data[$i]['type'] ){
					case 'video':
						$icon = " <i class='fa fa-play-circle-o'></i>";
					break;
					case 'image':
						$icon = " <i class='fa fa-picture-o'></i>";
					break;
					
				}
			?>
			<li class='col-md-6 col-xl-12'>
				<?php printf( "<a href='%s'>%s%s</a>",
					$data[$i]['url'],
					$data[$i]['title'],
					$icon
					
				); ?>
			</li>
			<?php endfor; ?>
		</ul>
	</div>
</div>