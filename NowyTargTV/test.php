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

/*
	bardzo dobry
	dobry
	umiarkowany
	dostateczny
	zły
	bardzo zły
*/

// print_r( get_category_by_slug( 'bedzie-sie-dzialo' ) );

// print_r( getUstawienia() );

// function test(){
	// static $ret = null;
	
	// if( $ret === null ){
		// $pattern = "~Mobile|Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini~i";
		// preg_match( $pattern, $_SERVER[ 'HTTP_USER_AGENT' ], $match );
		// $ret = count( $match ) !== 0;
		
	// }
	
	// return $ret;
// }

// var_dump( test() );


if( isMobile() ){
	$num = empty( getUstawienia()[ 'more_mob_num' ] )?( 5 ):( (int)getUstawienia()[ 'more_mob_num' ][0] );
	
}
else{
	$num = empty( getUstawienia()[ 'more_num' ] )?( 5 ):( (int)getUstawienia()[ 'more_num' ][0] );
	
}

var_dump( $num );