<?php
/*
	Template Name: Transmisje Live
*/

// [SERVER_NAME] => nowytarg24.tv
$param = sprintf( "Location: http://live.%s/live", $_SERVER[ 'SERVER_NAME' ] );
header( $param );

?>