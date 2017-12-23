<?php
	get_header();
	get_template_part( "template/part", "top" );
		
?>
<?php
	
	$path = $_SERVER[ 'REQUEST_URI' ];
	$t = get_option( 'category_base' );
	$cat_word = !empty( $t )?( $t ):( 'category' );
	$pattern = "~([^/]+)/~";
	preg_match_all( $pattern, $path, $match );
	$cat = get_category_by_slug( end( $match[1] ) );
	$cat_link = get_category_link( $cat );
	$base_link = preg_replace( "~/\w+$~", "xxx", $cat_link );
	
	$page_num = !empty( $_GET[ 'strona' ] )?( (int)$_GET[ 'strona' ] ):( 1 );
	
	$pagin_params = array(
		'base' => $base_link . "%_%",
		'format' => "?strona=%#%",
		'current' => $page_num,
		'end_size' => 3,
		'mid_size' => 5,
		// 'type' => 'array',
		// 'show_all' => true,
		
	);
	
	if( isMobile() ){
		$pagin_params = array_merge( $pagin_params, array(
			'end_size' => 1,
			'mid_size' => 2,
			'prev_next' => false,
			
		) );
		
	}
	
	$pagin = paginate_links( $pagin_params );
	
	/* echo "<!--cat\r\n";
	print_r( $page_num );
	echo "\r\n-->"; */
	
	$posts = get_posts( array(
		'category' => $cat->cat_ID,
		'posts_per_page' => get_option( 'posts_per_page' ),
		'paged' => $page_num,
		
	) );
	
?>
<!-- Page Content -->
<div id='category' class="container">
	<!-- img ad -->
	<?php do_action( 'get_ad', 'category_top' ); ?>
	<!-- ..img-ad-->
	<?php do_action( 'breadcrumb' ); ?>
	
	<!-- /.row -->
	<!-- ostatnie nowości -->
	<div class="row">
		<div class="col-xl-9 section_title">
			<h1><?php echo $cat->name; ?></h1>
				<div class="row clear">
					<?php
						foreach( $posts as $item ):
					?>
					<div class="post_item col-md-6 load_more">
						<a class="link_post" href="<?php the_permalink( $item->ID ); ?>">
							<div class="post_multi">
								<div class='post_img' style='background-image:url(<?php echo getPostImg( $item->ID ); ?>);'>
									<div class="post_date"><?php echo get_the_date( "Y-m-d", $item->ID ); ?></div>
									<div class='comment'><?php echo count( get_comments( array( 'post_id' => $item->ID ) ) ); ?> komentarzy</div>
								</div>
							</div>
							<div class="post_title">
								<?php echo $item->post_title; ?>
							</div>
							<p class="post_excerpt">
								<?php echo shortText( $item->post_excerpt ); ?>
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
		<?php get_sidebar( "category" ); ?>
		<!-- /.row -->
	</div>
<!-- /.container -->
</div>

<?php
	get_template_part( "template/part", "bot" );
	get_footer();
?>