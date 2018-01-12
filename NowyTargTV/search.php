<?php
	get_header();
	get_template_part( "template/part", "top" );
		
?>
<?php
	
	$path = $_SERVER[ 'REQUEST_URI' ];
	$search_word = $_GET[ 's' ];
	
	$page_num = !empty( $_GET[ 'strona' ] )?( (int)$_GET[ 'strona' ] ):( 1 );
	
	$pagin = paginate_links( array(
		'base' => $base_link . "%_%",
		'format' => "?strona=%#%",
		'current' => $page_num,
		'end_size' => 3,
		'mid_size' => 5,
		// 'type' => 'array',
		// 'show_all' => true,
		
	) );
	
	echo "<!--cat\r\n";
	// print_r( $page_num );
	echo "\r\n-->";
	
	$posts = get_posts( array(
		's' => $search_word,
		'posts_per_page' => get_option( 'posts_per_page' ),
		'paged' => $page_num,
		
	) );
	
?>
<!-- Page Content -->
<div id='category' class="container">
	<!-- img ad -->
	<?php do_action( 'get_ad', 'search_top' ); ?>
	<!-- ..img-ad-->
	<?php do_action( 'breadcrumb' ); ?>
	
	<!-- /.row -->
	<!-- ostatnie nowości -->
	<div class="row">
		<div class="col-xl-9 section_title">
			<h1><?php printf( "Szukana fraza: %s", $search_word ); ?></h1>
				<div class="row clear">
					<?php
						foreach( $posts as $item ):
					?>
					<div class="post_item col-md-6">
						<a class="link_post" href="<?php the_permalink( $item->ID ); ?>">
							<div class="post_multi">
								<div class='post_img' style='background-image:url(<?php echo getPostImg( $item->ID, 'full' ); ?>);'>
									<div class="post_date"><?php echo get_the_date( "Y-m-d", $item->ID ); ?></div>
									<div class='comment'><?php echo count( get_comments( array( 'post_id' => $item->ID ) ) ); ?> komentarzy</div>
								</div>
							</div>
							<div class="post_title">
								<?php echo $item->post_title; ?>
							</div>
							<p class="post_excerpt">
								<?php
									$text = "";
									$lead = get_post_meta( $item->ID, 'lead', true );
									if( !empty( $lead ) ){
										$text = $lead;
										
									}
									else{
										$text = $item->post_excerpt;
										
									}
									
									echo shortText( $text );
									
								?>
							</p>
						</a>
					</div>
					<?php
						endforeach;
					?>
					<div class="pagination col-md-12 justify-content-center">
						<?php print_r( $pagin ); ?>
					</div>
					<div class="col-md-12"></div>
				<!-- /.row -->
			</div>
			<!-- /.col-xl-9 -->
		</div>
		<!-- wydarzenia -->
		<?php get_sidebar( "search" ); ?>
		<!-- /.row -->
	</div>
<!-- /.container -->
</div>

<?php
	get_template_part( "template/part", "bot" );
	get_footer();
?>