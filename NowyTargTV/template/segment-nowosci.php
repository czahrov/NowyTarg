<?php
	$data = array(
		array(
			'title' => 'Lorem ipsum title',
			'url' => '#',
			'img' => 'http://via.placeholder.com/320x200?text=obrazek',
			'date' => date( "Y-m-d" ),
			'comments' => 10,
			'excerpt' => 'Lorem ipsum opis',
			
		),
		array(
			'title' => 'Lorem ipsum title',
			'url' => '#',
			'img' => 'http://via.placeholder.com/320x200?text=obrazek',
			'date' => date( "Y-m-d" ),
			'comments' => 10,
			'excerpt' => 'Lorem ipsum opis',
			
		),
		
	);
	
?>
<div class="col-xl-12 section_title">
	<h1>Ostatnie nowości</h1>
	<div class="row clear">
		<?php foreach( $data as $item ): ?>
		<div class="col-md-6 load_more">
			<a class="link_post" href="<?php echo $item['url']; ?>">
				<div class="post_aktualnosci">
					<div class="news_date"><?php echo $item['date']; ?></div>
					<img class="cover_img" src="<?php echo $item['img']; ?>">
					<span><?php echo $item['comments']; ?> komentarzy</span>
				</div>
				<span class="post_aktualnosci_tiitle">
					<?php echo $item['title']; ?>
				</span>
				<p class="post_aktulanosci">
					<?php echo $item['excerpt']; ?>
				</p>
			</a>
		</div>
		<?php endforeach; ?>
	</div>
</div>