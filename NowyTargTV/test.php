<?php
/*
	Template Name: test
*/

// $jimp = new JoomlaImporter( __DIR__ . "/import/artykuly.json" );
// var_dump( $jimp->loadItems( 2000 ) );
// var_dump( logger() );

// var_dump( get_post_format( 1983 ) );

/* print_r( get_posts( array(
	'meta_query' => array(
		array(
			'key' => 'miejsce',
			'value' => 'home_top',
			'compare' => 'LIKE',
			
		),
		
	),
	
) ) ); */

// /Mobile|Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/

// echo $_SERVER[ 'HTTP_USER_AGENT' ];

// dynamic_sidebar( 'sidebar-weather' );

/* $id = 10254;

$uri = "http://api.gios.gov.pl/pjp-api/rest/station/sensors/{$id}";

$resp = file_get_contents( $uri );
$json = json_decode( $resp, true );

print_r( $json );

$uri = "http://api.gios.gov.pl/pjp-api/rest/station/findAll";
$uri = "http://api.gios.gov.pl/pjp-api/rest/station/sensors/{$id}";
$uri = "http://api.gios.gov.pl/pjp-api/rest/aqindex/getIndex/52";
$uri = "http://api.gios.gov.pl/pjp-api/rest/aqindex/getIndex/{$id}";

$resp = file_get_contents( $uri );
$json = json_decode( $resp, true );

print_r( $json ); */

print_r( getAirCon() );

