<?php
/*
	Template Name: test
*/

if( !DMODE ) header( "Location:" . home_url() );

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

$postID = 21980;

/* $comments = get_comments( array(
	'post_id' => $postID,
	'parent' => 0,
	
) ); */

/*
	$postID - ID wpisu, dla którego wczytywane są komentarze
	$postParent - ID komentarza, dla którego wyszukiwane są komentarze potomne ( odpowiedzi )
	commTree - tablica znalezionych odpowiedzi dla danego komentarza
*/
function commentPrinter( $postID = 0, $postParent = 0, $commTree = array() ){
	if( empty( $commTree ) ){
		$commTree = get_comments( array(
			'post_id' => $postID,
			'parent' => $postParent,
			
		) );
		
	}
	
	foreach( $commTree as $comm ){
		$subTree = get_comments( array(
			'post_id' => $postID,
			'parent' => $comm->comment_ID,
			
		) );
		
		do_action( 'print_comment', $comm );
		
		if( !empty( $subTree ) ){
			echo "<div class='anwser'>";
			commentPrinter( $postID, $comm->comment_ID, $subTree );
			echo "</div>";
			
			/* print_r( array(
				'postID' => $postID,
				'postParent' => $postParent,
				'subTree' => count( $subTree ),
				
			) ); */
			
		}
		
	}
	
}

commentPrinter( $postID );
echo "alo?";
