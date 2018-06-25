<?php
/*
	Template Name: test
*/

if( !DMODE ) header( "Location: " . home_url() );

// 3038 pozycji
/* $jimp = new JoomlaImporter( __DIR__ . "/import/artykuly.json" );
$dt_start = time();
var_dump( $jimp->loadItems( 2800, 400 ) ) . PHP_EOL;
$dt_stop = time();
echo $dt_stop - $dt_start . "[s]"; */

/*
	bardzo dobry
	dobry
	umiarkowany
	dostateczny
	zły
	bardzo zły
*/

// print_r( $_SERVER );
// var_dump( headers_list() );

var_dump( UADetector() );
