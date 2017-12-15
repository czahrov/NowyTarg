<?php
/*
	Template Name: test
*/

date_default_timezone_set( "Europe/Warsaw" );

/* $source = "http://nowytarg24.tv/images/galerie/2016/2016.01.01.nowa.targowica/targowica05.jpg";
$dst = __DIR__ . "/import/" . basename( $source );

var_dump( copy( $source, $dst ) ); */

/* $t = array(
	'ID' => 0,
	'post_author' => 1,
	'post_date' => date( "Y-m-d H:i:s" ),
	'post_title' => 'Testowy',
	'post_content' => '...',
	'post_excerpt' => '',
	'post_status' => 'publish',
	'post_category' => array(),
	'tags_input' => array(),
	'comment_status' => 'open',
	'meta_input' => array(
		'thumb' => 'obrazek wyróżniajacy',
		'youtube' => 'link do twojej tuby',
		'gallery_name' => 'galeryja',
		
	)
); */

// var_dump( wp_insert_post( $t ) );

$jimp = new JoomlaImporter( __DIR__ . "/import/artykuly.json", "NE" );
// print_r( array_slice( $jimp->export(), 0, 3 ) );
echo count( $jimp->export() );

