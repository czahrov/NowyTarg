<?php
	get_header();
	get_template_part( "template/part", "top" );
		
?>
<?php
	
		$data = array(
		array(
			'title' => 'Lorem ipsum tytuł',
			'excerpt' => 'Lorem ipsum opis',
			'url' => '#',
			'date' => date( "Y-m-d" ),
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
			'comment' => 10,
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'excerpt' => 'Lorem ipsum opis',
			'url' => '#',
			'date' => date( "Y-m-d" ),
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
			'comment' => 10,
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'excerpt' => 'Lorem ipsum opis',
			'url' => '#',
			'date' => date( "Y-m-d" ),
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
			'comment' => 10,
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'excerpt' => 'Lorem ipsum opis',
			'url' => '#',
			'date' => date( "Y-m-d" ),
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
			'comment' => 10,
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'excerpt' => 'Lorem ipsum opis',
			'url' => '#',
			'date' => date( "Y-m-d" ),
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
			'comment' => 10,
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'excerpt' => 'Lorem ipsum opis',
			'url' => '#',
			'date' => date( "Y-m-d" ),
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
			'comment' => 10,
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'excerpt' => 'Lorem ipsum opis',
			'url' => '#',
			'date' => date( "Y-m-d" ),
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
			'comment' => 10,
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'excerpt' => 'Lorem ipsum opis',
			'url' => '#',
			'date' => date( "Y-m-d" ),
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
			'comment' => 10,
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'excerpt' => 'Lorem ipsum opis',
			'url' => '#',
			'date' => date( "Y-m-d" ),
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
			'comment' => 10,
		),
		array(
			'title' => 'Lorem ipsum tytuł',
			'excerpt' => 'Lorem ipsum opis',
			'url' => '#',
			'date' => date( "Y-m-d" ),
			'img' => 'http://via.placeholder.com/400x200?text=obrazek',
			'comment' => 10,
		),
		
		
	);
	
?>
<!-- Page Content -->
<div id='category' class="container">
	<!-- img ad -->
	<?php do_action( 'get_ad', 'full' ); ?>
	<!-- ..img-ad-->
	<?php do_action( 'breadcrumb' ); ?>
	
	<!-- /.row -->
	<!-- ostatnie nowości -->
	<div class="row">
		<div class="col-xl-9 section_title">
			<h1>Ostatnie nowości</h1>
				<div class="row clear">
					<?php
						/* if( have_posts() ) : while ( have_posts() ) : the_post();
						$post = get_the_post(); */
						foreach( $data as $item ):
					?>
					<div class="col-md-6 load_more">
						<a class="link_post" href="<?php echo $item['url']; ?>">
							<div class="post_aktualnosci">
								<div class="news_date"><?php echo $item['date']; ?></div>
								<img class="cover_img" src="<?php echo $item['img']; ?>">
								<span><?php echo $item['comment']; ?> komentarzy</span>
							</div>
							<span class="post_aktualnosci_tiitle">
								<?php echo $item['title']; ?>
							</span>
							<p class="post_aktulanosci">
								<?php echo $item['excerpt']; ?>
							</p>
						</a>
					</div>
					<?php
						endforeach;
						// endif;
					?>
					<div class="col-md-12"></div>
				<!-- /.row -->
			</div>
			<!-- /.col-xl-9 -->
		</div>
		<!-- wydarzenia -->
		<?php get_sidebar( "category" ); ?>
		<!-- /.row -->
	</div>
<!-- /.container -->
</div>

<?php
	get_template_part( "template/part", "bot" );
	get_footer();
?>