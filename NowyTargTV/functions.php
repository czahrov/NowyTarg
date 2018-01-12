<?php
	
	setlocale( LC_ALL, 'pl_PL' );
	// locale_set_default( 'pl-PL' );
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
		wp_enqueue_style( 'main', get_stylesheet_directory_uri() . "/css/main.css", time() );
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
					"<a %s target='%s' class='parallax-window d-block' data-parallax='scroll' data-image-src='%s'></a> ",
					empty( $href )?( '' ):( "href={$href}" ),
					$target,
					$img
				);
				
			}
			else{
				printf(
					"<div class='img-ad'>
						<span class='header-ad'>reklama</span>
						<a %s target='%s'>
							<img src='%s'>
						</a>
					</div>",
					empty( $href )?( '' ):( "href={$href}" ),
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
			
			array_push( $data, array(
				'title' => $current->post_title,
				'url' =>  get_permalink( $current->ID ),
				
			) );
			
			while( $current->post_parent !== 0 ){
				$current = get_post( $current->post_parent );
				
				array_push( $data, array(
					'title' => $current->post_title,
					'url' =>  get_permalink( $current->ID ),
					
				) );
				
			}
			
			/* do{
				array_push( $data, array(
					'title' => $current->post_title,
					'url' =>  get_permalink( $current->ID ),
					
				) );
				
				$current = get_post( $current->post_parent );
				
			}
			while( $current->ID !== 0 ); */
			
			
			
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
		
		$items = array();
		
		$gal_name = get_post_meta( $id, 'gallery_name', true );
		// logger( array( 'gallery_name' => $gal_name ) );
		// logger( array( 'post_content' => $post->post_content ) );
		
		if( !empty( $gal_name ) ){
			/* Generowanie galerii na podstawie listy plików we wskazanym folderze */
			/* /home/users/scepterssd/public_html/poligon/SzymonJ/nowytargtv_wp/wp-content/themes/NowyTargTV */
			$base_url = get_template_directory();
			/* http://poligon.scepter.pl/SzymonJ/nowytargtv_wp/wp-content/themes/NowyTargTV */
			$base_uri = get_template_directory_uri();
			$file_path = "/joomla_import/" . $gal_name;
			$files = glob( "{$base_url}{$file_path}/*" );
			
			foreach( $files as $file ){
				if( in_array( strtolower( pathinfo( $file, PATHINFO_EXTENSION  ) ), array( "jpg", "jpeg", "bmp", "png" ) ) ){
					$items[] = sprintf( "<a href='%s' target='_blank' class='item popup col-12 col-sm-6 col-md-4 col-lg-3' style='background-image:url(%s)'></a>", 
						str_replace( $base_url, $base_uri, $file ),
						str_replace( $base_url, $base_uri, $file )
						
					);
					
				}
				
			}
			
			
		}
		elseif( stripos( $post->post_content, "[gallery" ) !== false ){
			
			// [gallery columns="9" link="file" size="full" ids="4,5,6" orderby="rand"]
			preg_match_all( "~\[gallery[^\]]+?\]~", $post->post_content, $galleries );
			$ids = array();
			foreach( $galleries[0] as $gallery ){
				preg_match( "~ids=\"(.+?)\"~", $gallery, $match );
				$ids = array_merge( $ids, explode( ",", $match[1] ) );
				// logger( array( 'ids' => $ids ) );
				
			}
			
			// 4,5,6
			foreach( $ids as $id ){
				$img_thumb = wp_get_attachment_image_url( $id, 'large' );
				$img_full = wp_get_attachment_image_url( $id, 'full' );
				
				$items[] = sprintf( "<a href='%s' target='_blank' class='item popup col-12 col-sm-6 col-md-4 col-lg-3' style='background-image:url(%s)'></a>", 
					$img_full,
					$img_thumb
					
				);
				
			}			
			
		}
		else{
			return false;
			
		}
		
		// print_r( $items );
		
		printf(
			"<div id='galeria' class='col-12 section_title gallery'>
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
	function getPostImg( $id, $size = 'thumbnail', $srcset = false ){
		$thumb = get_the_post_thumbnail_url( $id, $size );
		$meta = get_post_meta( $id, 'thumb', true );
		
		if( !empty( $thumb ) ){
			if( $srcset === true ){
				return array(
					'src' => $thumb,
					'srcset' => wp_get_attachment_image_srcset( $id, $size ),
					
				);
				
			}
			else{
				return $thumb;
				
			}
			
		}
		elseif( !empty( $meta ) ){
			return home_url( 'wp-content/themes/NowyTargTV/joomla_import/' ) . $meta;
			
		}
		else{
			return false;
			
		}
		
		// return !empty( $thumb )?( $thumb ):( !empty( $meta )?( home_url( 'wp-content/themes/NowyTargTV/joomla_import/' ) . $meta ):( false ) );
		
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
			'numberposts' => 4,
			
		);
		
		if( is_array( $arg ) ) $params = array_merge( $params, $arg );
		
		return get_posts( $params );
		
		/* static $data = array();
		
		if( empty( $data ) ){
			$con = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
			if( mysqli_connect_errno() === 0 ){
				$sql = "SELECT `id`, `count` FROM `nttv_post_views` WHERE `period` = 'total' ORDER BY `count` DESC LIMIT 4";
				$result = mysqli_query( $con, $sql );
				$data = mysqli_fetch_all( $result, MYSQLI_ASSOC );
				mysqli_free_result( $result );
				mysqli_close( $con );

			}
			
		}
		
		return $data; */
		
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
		static $data = array();
		
		if( empty( $data ) ){
			// plik z zapisem ostatnich poprawnie pobranych danych z API
			$file = __DIR__ . "/data/aircon.json";
			
			// tworzenie folderu i pliku w sytuacji gdy nie istnieje
			if( !file_exists( $file ) ){
				@mkdir( dirname( $file ), 0755, true );
				touch( $file );
				
			}
			
			try{
				$context = stream_context_create( array(
					'http' => array(
						'timeout' => 5.0,
					),
					
				) );
				
				// ID stacji pomiarowej w Nowym Targu
				$id = 10254;
				
				$uri = "http://api.gios.gov.pl/pjp-api/rest/station/sensors/{$id}";
				$resp = @file_get_contents( $uri, false, $context );
				// sprawdza czy udało się odczytać plik
				if( $resp === false ) throw new Exception( "brak dostępu do pliku [$uri]" );
				$resp = json_decode( $resp, true );
				$data[ 'sensors' ] = $resp;
				
				if( !empty( $resp ) ) foreach( $resp as $item ){
					$uri = "http://api.gios.gov.pl/pjp-api/rest/data/getData/{$item['id']}";
					$data[ 'measure' ][] = json_decode( @file_get_contents( $uri, false, $context ), true );
				}
				
				$uri = "http://api.gios.gov.pl/pjp-api/rest/aqindex/getIndex/{$id}";
				$resp = @file_get_contents( $uri, false, $context );
				// sprawdza czy udało się odczytać plik
				if( $resp === false ) throw new Exception( "brak dostępu do pliku [$uri]" );
				$resp = json_decode( $resp, true );
				$data[ 'airquality' ] = $resp;
				
				// zapis danych do backupu
				file_put_contents( $file, json_encode( $data ) );
				
			}
			catch( Exception $e ){
				/* prawdopodobnie wystąpił błąd dostępu do API
				pobieranie danych z backupu */
				$data = json_decode( @file_get_contents( $file ), true );
				
			}
		
		}
		
		
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
	
	// Pobiera dane o prognozie pogody
	function getForecast(){
		/*
			 {
				"id": 7532650,
				"name": "Nowy Targ",
				"country": "PL",
				"coord": {
				  "lon": 20.044201,
				  "lat": 49.489201
				}
			  },
			  {
				"id": 763523,
				"name": "Nowy Targ",
				"country": "PL",
				"coord": {
				  "lon": 20.03228,
				  "lat": 49.477829
				}
			  },
		*/
		
		// OpenWeatherMap
		static $data = array();
		
		if( empty( $data ) ){
			try{
				$context = stream_context_create( array(
					'http' => array(
						'timeout' => 5.0,
					),
					
				) );
				
				// plik z danymi z ostatniego odczytu 
				$file = __DIR__ . "/data/forecast.json";
				if( !file_exists( $file ) ){
					@mkdir( dirname( $file ), 0755 );
					touch( $file );
					
				}
				
				// pobieranie danych ze strony i zapis do pliku
				// api.openweathermap.org/data/2.5/forecast?id=524901&APPID=1111111111 
				$api_key = "7470d10567aa7388d997eba8b8ec3a15";
				$city_id = 763523;
				$lat = 49.477465;
				$long = 20.032096;
				/* weather, forecast, forecast/daily */
				$type = 'weather';
				$language = 'pl';
				$units = 'metric';
				$icon_base = "https://openweathermap.org/img/w/";
				$uri = "http://api.openweathermap.org/data/2.5/{$type}?id={$city_id}&lang={$language}&units={$units}&APPID={$api_key}";
				// http://api.openweathermap.org/data/2.5/weather?id=763523&lang=pl&units=metric&APPID=7470d10567aa7388d997eba8b8ec3a15
				
				// aktualny stan pogody
				$resp = json_decode( @file_get_contents( $uri, false, $context ), true );
				
				// sprawdzenie czy uzyskano dostęp do pliku
				if( $resp === false ) throw new Exception( "Brak dostępu do pliku [$uri]" );
				$data[ 'current' ] = $resp;
				// prognozy na kolejne dni
				$type = 'forecast';
				$uri = "http://api.openweathermap.org/data/2.5/{$type}?id={$city_id}&lang={$language}&units={$units}&APPID={$api_key}";
				// http://api.openweathermap.org/data/2.5/forecast?id=763523&lang=pl&units=metric&APPID=7470d10567aa7388d997eba8b8ec3a15
				
				$resp = json_decode( @file_get_contents( $uri, false, $context ), true );
				// sprawdzenie czy uzyskano dostęp do pliku
				if( $resp === false ) throw new Exception( "Brak dostępu do pliku [$uri]" );
				foreach( $resp[ 'list' ] as $item ){
					if( stripos( $item[ 'dt_txt' ], '12:00:00' ) !== false ){
						$data[ 'forecast' ][] = $item;
						
					}
					
				}
				
				// zapis danych do backupu
				file_put_contents( $file, json_encode( $data ) );
				
			}
			catch( Exception $e ){
				logger( $e );
				/* Wystąpił wyjątek, brak dostępu albo awaria API */
				$data = json_decode( file_get_contents( $file ), true );
				
			}
			
		}
			
		return $data;
		
		/*
			array(2) {
			  ["current"]=>
			  array(4) {
				["temp"]=>
				float(6.63)
				["status"]=>
				string(28) "pochmurno z przejaśnieniami"
				["icon"]=>
				string(40) "https://openweathermap.org/img/w/04d.png"
				["clouds"]=>
				int(75)
			  }
			  ["forecast"]=>
			  array(4) {
				["temp"]=>
				float(1.26)
				["status"]=>
				string(20) "słabe opady deszczu"
				["icon"]=>
				string(40) "https://openweathermap.org/img/w/10n.png"
				["clouds"]=>
				int(88)
			  }
			}
		*/
		/*
			kod pogody
			01 - clear sky
			02 - few clouds
			03 - scattered clouds
			04 - broken clouds
			09 - shower rain
			10 - rain
			11 - thunderstorm
			13 - snow
			50 - mist
			
			kod pory dnia
			d - dzień
			n - noc
			
			zasada tworzenia kodu
			{kod_pogody}{kod_pory_dnia}.png
			
		*/
		
	}
	
	// Pobiera dane o aktualnym kursie ( kupno / sprzedaż ) aktualnej waluty
	function getTrade( $code ){
		static $data = array();
		/*		przykład odpowiedzi dla $code = 'USD'
			{
				"table": "C",
				"currency": "dolar amerykański",
				"code": "USD",
				"rates": [
					{
						"no": "250/C/NBP/2017",
						"effectiveDate": "2017-12-28",
						"bid": 3.4844,
						"ask": 3.5548
					}
				]
			}
		*/
		
		if( empty( $data ) ){
			try{
				$context = stream_context_create( array(
					'http' => array(
						'timeout' => 5.0,
					),
					
				) );
				
				$file = __DIR__ . "/data/trade.json";
				if( !file_exists( $file ) ){
					@mkdir( dirname( $file ), 0755 );
					touch( $file );
					
				}
				
				if( is_array( $code ) ){
					foreach( $code as $item ){
						$uri = "http://api.nbp.pl/api/exchangerates/rates/c/{$item}/?format=json";
						$resp = @file_get_contents( $uri, false, $context );
						// błąd dostępu do pliku
						if( $resp === false ) throw new Exception( "Brak dostępu do pliku [$uri]" );
						$data[ $item ] = json_decode( $resp, true );
						
					}
					
				}
				else{
					$uri = "http://api.nbp.pl/api/exchangerates/rates/c/{$code}/?format=json";
					$resp = @file_get_contents( $uri, false, $context );
					// błąd dostępu do pliku
					if( $resp === false ) throw new Exception( "Brak dostępu do pliku [$uri]" );
					$data = json_decode( $resp, true );
					
				}
				
				// zapis danych do backupu
				file_put_contents( $file, $data );
				
			}
			catch( Exception $e ){
				$data = json_decode( file_get_contents( $file ), true );
				
			}
			
		}
		
		return $data;
		
	}
	
	// sprawdza czy żądanie zostało wysłane poprzez AJAXa
	function isAjax(){
		return $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest";
		
	}
	