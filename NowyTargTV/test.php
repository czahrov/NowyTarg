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

/*
	bardzo dobry
	dobry
	umiarkowany
	dostateczny
	zły
	bardzo zły
*/

// $input = "https://www.youtube.com/watch?v=QYVjcIpvt10|https://youtu.be/FUpza22te6g|FUpza22te6g|OFEUOTnqNHA";

// print_r( json_decode( getForecast(), true ) );
// $dt = new DateTime();
// echo $dt->getTimestamp() . PHP_EOL;
// print_r( stat( __FILE__ ) ) . PHP_EOL;
/*
	chcemy wyznaczyć element tablicy wskazujący na południe dnia jutrzejszego
	obecnie jest 14:30
	prognozy są co 3 godziny, więc najbliższa jest na 15:00 ( ceil( 14 / 3 ) * 3 )
	minęło południe, więc do 12 dodajemy 24, mamy 36		// dla godziny mniejszej niż 12, należy dodać 36h
	od 36 odejmujemy aktualną godzinę ( 15 ), otrzymujemy 21 ( godzin )
	21 dzielimy na 3, bo co tyle są generowane prognozy, otrzymujemy 7 i tyle powinien wynosić szukany indeks
	
*/

// var_dump( logger() );

print_r( array(
	'weather' => getForecast(),
	'air' => getAirCon(),
	
) );

// print_r( getAirCon() );
