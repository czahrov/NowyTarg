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

$input = <<<EOT
The canonical URL for your page. This should be the undecorated URL, without session variables, user identifying parameters, or counters. Likes and Shares for this URL will aggregate at this URL. For example, mobile domain URLs should point to the desktop version of the URL as the canonical URL to aggregate Likes and Shares across different versions of the page.
EOT;

// preg_match( "~(?:[^\.]+\.){1,4}~", $input, $match );
// print_r( $match );

print_r( get_post_meta( 1916 ) );
