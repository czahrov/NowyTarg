<?php
/*
	Template Name: test
*/

date_default_timezone_set( "Europe/Warsaw" );

// print_r( wp_get_nav_menu_items( 'glowne-menu' ) );

/* $posts = get_posts( array( 
	'category_name' => 'baner-reklamowy',
	'meta_key' => 'typ',
	'meta_value' => 'duży',
	
) );

$meta = get_post_meta( $posts[0]->ID );

print_r( $posts );
print_r( $meta );
*/

// do_action( 'get_ad', 'h' );

// do_action( 'get_live' );

// $start = "01/06/2020-12:00";
// sscanf( $start, "%u/%u/%u-%u:%u", $start_day, $start_month, $start_year, $start_hour, $start_minute );
// $t = new DateTime( sprintf( "%u-%u-%u %u:%u:00", 
	// $start_year,
	// $start_month,
	// $start_day,
	// $start_hour,
	// $start_minute
	
// ) );

// print_r( array( $start_day, $start_month, $start_year, $start_hour, $start_minute ) );

// var_dump( $t );

/* echo date( "d/m/Y H:i:s" );

$dt = new DateTime();
echo timezone_name_get( $dt->getTimezone() ); */

print_r( get_terms( array(
    'taxonomy' => 'category',
	'name' => 'Transmisja Live',
	
) ) );

print_r( get_category( 5 ) );

print_r( wp_get_post_categories( 88 ) );

print_r( get_post( 42 ) );
print_r( get_post( 88 ) );


