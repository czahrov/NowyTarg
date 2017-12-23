<?php
	
	setlocale( LC_ALL, 'poland' );
	date_default_timezone_set( "Europe/Warsaw" );
	
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5' );
	add_theme_support( 'post-formats', array( 'gallery', 'video' ) );
	
	if( !is_admin() ){
		// wp_enqueue_script( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, bool $in_footer = false )
		wp_enqueue_script( "jq", get_stylesheet_directory_uri() . "/js/jquery-3.2.1.min.js", array(), false, true );
		wp_enqueue_script( "jq-touchSwipe", get_stylesheet_directory_uri() . "/js/jquery.touchSwipe.min.js", array(), false, true );
		wp_enqueue_script( "bootstrap-bundle", get_stylesheet_directory_uri() . "/js/bootstrap.bundle.min.js", array(), false, true );
		wp_enqueue_script( "main", get_stylesheet_directory_uri() . "/js/main.js", array(), time(), true );
		wp_enqueue_script( "agency", get_stylesheet_directory_uri() . "/js/agency.js", array(), false, true );
		wp_enqueue_script( "more", get_stylesheet_directory_uri() . "/js/more.js", array(), false, true );
		wp_enqueue_script( "gsap-css", get_stylesheet_directory_uri() . "/js/CSSPlugin.min.js", array(), false, true );
		wp_enqueue_script( "gsap-TweenL", get_stylesheet_directory_uri() . "/js/TweenLite.min.js", array(), false, true );
		wp_enqueue_script( "gsap-TimeL", get_stylesheet_directory_uri() . "/js/TimelineLite.min.js", array(), false, true );
		wp_enqueue_script( "parallax", get_stylesheet_directory_uri() . "/js/parallax.min.js", array(), false, true );
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
	
	register_sidebar( array(
		'name' => 'pogoda',
		'id' => 'sidebar-weather',
		'description' => 'Sidebar na pogodę',
		
	) );
	
	register_sidebar( array(
		'name' => 'waluta',
		'id' => 'sidebar-currency',
		'description' => 'Sidebar kurs wymiany walut',
		
	) );
	
	/* generuje tytuł strony */
	add_action( 'page_title', function( $arg ){
		$site_name = get_bloginfo( 'name' );
		
		if( is_home() ){
			$page_title = 'Strona główna';
			
		}
		elseif( is_tag() ){
			$path = $_SERVER[ 'REQUEST_URI' ];
			$t = get_option( 'tag_base' );
			$tag_word = !empty( $t )?( $t ):( 'tag' );
			$pattern = "~([^/]+)/~";
			preg_match_all( $pattern, $path, $match );
			$tag = getTag( end( $match[1] ) );
			
			$page_title = $tag->name;
			
		}
		elseif( is_search() ){
			$page_title = $_GET[ 's' ];
			
		}
		else{
			if( is_category() ){
				$page_title = single_cat_title();
				
			}
			else{
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
		
		if( isMobile() ) $t[] = 'mobile';
		
		echo implode( " ", $t );
	} );
	
	/* generuje raklamę */
	add_action( 'get_ad', function( $place, $args = array() ){
		
		/*
			<div class='img-ad'>
				<span class='header-ad'>reklama</span>
				<a href='%s'>
					<img src='%s'>
				</a>
			</div>
		
			$posts = get_posts( array( 
				'numberposts' => 1,
				'orderby' => 'rand',
				'category_name' => 'baner-reklamowy',
				'meta_key' => 'typ',
				'meta_value' => $m_val,
				
			)
		
			wp_get_attachment_image_url( $img_id, 'full' )
		*/
		
		$posts = get_posts( array(
			'numberposts' => 1,
			'orderby' => 'rand',
			'meta_query' => array(
				array(
					'key' => 'miejsce',
					'value' => $place,
					'compare' => 'LIKE',
					
				),
				
			),
			
		) );
		
		if( !empty( $posts ) ){
			$item = $posts[0];
			$img = null;
			switch( get_post_meta( $item->ID, 'typ', true ) ){
				case "local":
					$img = wp_get_attachment_image_url( get_post_meta( $item->ID, 'obraz', true ), 'full' );
					
				break;
				case "uri":
					$img = get_post_meta( $item->ID, 'uri', true );
					
				break;
				
			}
			
			$href = get_post_meta( $item->ID, 'href', true );
			$target = get_post_meta( $item->ID, 'target', true );
			
			/*
			<div class="parallax-window" data-parallax="scroll" data-image-src="/path/to/image.jpg"></div>
			*/
			
			if( $args['parallax'] === true ){
				printf(
					"<a href='%s' target='%s' class='parallax-window d-block' data-parallax='scroll' data-image-src='%s'></a> ",
					$href,
					$target,
					$img
				);
				
			}
			else{
				printf(
					"<div class='img-ad'>
						<span class='header-ad'>reklama</span>
						<a href='%s' target='%s'>
							<img src='%s'>
						</a>
					</div>",
					$href,
					$target,
					$img
				);
				
			}
						
		}
		
	}, 10, 2 );
	
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
						"<div id='live' class='text'>
							<div class='container'>
								<div class='row'>
									<div class='box col-md-3 col-xl-2 d-flex align-items-center justify-content-center'>
										transmisja na żywo:
									</div>
									<div class='col-12 col-md align-self-center info d-flex flex-column justify-content-center'>
										<div class='header'>%s</div>
										<div class='subheader'>%s</div>
										
									</div>
									<a class='col-12 col-md col-lg-3 align-self-center btn' href='%s' target='_blank'>
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
						"<div id='live' class='img'>
							<div class='container'>
								<div class='row'>
									<div class='box col-md-3 col-xl-2 d-flex align-items-center justify-content-center'>
										transmisja na żywo:
									</div>
									<a class='col banner' href='%s' target='_blank' style='background-image: url(%s)'></a>
									
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
	
	/* generuje breadcrumb */
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
		elseif( is_tag() ){
			$path = $_SERVER[ 'REQUEST_URI' ];
			$t = get_option( 'tag_base' );
			$tag_word = !empty( $t )?( $t ):( 'tag' );
			$pattern = "~([^/]+)/~";
			preg_match_all( $pattern, $path, $match );
			$tag = getTag( end( $match[1] ) );
			
			$data[] = array(
				'title' => $tag->name,
				'url' => get_tag_link( $tag ),
				
			);
			
		}
		elseif( is_search() ){
			$data[] = array(
				'title' => $_GET[ 's' ],
				'url' => home_url( "/?s={$_GET[ 's' ]}" ),
				
			);
			
		}
		else{
			$post = get_post();
			$cats = wp_get_post_categories( $post->ID );
			$cat = get_category( $cats[0] );
			
			array_push( $data, array(
				'title' => $cat->name,
				'url' => get_category_link( $cat->cat_ID ),
				
			) );
			
			array_push( $data, array(
				'title' => $post->post_title,
				'url' => get_permalink( $post->ID ),
				
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
		
		foreach( $data as $num => $item ){
			$class = $num === count( $data ) - 1?( 'active' ):( '' );
			echo "<div class='sep'><a class='{$class}' href='{$item['url']}'>{$item['title']}</a></div>";
			
		}
		
		echo 
		"</div>
			</div>";
		
	} );
	
	/* osadza filmiki z youtube na stronie */
	add_action( 'youtube', function( $id ){
		$post = get_post( $id );
		$yt = get_post_meta( $id, 'youtube', true );
		if( empty( $yt ) ) return false;
		
		$arr = array_map( "trim", explode( "|", $yt ) );
		
		/*
			https://youtu.be/fGDfbAOyTuM
			https://www.youtube.com/watch?v=fGDfbAOyTuM&feature=youtu.be
			https://www.youtube.com/watch?v=zMZfLkvNlkE&feature=share
		*/
		
		$vids = array();
		
		foreach( $arr as $video ){
			// $pattern = "~(?:v=([^&]+))|(?:/([^/]+)$)~";
			$pattern = "~.+/(.+?v=)?([^&]+)?~";
			preg_match( $pattern, $video, $match );
			$vids[] = sprintf( "<iframe class='player col-12' src='https://www.youtube.com/embed/%s' allowfullscreen></iframe>", 
				end( $match )
				
			);
			
		}
		
		printf(
			"<div class='col-12 section_title youtube'>
				<h1>Filmy</h1>
				<div class=''>
					%s
				</div>
			</div>", 
			implode( "", $vids )
		);
		
/* <<<EOT
<div class='col-xl-12 section_title latest_news'>
	<h1>Ostatnie nowości</h1>
	<div class='row clear'>
		<div class='col-md-6 load_more' style='display: block;'>
			<a class='link_post' href='http://poligon.scepter.pl/SzymonJ/nowytargtv_wp/oskar-kaczmarczyk-po-mistrzostwach-swiata-superenduro-poczynilem-progres/'>
				<div class='post_aktualnosci' style='background-image:url(http://poligon.scepter.pl/SzymonJ/nowytargtv_wp/wp-content/themes/NowyTargTV/joomla_import/images/galerie/2017/sport/hokej/111aaoskikaczmarczykk12121.jpg);'>
					<div class='news_date'>2017-12-11</div>
					<span>0 komentarzy</span>
				</div>
				<span class='post_aktualnosci_tiitle'>
					Oskar Kaczmarczyk po Mistrzostwach Świata SuperEnduro: „Poczyniłem progres”
				</span>
				<p class='post_aktulanosci'></p>
				<p style='text-align: justify;'>
					<strong>Inauguracyjna eliminacja Mistrzostw Świata FIM SuperEnduro 2018 nie tylko przejdzie do historii jako runda wielkiego powrotu do gry Tadka Błażusiaka – zwycięzcy sobotniego wyścigu klasy Prestige – ale także jako runda z mocnym wejściem Juniora Oskara Kaczmarczyka. Nowotarżanin, dla którego rozpoczynający się sezon jest już trzecim w Mistrzostwach Świata SuperEnduro, pierwszy przystanek nowej serii podsumował wysokim szóstym miejscem.</strong>
				</p>
				<p></p>
			</a>
		</div>
	</div>
</div>
EOT; */
		
	} );
	
	/* generuje galerię obrazków */
	add_action( 'gallery', function( $id ){
		$post = get_post( $id );
		$gal_name = get_post_meta( $id, 'gallery_name', true );
		if( empty( $gal_name ) ) return false;
		
		/* /home/users/scepterssd/public_html/poligon/SzymonJ/nowytargtv_wp/wp-content/themes/NowyTargTV */
		$base_url = get_template_directory();
		/* http://poligon.scepter.pl/SzymonJ/nowytargtv_wp/wp-content/themes/NowyTargTV */
		$base_uri = get_template_directory_uri();
		$file_path = "/joomla_import/" . $gal_name;
		$files = glob( "{$base_url}{$file_path}/*" );
		
		$items = array();
		foreach( $files as $file ){
			if( in_array( strtolower( pathinfo( $file, PATHINFO_EXTENSION  ) ), array( "jpg", "jpeg", "bmp", "png" ) ) ){
				$items[] = sprintf( "<a href='%s' target='_blank' class='item popup col-12 col-sm-6 col-md-4 col-lg-3' style='background-image:url(%s)'></a>", 
					str_replace( $base_url, $base_uri, $file ),
					str_replace( $base_url, $base_uri, $file )
					
				);
				
			}
			
		}
		
		// print_r( $items );
		
		printf(
			"<div class='col-12 section_title gallery'>
				<h1>Galeria zdjęć</h1>
				<div class='row'>
					%s
				</div>
			</div>", 
			implode( "", $items )
		);
		
/* <<<EOT
<div class='col-xl-12 section_title latest_news'>
	<h1>Ostatnie nowości</h1>
	<div class='row clear'>
		<div class='col-md-6 load_more' style='display: block;'>
			<a class='link_post' href='http://poligon.scepter.pl/SzymonJ/nowytargtv_wp/oskar-kaczmarczyk-po-mistrzostwach-swiata-superenduro-poczynilem-progres/'>
				<div class='post_aktualnosci' style='background-image:url(http://poligon.scepter.pl/SzymonJ/nowytargtv_wp/wp-content/themes/NowyTargTV/joomla_import/images/galerie/2017/sport/hokej/111aaoskikaczmarczykk12121.jpg);'>
					<div class='news_date'>2017-12-11</div>
					<span>0 komentarzy</span>
				</div>
				<span class='post_aktualnosci_tiitle'>
					Oskar Kaczmarczyk po Mistrzostwach Świata SuperEnduro: „Poczyniłem progres”
				</span>
				<p class='post_aktulanosci'></p>
				<p style='text-align: justify;'>
					<strong>Inauguracyjna eliminacja Mistrzostw Świata FIM SuperEnduro 2018 nie tylko przejdzie do historii jako runda wielkiego powrotu do gry Tadka Błażusiaka – zwycięzcy sobotniego wyścigu klasy Prestige – ale także jako runda z mocnym wejściem Juniora Oskara Kaczmarczyka. Nowotarżanin, dla którego rozpoczynający się sezon jest już trzecim w Mistrzostwach Świata SuperEnduro, pierwszy przystanek nowej serii podsumował wysokim szóstym miejscem.</strong>
				</p>
				<p></p>
			</a>
		</div>
	</div>
</div>
EOT; */
		
	} );
	
	/* Generowanie meta-tagów dla social-mediów na stronie pojedynczego wpisu */
	add_action( 'social_tag', function(){
		
		// https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse
		/*
			<meta property="og:url"                content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
			<meta property="og:type"               content="article" />
			<meta property="og:title"              content="When Great Minds Don’t Think Alike" />
			<meta property="og:description"        content="How much does culture influence creative thinking?" />
			<meta property="og:image"              content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />
		*/
		
		if( is_single() ){
			$item = get_post();
			$url = get_permalink( $item->ID );
			$title = $item->post_title;
			
			preg_match( "~(?:[^\.]+\.){1,4}~", strip_tags( $item->post_excerpt ), $match );
			$description = $match[0];
			
			$meta = get_post_meta( $item->ID );
			$img = null;
			$t = $meta[ 'thumb' ][0];
			if( !empty( $t ) ){
				$img = get_template_directory_uri() . "/joomla_import/{$t}";
				
			}
			else{
				$t = get_the_post_thumbnail_url( $item->ID );
				if( !empty( $t ) ){
					$img = $t;
					
				}
				else{
					$img = get_template_directory_uri() . "/media/logo.png";
					
				}
				
			}
			
			printf( 
				"<meta property='og:url' content='%s' />
				<meta property='og:type' content='article' />
				<meta property='og:title' content='%s' />
				<meta property='og:description' content='%s' />
				<meta property='og:image' content='%s' />", 
				$url,
				$title,
				$description,
				$img
				
			);
			
		}
		
	} );
	
	/* Logger do celów diagnostycznych */
	function logger( $log = null ){
		static $data = array();
		
		if( $log !== null ){
			$data[] = $log;
			
		}
		else{
			return $data;
			
		}
		
	}
	
	/* Zwraca ID kategorii po tytule */
	function getCatByName( $name ){
		$cat = get_terms( array(
			'taxonomy' => 'category',
			'hide_empty' => false,
			'name' => $name,
			
		) );
		
		if( count( $cat ) > 0 ){
			return $cat[0]->term_id;
			
		}
		else return false;
		
		
	}
	
	/* Zwraca listę załączników, albo pojedyczny załącznik po ID albo po tytule */
	function wpMedia( $arg = null ){
		if( $arg === null ){
			return get_posts( array(
				'numberposts' =>  -1,
				'post_type' => 'attachment',
				
			) );
			
		}
		elseif( is_string( $arg ) ){
			return get_posts( array(
				'numberposts' =>  1,
				'post_type' => 'attachment',
				'title' => $arg,
				
			) )[0];
			
		}
		elseif( is_int( $arg ) ){
			return get_posts( array(
				'numberposts' =>  1,
				'post_type' => 'attachment',
				'attachment_id' => $arg,
				
			) )[0];
			
		}
		else{
			return false;
			
		}
		
	}
	
	/* Funkcja importująca grafiki z Joomli */
	function JoomlaImgs(){
		/* Tablica plików do pobrania */
		$files = json_decode( file_get_contents( "http://nowytarg24.tv/scepter.php?sprytne" ) );
		
		/* Jeśli dane nie zostały wczytane poprawnie zwraca false */
		if( !is_array( $files ) or count( $files ) === 0 ) return false;
		
		/* Pobieranie plików */
		$local_base = __DIR__ . "/joomla_import";
		$remote_base = "http://nowytarg24.tv/";
		foreach( $files as $file ){
			/* Pomija już istniejące pliki */
			if( file_exists( "{$local_base}/{$file}" ) ){
				if( is_dir( "{$local_base}/{$file}" ) ) rmdir( "{$local_base}/{$file}" );
				continue;
				
			}
			
			/* Sprawdza czy istnieje docelowy folder zapisu dla pliku ( tworzy go jeśli nie istnieje ) */
			if( !file_exists( dirname( "{$local_base}/{$file}" ) ) ) mkdir( dirname( "{$local_base}/{$file}" ), 0755, true );
			
			/* Pobiera plik */
			@copy( "{$remote_base}/{$file}", "{$local_base}/{$file}" );
			
		}
		
		return true;
		
	}
	
	/* Klasa importująca wpisy z JSONa */
	require_once __DIR__ . "/php/ClassJoomlaImporter.php";
	
	// Zwraca url obrazka wyróżniającego
	function getPostImg( $id ){
		$thumb = get_the_post_thumbnail_url( $id, 'full' );
		$meta = get_post_meta( $id, 'thumb', true );
		
		return !empty( $thumb )?( $thumb ):( !empty( $meta )?( home_url( 'wp-content/themes/NowyTargTV/joomla_import/' ) . $meta ):( "http://via.placeholder.com/200x200" ) );
		
	}
	
	// Zwraca tablicę najnowszych wpisów z wideo
	function getLatestVideo( $arg = array() ){
		$params = array(
			'category__in' => getBaseCats(),
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-video' ),
					
				),
				
			),
			
		);
		
		if( is_array( $arg ) ){
			$params = array_merge( $params, $arg );
			
		}
		
		return get_posts( $params );
		
	}
	
	// Zwraca tablicę ID kategorii dla podkategorii kategorii Portal
	function getBaseCats( $arg = array() ){
		static $ret = array();
		
		if( empty( $ret ) ){
			$params = array(
				'taxonomy' => 'category',
				'parent' => getCatByName( 'Portal' ),
				
			);
			
			if( is_array( $arg ) ){
				$params = array_merge( $params, $arg );
				
			}
			
			$cats = get_terms( $params );
			
			foreach( $cats as $cat ){
				$ret[] = $cat->term_id;
				
			}
			
		}
		
		return $ret;
		
	}
	
	// Generuje ikonkę dla wpisu
	function genPostIcon( $ID ){
		$item = get_post( $ID );
		$icon = '';
		switch( get_post_format( $item ) ){
			case 'video':
				$icon = " <i class='fa fa-play-circle-o'></i>";
			break;
			case 'gallery':
				$icon = " <i class='fa fa-picture-o'></i>";
			break;
			
		}
		
		return $icon;
		
	}
	
	// Generuje tablicę tagów ( WP_Term ) występujących na stronie
	function getTagCloud( $arg = array() ){
		$ret = array();
		
		$params = array(
			'taxonomy' => 'post_tag',
			'order' => 'DESC',
			'orderby' => 'count',
			
		);
		
		if( is_array( $arg ) ) $params = array_merge( $params, $arg );
		
		return get_tags( $params );
		
	}
	
	// Generuje tablicę wpisów z wydarzeniami
	function getWydarzenia( $arg = array() ){
		$params = array(
			'category_name' => 'Będzie się działo',
			
		);
		
		if( is_array( $arg ) ) $params = array_merge( $params, $arg );
		
		return get_posts( $params );
		
	}
	
	// Generuje tablicę z ostatnimi nowościami
	function getLatestNews( $arg = array() ){
		$cats = wp_get_post_categories( get_post()->ID );
		
		$params = array(
			'category' => $cats[0],
			'exclude' => get_post()->ID,
			
		);
		
		if( is_array( $arg ) ) $params = array_merge( $params, $arg );
		
		return get_posts( $params );
		
	}
	
	// Generuje tablicę z aktualnościami
	function getAktualnosci( $arg = array() ){
		$params = array(
			'category_name' => 'Aktualności',
			
		);
		
		if( is_array( $arg ) ) $params = array_merge( $params, $arg );
		
		return get_posts( $params );
		
	}
	
	// Generuje tablicę z najpopularniejszymi wpisami
	function getPopulars( $arg = array() ){
		$params = array(
			'category_name' => 'Popularne',
			
		);
		
		if( is_array( $arg ) ) $params = array_merge( $params, $arg );
		
		return get_posts( $params );
		
	}
	
	// Generuje tablicę z wpisami ze sportu
	function getSport( $arg = array() ){
		$params = array(
			'category_name' => 'Sport',
			
		);
		
		if( is_array( $arg ) ) $params = array_merge( $params, $arg );
		
		return get_posts( $params );
		
	}
	
	// Generuje tablicę z wpisami z kultury
	function getKultura( $arg = array() ){
		$params = array(
			'category_name' => 'Kultura',
			
		);
		
		if( is_array( $arg ) ) $params = array_merge( $params, $arg );
		
		return get_posts( $params );
		
	}
	
	// Generuje tablicę z ogłoszeniami
	function getOgloszenia( $arg = array() ){
		$params = array(
			'category_name' => 'Ogłoszenia urzędowe',
			
		);
		
		if( is_array( $arg ) ) $params = array_merge( $params, $arg );
		
		return get_posts( $params );
		
	}
	
	// Zwraca ID tagu po slugu
	function getTag( $slug ){
		$term = get_terms( array(
			'taxonomy' => 'post_tag',
			'hide_empty' => false,
			'slug' => $slug,
			
		) );
		
		return $term[0];
		
	}
	
	// Funkcja skracająca opis
	function shortText( $text ="", $limit = 200 ){
		$text = strip_tags( $text );
		$pattern = "~^(.{0,{$limit}}(?:\s))(.+)$~";
		preg_match( $pattern, $text, $match );
		$replace = "$1(...)";
		
		return preg_replace( $pattern, $replace, $text );
		
	}
	
	// Sprawdza czy klient korzysta z urządzenia mobilnego
	function isMobile(){
		$pattern = "~Mobile|Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini~i";
		preg_match( $pattern, $_SERVER[ 'HTTP_USER_AGENT' ], $match );
		return count( $match ) !== 0;
		
	}
	
	// Zwraca dane o stanie powietrza
	function getAirCon(){
		$data = array();
		
		// ID stacji pomiarowej w Nowym Targu
		$id = 10254;
		
		$uri = "http://api.gios.gov.pl/pjp-api/rest/station/sensors/{$id}";
		$resp = file_get_contents( $uri );
		$json_typy = json_decode( $resp, true );

		$uri = "http://api.gios.gov.pl/pjp-api/rest/aqindex/getIndex/{$id}";
		$resp = file_get_contents( $uri );
		$json_status = json_decode( $resp, true );
		
		foreach( $json_typy as $typ ){
			$data[ 'type' ][ $typ[ 'param' ][ 'paramFormula' ] ] = array(
				'name' => $typ[ 'param' ][ 'paramName' ],
				
			);
			
		}
		
		foreach( $data[ 'type' ] as $key => $arr ){
			$id = strtolower( $key );
			$data[ 'type' ][ $key ][ 'status' ] = $json_status[ "{$id}IndexLevel" ][ 'indexLevelName' ];
			$data[ 'type' ][ $key ][ 'date' ] = $json_status[ "{$id}SourceDataDate" ];
			
		}
		
		$data[ 'main' ] = array(
			'name' => $json_status[ 'stIndexLevel' ][ 'indexLevelName' ],
			'date' => $json_status[ 'stCalcDate' ],
			
		);
		
		/*
		Array
		(
			[type] => Array
				(
					[PM10] => Array
						(
							[name] => pył zawieszony PM10
							[status] => Bardzo dobry
							[date] => 2017-12-23 22:00:00
						)

					[SO2] => Array
						(
							[name] => dwutlenek siarki
							[status] => Bardzo dobry
							[date] => 2017-12-23 23:00:00
						)

				)

			[main] => Array
				(
					[name] => Bardzo dobry
					[date] => 2017-12-23 23:20:27
				)

		)
		*/
		
		return $data;
		
	}
	
	add_action( 'minipanel-air', function( $data ){
		
		$append = array();
		
		foreach( $data[ 'type' ] as $key => $type ){
			$append[] = sprintf(
				"<div class='col-6'>
					Stan %s:
				</div>
				<div class='col-6'>
					%s
				</div>",
				$key,
				$type[ 'status' ]
				
			);
			
		}
		
		printf(
			"<div class='row'>
				<div class='col-6'>
					Ogólny stan powietrza: 
				</div>
				<div class='col-6'>
					%s
				</div>
				%s
				<div class='col-12'>
					Dane z godziny: %s
				</div>
				
			</div>",
			$data[ 'main' ][ 'name' ],
			implode( "", $append ),
			$data[ 'main' ][ 'date' ]
			
		);
		
	} );
	
	