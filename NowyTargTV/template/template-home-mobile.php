<div class="container">
	<!-- reklama -->
	<!-- img ad -->
	<div class='reklama clear'>
		<?php do_action( 'get_ad', 'home_top' ); ?>
	</div>
	<!-- ..img-ad-->
	<!-- aktualności -->
	<?php get_template_part( "template/segment", "aktualnosci-mobile" ); ?>
	<!-- /.row -->
	<!-- wideo i reportaże -->
	<?php get_template_part( "template/segment", "wideo_i_reportaze-mobile" ); ?>
	<!-- /.row -->
	<!-- najpopularniejsze -->
	<?php get_template_part( "template/segment", "najbardziej_popularne-mobile" ); ?>
	<!-- /.row -->
	<!-- sport i kultura -->
	<?php do_action( 'get_ad', 'home_large', array( 'parallax' => true ) ); ?>
	<div class="row">
		<!-- sport -->
		<!-- /.col-xl-9 -->
		<?php get_template_part( "template/segment", "sport-mobile" ); ?>
		<!-- kultura -->
		<?php get_template_part( "template/segment", "kultura-mobile" ); ?>
		<!-- /.col-lg -->
	</div>
	<!-- /.row -->
	<!-- wydarzenia i reklama -->
	<div class="row">
		<!-- wydarzenia -->
		<?php get_template_part( "template/segment", "wydarzenia-mobile" ); ?>
		<!-- /.col-xl-9 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<!-- ogłoszenia -->
		<?php get_template_part( "template/segment", "ogloszenia-mobile" ); ?>
		<?php //get_template_part( "template/segment-sidebar", "home" ); ?>
		<?php get_sidebar( "home" ); ?>
		
	</div>
	<!-- /.row -->
</div>