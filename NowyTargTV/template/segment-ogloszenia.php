<?php
	$data = array(
		array(
			'title' => 'Lorem ipsum',
			'exc' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => '',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'exc' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => '',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'exc' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => '',
			
		),
		array(
			'title' => 'Lorem ipsum',
			'exc' => 'Lorem ipsum',
			'url' => '#',
			'img' => 'http://via.placeholder.com/200x200?text=obrazek',
			'type' => '',
			
		),
		
	);
	
?>
<div class="col-xl-9 section_title">
	<h1>Ogłoszenia urzędowe</h1>
	<?php for( $i=0; $i<2; $i++ ): ?>
	<div class="row clear city_news">
		<a href="<?php echo $data[$i]['url']; ?>" class="list_post col-sm-4">
			<div class="">
				<img class="img-fluid mb-3 mb-md-0" src="<?php echo $data[$i]['img']; ?>" alt="">
			</div>
		</a>
		<div class="col-sm-8">
			<h3><?php echo $data[$i]['title']; ?></h3>
			<p><?php echo $data[$i]['exc'] ?></p>
			<a href="<?php echo $data[$i]['url']; ?>" class="wiecej">czytaj dalej</a>
		</div>
	</div>
	<!-- /.row -->
	<div class="dashed"></div>
	<?php endfor; ?>
	<?php do_action( 'get_ad', 'horizontal' ); ?>
	<!-- /.row -->
	<div class="dashed"></div>
	<?php for( $i=2; $i<count( $data ); $i++ ): ?>
	<div class="row clear city_news">
		<a href="<?php echo $data[$i]['url']; ?>" class="list_post col-sm-4">
			<div class="">
				<img class="img-fluid mb-3 mb-md-0" src="<?php echo $data[$i]['img']; ?>" alt="">
			</div>
		</a>
		<div class="col-sm-8">
			<h3><?php echo $data[$i]['title']; ?></h3>
			<p><?php echo $data[$i]['exc'] ?></p>
			<a href="<?php echo $data[$i]['url']; ?>" class="wiecej">czytaj dalej</a>
		</div>
	</div>
	<!-- /.row -->
	<div class="dashed"></div>
	<?php endfor; ?>
	<?php do_action( 'get_ad', 'large' ); ?>
</div>
