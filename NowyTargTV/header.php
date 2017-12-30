<?php
	session_start();
	if( !checkAccess() ){
		include __DIR__ . "/template/page-wbudowie.php";
		die();
		
	}
?>
<!DOCTYPE HTML>
<html lang='pl'>
<head>
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