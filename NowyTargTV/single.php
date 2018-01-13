<?php
	get_header();
	get_template_part( "template/part", 'top' );
	
?>

<div id='popup' class='d-flex'>
	<div class='box d-flex flex-grow'>
		<div class='exit'>
			<div class='icon f fa fa-window-close-o'></div>
		</div>
		<div class='slider d-flex flex-grow'>
			<div class='nav left'>
				<div class='icon fa fa-chevron-circle-left'></div>
				
			</div>
			<div class='view d-flex flex-grow'></div>
			<div class='nav right'>
				<div class='icon fa fa-chevron-circle-right'></div>
				
			</div>
			
		</div>
		
	</div>
	
</div>
<!-- Page Content -->
<div id='single' class="container">
	<!-- img ad -->
	<?php do_action( 'get_ad', 'single_top' ); ?>
	<!-- ..img-ad-->
	<?php do_action( 'breadcrumb' ); ?>
	<!-- /.row -->
	<!-- wpis -->
	<div class="row">
		<div class='col-lg-9'>
			<?php if( have_posts() ): the_post(); ?>
			<!-- content -->
			<div class='post row justify-content-between'>
				<div class="social_bar_top d-flex flex-wrap justify-content-between">
					<span class="social_date">Data dodania <?php echo get_the_date( "d.m.Y H:i", get_post()->ID ); ?></span>
					<span class='share d-inline-flex'>
						<span class="social_share">Udostępnij</span>
						<div class='icons'>
							<a class="circle_icon fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink( get_post()->ID ); ?>" target="_blank">
								<i class="fa fa-facebook" aria-hidden="true"></i>
							</a>
							<a class="circle_icon twitter" href="https://twitter.com/intent/tweet?text=<?php echo get_permalink( get_post()->ID ); ?>" target="_blank">
								<i class="fa fa-twitter" aria-hidden="true"></i>
							</a>
							<a class="circle_icon google" href="https://plus.google.com/share?url=<?php echo get_permalink( get_post()->ID ); ?>" target="_blank">
								<i class="fa fa-google" aria-hidden="true"></i>
							</a>
						</div>
						
					</span>
					
				</div>
				<div class="content flex-grow">
					<h1 class="news_post_title">
						<?php the_title(); ?>
					</h1>
					<div class="bold_post_desc">
						<?php
							$lead = get_post_meta( get_the_ID(), 'lead', true );
							if( !empty( $lead ) ){
								echo $lead;
								
							}
							else{
								the_excerpt();
								
							}
							
						?>
					</div>
					<?php //do_action( 'get_ad', 'single_inpost' ); ?>
					<div class='thumb d-flex flex-column'>
						<?php
							printf( "<img class='align-self-center' src='%s'>", getPostImg( get_the_ID(), 'full' ) );
							printf( "<div class='imginfo'>%s</div>", getThumbInfo( get_the_ID() )[ 'opis' ] );
						?>
					</div>
					<div class="regular_post_txt">
						<?php
							// usuwanie znaczników galerii wp z treści wpisu
							$content = preg_replace( "~\[gallery[^\]]+?\]~", "", get_the_content() );
							
							/* <p>https://nowytarg24.tv/nowotarscy-policjanci-zatrzymali-35-latka-za-posiadanie-narkotykow/</p> */
							// wyszukuje linki w treści wpisu do innych wpisów w obrębie serwisu
							/* $pattern = sprintf( "~<p>%s/([^/]+)/</p>~", home_url() );
							preg_match_all( $pattern, $content, $match );
							logger( $pattern );
							logger( $match );
							
							// podmienia znalezione linki na zawartość wygenerowaną przez funkcję
							$replacement = array_map( "genRelatedPost", $match[1] );
							$content = str_replace( $match[0], $replacement, $content ); */
							
							echo apply_filters( 'the_content', $content );
							
							if( DMODE === true ){
								echo "<!--";
								print_r( logger() );
								echo "-->";
								
							}
							
						?>
					</div>
					<?php do_action( "youtube", get_the_ID() ); ?>
					<?php do_action( "gallery", get_the_ID() ); ?>
					
				</div>
				
			</div>
			<!-- comments -->
			<div class='comments row'>
				<?php
					if( comments_open() ) get_template_part( "template/part-comment", "form" );
					get_template_part( "template/part-comment", "view" );
					
				?>
				<?php else: ?>
				<!-- content -->
				<div class='content col-12'>
					Wpis nie istnieje
				</div>
				<?php endif; ?>
					
			</div>
			<?php get_template_part( "template/segment", "nowosci" ); ?>
			
		</div>
		<!-- /.col-xl-9 -->
		<?php get_sidebar( 'single' ); ?>
		
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->

<?php
	get_template_part( "template/part", 'bot' );
	get_footer();
	
?>