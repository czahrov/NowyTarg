<?php
	$data = array(
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => '',
			'cat' => 'przegląd',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => '',
			'cat' => 'sport',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => '',
			'cat' => 'kultura',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => '',
			'cat' => 'aktualności',
			
		),
		
	);
	
?>
<div class="row">
	<div class="col-md-12 section_title">
		<h1>Najbardziej popularne</h1>
	</div>
</div>
<!-- /.row -->
<div class="row ad-padding clear">
	<?php for( $i=0; $i<count( $data ); $i++ ): ?>
	<div class="col-md-6 col-xl-3 no-padding clear-mobile">
		<a href="" class="link_post">
			<div class="last1" style='background-image: url(<?php echo $data[$i]['img']; ?>);'>
				<div class="post_category_small">
					<?php echo $data[$i]['cat']; ?>
				</div>
				<img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/media/cover_img.png">
				<span><?php echo $data[$i]['title']; ?></span>
			</div>
		</a>
	</div>
	<?php endfor; ?>
	
</div>
