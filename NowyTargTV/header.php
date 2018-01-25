<?php
	session_start();
	/* if( !checkAccess() ){
		include __DIR__ . "/template/page-wbudowie.php";
		die();
		
	} */
?>
<!DOCTYPE HTML>
<html lang="pl-PL">
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