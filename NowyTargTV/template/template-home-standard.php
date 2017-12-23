<div class="container">
	<!-- reklama -->
	<!-- img ad -->
	<div class='reklama clear'>
		<?php do_action( 'get_ad', 'home_top' ); ?>
	</div>
	<!-- ..img-ad-->
	<!-- aktualności -->
	<?php get_template_part( "template/segment", "aktualnosci" ); ?>
	<!-- /.row -->
	<!-- wideo i reportaże -->
	<?php get_template_part( "template/segment", "wideo_i_reportaze" ); ?>
	<!-- /.row -->
	<!-- najpopularniejsze -->
	<?php get_template_part( "template/segment", "najbardziej_popularne" ); ?>
	<!-- /.row -->
	<!-- sport i kultura -->
	<?php do_action( 'get_ad', 'home_large', array( 'parallax' => true ) ); ?>
	<div class="row">
		<!-- sport -->
		<!-- /.col-xl-9 -->
		<?php get_template_part( "template/segment", "sport" ); ?>
		<!-- kultura -->
		<?php get_template_part( "template/segment", "kultura" ); ?>
		<!-- /.col-lg -->
	</div>
	<!-- /.row -->
	<!-- wydarzenia i reklama -->
	<div class="row">
		<!-- wydarzenia -->
		<?php get_template_part( "template/segment", "wydarzenia" ); ?>
		<!-- /.col-xl-9 -->
		<!-- reklama -->
		<div class="col-md-3 clear">
			<?php do_action( 'get_ad', 'home_wydarzenia' ); ?>
		</div>
	</div>
	<!-- /.row -->
	<div class="row">
		<!-- ogłoszenia -->
		<?php get_template_part( "template/segment", "ogloszenia" ); ?>
		<?php //get_template_part( "template/segment-sidebar", "home" ); ?>
		<?php get_sidebar( "home" ); ?>
		
	</div>
	<!-- /.row -->
</div>