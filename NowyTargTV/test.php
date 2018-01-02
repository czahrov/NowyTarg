<?php
/*
	Template Name: test
*/

// 3038 pozycji
/* $jimp = new JoomlaImporter( __DIR__ . "/import/artykuly.json" );
var_dump( $jimp->loadItems( 3000 ) ); */

/* print_r( get_posts( array(
	'meta_query' => array(
		array(
			'key' => 'miejsce',
			'value' => 'home_top',
			'compare' => 'LIKE',
			
		),
		
	),
	
) ) ); */

/*
	bardzo dobry
	dobry
	umiarkowany
	dostateczny
	zły
	bardzo zły
*/

/* print_r( array(
	'weather' => getForecast(),
	'air' => getAirCon(),
	
) ); */

// setlocale( LC_ALL, 'pl_PL' );
setlocale( LC_ALL, 'pl-PL' );
// locale_set_default( 'pl_PL' );
// locale_set_default( 'pl-PL' );
// locale_set_default( 'pl_PL' );
// locale_set_default( 'pl' );
// var_dump( locale_get_default() );
echo strftime( "%A" );
