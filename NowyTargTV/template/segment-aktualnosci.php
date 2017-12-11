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
<div class="row section_title aktualnosci">
	<div class="col-md-12">
		<h1>Aktualności</h1>
	</div>
	<div class="col-xl-6">
		<a class="link_post" href="<?php echo $data[0]['url']; ?>">
			<div class="post_news_big" style='background-image: url(<?php echo $data[0]['img']; ?>);'>
				<img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/media/cover_img.png">
				<span><?php echo $data[0]['title']; ?></span>
			</div>
		</a>
	</div>
	<!-- /.col-md-6 -->
	<div class="col-xl-3 clear-mobile">
		<div class='row'>
			<a class="link_post col-12 col-md-6 col-xl-12" href="<?php echo $data[1]['url']; ?>">
				<div class="post_news_small" style='background-image: url(<?php echo $data[1]['img']; ?>);'> </div>
				<span class="post_news_small_tiitle"><?php echo $data[1]['title']; ?></span>
			</a>
			<a class="link_post col-12 col-md-6 col-xl-12" href="<?php echo $data[2]['url']; ?>">
				<div class="post_news_small" style='background-image: url(<?php echo $data[2]['img']; ?>);'> </div>
				<span class="post_news_small_tiitle"><?php echo $data[2]['title']; ?></span>
			</a>
		</div>
	</div>
	<!-- /.col-md-3 -->
	<div class="col-xl-3 clear-mobile">
		<h2 class="red_title">Najnowsze wiadomości</h2>
		<ul class="top_news_list row">
			<?php
				for( $i=3; $i<count( $data ); $i++ ):
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
			<?php endfor;?>
		</ul>
	</div>
	<!-- /.col-md-3 -->
</div>
