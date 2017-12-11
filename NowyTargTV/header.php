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
	<meta charset='utf-8'>
	<title>
		<?php do_action( 'page_title' ); ?>
	</title>
	<?php wp_head(); ?>
</head>
<body class='<?php do_action( 'body_class' ); ?>'>