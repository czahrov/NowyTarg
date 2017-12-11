<?php
	
	date_default_timezone_set( "Europe/Warsaw" );
	
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5' );
	
	if( !is_admin() ){
		// wp_enqueue_script( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, bool $in_footer = false )
		wp_enqueue_script( "jq", get_stylesheet_directory_uri() . "/js/jquery-3.2.1.min.js", array(), false, true );
		wp_enqueue_script( "jq-touchSwipe", get_stylesheet_directory_uri() . "/js/jquery.touchSwipe.min.js", array(), false, true );
		wp_enqueue_script( "bootstrap-bundle", get_stylesheet_directory_uri() . "/js/bootstrap.bundle.min.js", array(), false, true );
		wp_enqueue_script( "main", get_stylesheet_directory_uri() . "/js/main.js", array(), false, true );
		wp_enqueue_script( "agency", get_stylesheet_directory_uri() . "/js/agency.js", array(), false, true );
		wp_enqueue_script( "more", get_stylesheet_directory_uri() . "/js/more.js", array(), false, true );
		wp_enqueue_script( "facepalm", get_stylesheet_directory_uri() . "/js/facepalm.js", array(), time(), true );
		
		
		// wp_enqueue_style( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, string $media = 'all' )
		wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . "/css/bootstrap.css" );
		wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . "/css/font-awesome.min.css" );
		wp_enqueue_style( 'main', get_stylesheet_directory_uri() . "/css/main.css" );
		wp_enqueue_style( 'style', get_stylesheet_directory_uri() . "/style.css", array(), time() );
		
	}
	
	function checkAccess(){
		
		if( $_SESSION[ 'sprytne' ] === true ){
			return true;
			
		}
		elseif( isset( $_GET[ 'sprytne' ] ) ){
			$_SESSION[ 'sprytne' ] = true;
			return true;
			
		}
		else{
			return false;
			
		}
		
	}
	
	register_nav_menu( "menu-top", "menu na górze strony" );
	
	/* generuje tytuł strony */
	add_action( 'page_title', function( $arg ){
		$site_name = get_bloginfo( 'name' );
		
		if( is_home() ){
			$page_title = 'Strona główna';
			
		}
		else{
			if( is_category() ){
				$page_title = single_cat_title();
				
			}
			elseif( is_page() ){
				$page_title = get_post()->post_title;
				
			}
			
		}
		
	printf( "%s | %s",
		$page_title,
		$site_name
	);
		
	} );
	
	/* dodaje klasy do elementu body */
	add_action( 'body_class', function( $arg ){
		
		$t = array();
		
		if( is_home() ){
			$t[] = 'home';
			
		}
		else{
			$t[] = get_post()->post_name;
			
		}
		
		if( is_admin_bar_showing() ) $t[] = 'wp_bar';
		
		echo implode( " ", $t );
	} );
	
	/* generuje raklamę - v/h/l/f ( pionowy/poziomy/duży/pełna szerokość ) */
	add_action( 'get_ad', function( $type ){
		
		$m_val = null;
		switch( $type ){
			case 'vertical':
				$m_val = 'pionowy';
				
			break;
			case 'horizontal':
				$m_val = 'poziomy';
				
			break;
			case 'large':
				$m_val = 'duży';
				
			break;
			case 'full':
				$m_val = 'full';
				
			break;
			
		}
		
		if( $m_val !== null ){
			$posts = get_posts( array( 
				'numberposts' => 1,
				'orderby' => 'rand',
				'category_name' => 'baner-reklamowy',
				'meta_key' => 'typ',
				'meta_value' => $m_val,
				
			) );
			
			$meta = get_post_meta( $posts[0]->ID );
			$url = $meta['url'][0];
			$img_id = $meta['obraz'][0];
			
			printf( 
				"<div class='img-ad'>
					<span class='header-ad'>reklama</span>
					<a href='%s'>
						<img src='%s'>
					</a>
				</div>",
				$url,
				wp_get_attachment_image_url( $img_id, 'full' )
			);
			
		}
		
	} );
	
	/* generuje komunikat o transmisji live */
	add_action( 'get_live', function( $arg ){
		
		/* tablica przechowująca wszystkie transmisje live, które mogą być wyświetlane */
		
		$lives = get_posts( array(
			'numberposts' => 1,
			'order' => 'DESC',
			'orderby' => 'date',
			'category_name' => 'transmisja-live',
			'meta_key' => 'visibility',
			'meta_value' => 'true',
			
		) );
		
		if( empty( $lives ) ){
			
			$auto = get_posts( array(
				'category_name' => 'transmisja-live',
				'meta_key' => 'visibility',
				'meta_value' => 'auto',
				
			) );
			
			foreach( $auto as $item ){
				$meta = get_post_meta( $item->ID );
				
				// 01/06/2020-12:00
				$start = $meta[ 'start' ][0];
				sscanf( $start, "%u/%u/%u-%u:%u", $start_day, $start_month, $start_year, $start_hour, $start_minute );
				$t = new DateTime( sprintf( "%u-%u-%u %u:%u:00", 
					$start_year,
					$start_month,
					$start_day,
					$start_hour,
					$start_minute
					
				) );
				$start_time = $t->getTimestamp();
				
				// 01/06/2020-12:00
				$end = $meta[ 'end' ][0];
				sscanf( $end, "%u/%u/%u-%u:%u", $end_day, $end_month, $end_year, $end_hour, $end_minute );
				$t = new DateTime( sprintf( "%u-%u-%u %u:%u:00", 
					$end_year,
					$end_month,
					$end_day,
					$end_hour,
					$end_minute
					
				) );
				$end_time = $t->getTimestamp();
				
				// 2013-03-15 23:40:00
				$t = new DateTime();
				$now = $t->getTimestamp();
				
				if( $start_time <= $now && $now < $end_time ){
					$lives[] = $item;
					break;
					
				}
				
			}
			
		}
		
		if( !empty( $lives ) ){
			$item = $lives[0];
			
			$meta = get_post_meta( $item->ID );
			
			switch( $meta[ 'header_type' ][0] ){
				case "text":
					printf( 
						"<div id='live'>
							<div class='container'>
								<div class='row'>
									<div class='col-xl-2 box'>
										transmisja na żywo:
									</div>
									<div class='col-xl-8 align-self-center info'>
										<div class='header'>%s</div>
										<div class='subheader'>%s</div>
										
									</div>
									<a href='%s' target='_blank' class='col-xl-2 align-self-center btn'>
										<span class='icon fa fa-play-circle-o'></span>
										oglądaj na żywo
										
									</a>
									
								</div>
								
							</div>
							
						</div>",
						$meta[ 'header' ][0],
						$meta[ 'subheader' ][0],
						$meta[ 'www' ][0]
					);
					
				break;
				case "img":
					printf( 
						"<div id='live'>
							<div class='container'>
								<div class='row'>
									<div class='col-xl-2 box'>
										transmisja na żywo:
									</div>
									<a href='%s' target='_blank' class='col-xl-10 banner' style='background-image: url(%s)'></a>
									
								</div>
								
							</div>
							
						</div>",
						$meta[ 'www' ][0],
						wp_get_attachment_image_url( $meta[ 'img' ][0], 'full' )
					);
					
				break;
				
			}
			
		}
		
		// $meta = get_post_meta( $posts[0]->ID );

		// print_r( $posts );
		// print_r( $meta );
		
		// print_r( $lives );
		
	} );
	
	add_action( 'breadcrumb', function( $arg ){
				
		$data = array();
		
		if( is_page() ){
			$current = get_post();
			
			do{
				array_push( $data, array(
					'title' => $current->post_title,
					'url' =>  get_permalink( $current->ID ),
					
				) );
				
				$current = get_post( $current->post_parent );
				
			}
			while( $current->ID !== 0 );
			
		}
		elseif( is_category() ){
			
			$name = single_cat_title( '', false );
			$cat = get_terms( array(
				'taxonomy' => 'category',
				'name' => $name,
				'number' => 1,
				
			) );
			
			array_push( $data, array(
				'title' => $name,
				'url' => get_category_link( $cat[0]->term_id ),
				
			) );
			
		}
		else{
			$post = get_post();
			$cats = wp_get_post_categories( $post->ID );
			$cat = get_category( $cats[0] );
			
			array_push( $data, array(
				'title' => $cat->name,
				'url' => get_category_link( $cat->cat_ID ),
				
			) );
			
		}
		
/* 
	<div class='row'>
		<div class='breadcrumb'>
			<span>Przeglądasz teraz:</span> 
			<div class='sep'><a href='Strona główna'>Strona Główna</a></div>
			<div class='sep'><a class='active' href='Aktualności'>Aktualności</a></div>
		</div>
	</div>
 */
 
		echo 
		"<div class='row'>
			<div class='breadcrumb'>
				<span>Przeglądasz teraz:</span> 
				<div class='sep'><a href='" . home_url() . "'>Strona Główna</a></div>";
		
		foreach( $data as $item ){
			echo "<div class='sep'><a class='active' href='{$item['url']}'>{$item['title']}</a></div>";
			
		}
		
		echo 
		"</div>
			</div>";
		
	} );
	
	