<?php
/*
	Template Name: test
*/

// 3038 pozycji
/* $jimp = new JoomlaImporter( __DIR__ . "/import/artykuly.json" );
$dt_start = time();
var_dump( $jimp->loadItems( 2800, 400 ) ) . PHP_EOL;
$dt_stop = time();
echo $dt_stop - $dt_start . "[s]"; */

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
// setlocale( LC_ALL, 'pl-PL' );
// locale_set_default( 'pl_PL' );
// locale_set_default( 'pl-PL' );
// locale_set_default( 'pl_PL' );
// locale_set_default( 'pl' );
// var_dump( locale_get_default() );
// echo strftime( "%A" );

// var_dump( wp_get_attachment_image_srcset( 12749, 'medium' ) );

// echo date_i18n( "l, d F", time() );

// var_dump( get_category_link( getCatByName( 'Aktualności' ) ) );

// print_r( get_post_meta( 15249 ) );

/* $con = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if( mysqli_connect_errno() > 0 ){
	echo "Błąd połączenia: " . mysqli_connect_error();
}

print_r( $con );

$sql = "SELECT `id`, `count` FROM `nttv_post_views` WHERE `period` = 'total' ORDER BY `count` DESC LIMIT 4";
$result = mysqli_query( $con, $sql );
print_r( mysqli_fetch_all( $result, MYSQLI_ASSOC ) );
mysqli_free_result( $result );

mysqli_close( $con ); */

// print_r( $_SERVER );
// print_r( $_ENV );

define( "APPDEBUG", true );
$infix = APPDEBUG === true?( "zjadła" ):( "ma" );
echo "Ala {$infix} kota";
