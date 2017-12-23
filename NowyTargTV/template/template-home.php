<?php
	/*
		Template Name: Szablon - strona główna
	*/
	
	get_header();
	get_template_part( "template/part", "top" );
	
	if( isMobile() ){
		get_template_part( "template/template", "home-mobile" );
		
	}
	else{
		get_template_part( "template/template", "home-standard" );
		
	}
	
	get_template_part( "template/part", "bot" );
	get_footer();
?>