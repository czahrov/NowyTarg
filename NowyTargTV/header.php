<?php
	session_start();
	/* if( !checkAccess() ){
		include __DIR__ . "/template/page-wbudowie.php";
		die();
		
	} */
	
	$infix = DMODE === true?( "" ):( ".min" );
	$buster = DMODE === true?( time() ):( false );
	
	// wp_enqueue_script( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, bool $in_footer = false )
	wp_enqueue_script( "jq", get_stylesheet_directory_uri() . "/js/jquery-3.2.1.min.js", array(), false, true );
	wp_enqueue_script( "jq-touchSwipe", get_stylesheet_directory_uri() . "/js/jquery.touchSwipe.min.js", array(), false, true );
	wp_enqueue_script( "bootstrap-bundle", get_stylesheet_directory_uri() . "/js/bootstrap.bundle.min.js", array(), false, true );
	wp_enqueue_script( "gsap-css", get_stylesheet_directory_uri() . "/js/CSSPlugin.min.js", array(), false, true );
	wp_enqueue_script( "gsap-TweenL", get_stylesheet_directory_uri() . "/js/TweenLite.min.js", array(), false, true );
	wp_enqueue_script( "gsap-TimeL", get_stylesheet_directory_uri() . "/js/TimelineLite.min.js", array(), false, true );
	wp_enqueue_script( "parallax", get_stylesheet_directory_uri() . "/js/parallax.min.js", array(), false, true );
	wp_enqueue_script( "gmap", get_stylesheet_directory_uri() . "/js/gmap3.js", array(), false, true );
	wp_enqueue_script( "gmap_api", "https://maps.google.com/maps/api/js?key=AIzaSyDiWLbHPOu5_TNpUOF_86vACb_nD_oCtRw", array(), false, true );
	wp_enqueue_script( "main", get_stylesheet_directory_uri() . "/js/main{$infix}.js", array(), $buster, true );
	wp_enqueue_script( "agency", get_stylesheet_directory_uri() . "/js/agency{$infix}.js", array(), $buster, true );
	wp_enqueue_script( "facepalm", get_stylesheet_directory_uri() . "/js/facepalm{$infix}.js", array(), $buster, true );
	
	// wp_enqueue_style( string $handle, string $src = "", array $deps = array(), string|bool|null $ver = false, string $media = "all" )
	wp_enqueue_style( "bootstrap", get_stylesheet_directory_uri() . "/css/bootstrap.css" );
	wp_enqueue_style( "fontawesome", get_stylesheet_directory_uri() . "/css/font-awesome.min.css" );
	wp_enqueue_style( "main", get_stylesheet_directory_uri() . "/css/main{$infix}.css", array(), $buster );
	wp_enqueue_style( "style", get_stylesheet_directory_uri() . "/style{$infix}.css", array(), $buster );
	wp_enqueue_style( "style_map", get_stylesheet_directory_uri() . "/style.css.map", array(), $buster );
	
?>
<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<META HTTP-EQUIV="Content-Language" CONTENT="pl-PL">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
		<link href="<?php echo get_template_directory_uri(); ?>/media/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
		<meta charset='utf-8'>
		<?php do_action( 'social_tag' ); ?>
		<title>
			<?php do_action( 'page_title' ); ?>
		</title>
		<?php wp_head(); ?>
	</head>
	<body class='<?php do_action( 'body_class' ); ?>'>
	<div id='sidestick' class='item'>
		<a  class='item fejs' href='https://www.facebook.com/nowytarg24tv/' target='_blank'>
			<img src='/media/fejsbook.png' />
		</a>
		<a  class='item live' href='<?php echo home_url( '/kamery' ); ?>'>
			<img src='/media/cam_bar.png' />
		</a>
		<div class='item traffic'>
			<img src="/media/zakopianka_bar.png" />
		</div>
		
	</div>
	<div id='popup_side' class='flex-column'>
		<div id='gmap' class=''></div>
		
	</div>