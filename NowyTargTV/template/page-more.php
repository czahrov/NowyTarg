<?php
/*
	Template Name: Ładuj więcej - AJAX
*/

if( !isAjax() ){
	header( "Location: " . home_url() );
	
}

// print_r( $_POST );

$cat_ID = (int)$_POST[ 'category' ];
$offset = (int)$_POST[ 'offset' ];
$num = (int)$_POST[ 'num' ];

if( in_array( $cat_ID, getBaseCats() ) ){
	$ret = array();
	$posts = get_posts( array(
		'category' => $cat_ID,
		'numberposts' => $num,
		'offset' => $offset,
		
	) );
	
	foreach( $posts as $post ){
		$ret[] = array(
			'url' => get_the_permalink( $post->ID ),
			'img' => getPostImg( $post->ID, 'large' ),
			'icon' => genPostIcon( $post->ID ),
			'title' => $post->post_title,
			
		);
		
	}
	
	echo json_encode( $ret );
	
}

