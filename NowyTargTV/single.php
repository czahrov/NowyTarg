<?php
	get_header();
	get_template_part( "template/part", 'top' );
	
?>

<div id='popup' class=''>
	<img class='box' src=''/>
	
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
				<div class="social_bar_top d-flex flex-wrap justify-content-between">
					<span class="social_date">Data dodania <?php echo get_the_date( "d.m.Y", get_post()->ID ); ?></span>
					<span class="share d-inline-flex">
						<span class="social_share">Udostepnij</span>
						<div class="icons">
							<a class="circle_icon" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink( get_post()->ID ); ?>" target="_blank">
								<i class="fa fa-facebook" aria-hidden="true"></i>
							</a>
							<a class="circle_icon" href="https://twitter.com/intent/tweet?text=<?php echo get_permalink( get_post()->ID ); ?>" target="_blank">
								<i class="fa fa-twitter" aria-hidden="true"></i>
							</a>
							<a class="circle_icon" href="https://plus.google.com/share?url=<?php echo get_permalink( get_post()->ID ); ?>" target="_blank">
								<i class="fa fa-google" aria-hidden="true"></i>
							</a>
						</div>
						
					</span>
					
				</div>
				
				<div class="content">
					<h1 class="news_post_title">
						<?php the_title(); ?>
					</h1>
					<div class="bold_post_desc">
						<?php the_excerpt(); ?>
					</div>
					<?php //do_action( 'get_ad', 'single_inpost' ); ?>
					<div class='thumb d-flex'>
						<?php printf( "<img class='align-self-center' src='%s'>", getPostImg( get_the_ID() ) ); ?>
					</div>
					<div class="regular_post_txt">
						<?php the_content(); ?>
					</div>
					<?php do_action( "youtube", get_post()->ID ); ?>
					<?php do_action( "gallery", get_post()->ID ); ?>
					
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