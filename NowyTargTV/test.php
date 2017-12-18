<?php
/*
	Template Name: test
*/

// $jimp = new JoomlaImporter( __DIR__ . "/import/artykuly.json" );
// var_dump( $jimp->loadItems( 2000 ) );

/* print_r( get_terms( array(
    'taxonomy' => 'post_format',
    'hide_empty' => false,
	
) ) ); */


/* print_r( get_posts( array(
	'tax_query' => array(
		// 'relation' => 'AND',
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array( 'post-format-video' ),
			
		),
		
	),
	
) ) ); */

/* print_r( get_terms( array(
	'taxonomy' => 'category',
	'parent' => getCatByName( 'Portal' ),
	
) ) ); */

var_dump( getTagCloud() );
