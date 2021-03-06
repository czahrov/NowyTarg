<?php
	get_header();
	get_template_part( "template/part", "top" );
		
?>
<?php
	
	$path = $_SERVER[ 'REQUEST_URI' ];
	$t = get_option( 'tag_base' );
	$tag_word = !empty( $t )?( $t ):( 'tag' );
	$pattern = "~([^/]+)/~";
	preg_match_all( $pattern, $path, $match );
	// $cat = get_category_by_slug( end( $match[1] ) );
	$tag = getTag( end( $match[1] ) );
	// $cat_link = get_category_link( $cat );
	$tag_link = get_tag_link( $tag );
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
	
	echo "<!--tag\r\n";
	print_r( $tag );
	echo "\r\n-->";
	
	$posts = get_posts( array(
		// 'category' => $cat->cat_ID,
		'tag_id' => $tag->term_id,
		'posts_per_page' => get_option( 'posts_per_page' ),
		'paged' => $page_num,
		
	) );
	
?>
<!-- Page Content -->
<div id='category' class="container">
	<!-- img ad -->
	<?php do_action( 'get_ad', 'tag_top' ); ?>
	<!-- ..img-ad-->
	<?php do_action( 'breadcrumb' ); ?>
	
	<!-- /.row -->
	<!-- ostatnie nowości -->
	<div class="row">
		<div class="col-xl-9 section_title">
			<h1><?php echo $tag->name; ?></h1>
				<?php
					foreach( $posts as $item ):
				?>
				<div class='row'>
					<a class="post_item col-12 d-flex flex-wrap" href="<?php the_permalink( $item->ID ); ?>">
						<div class="link_post col-12 col-md-4">
							<div class="post_multi">
								<div class="post_img" style="background-image:url(<?php echo getPostImg( $item->ID, 'large' ); ?>);">
									<div class="post_date"><?php echo get_the_date( "Y-m-d H:i", $item->ID ); ?></div>
									<div class="comment">
										<?php
											$num = count( get_approved_comments( $item->ID ) );
											if( $num > 0 ) printf( "komentarzy: %u", $num );
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="box col d-flex flex-column">
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
							<div class="wiecej">
								czytaj dalej
							</div>
						</div>
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
			<!-- /.col-xl-9 -->
		</div>
		<!-- wydarzenia -->
		<?php get_sidebar( "tag" ); ?>
		<!-- /.row -->
	</div>
<!-- /.container -->
</div>

<?php
	get_template_part( "template/part", "bot" );
	get_footer();
?>