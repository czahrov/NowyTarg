<?php
	$data = array(
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/100x100?text=obrazek',
			'type' => '',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/100x100?text=obrazek',
			'type' => '',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/100x100?text=obrazek',
			'type' => '',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/100x100?text=obrazek',
			'type' => '',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/100x100?text=obrazek',
			'type' => '',
			
		),
		
	);
	
?>
<div class="col-xl-3 section_title">
	<h1>Kultura</h1>
	<div class='row'>
		<?php foreach( $data as $item ): ?>
		<a href="<?php echo $item['url'] ?>" class="col-md-6 col-xl-12">
			<div class="row clear img_news_list">
				<div class="img_link">
					<img class="img-fluid mb-3 mb-md-0" src="<?php echo $item['img'] ?> alt="<?php echo $item['title']; ?>">
				</div>
				<p>
					<?php echo $item['title']; ?>
				</p>
			</div>
		</a>
		<div class="dashed"></div>
		<?php endforeach; ?>
		
	</div>
</div>
	