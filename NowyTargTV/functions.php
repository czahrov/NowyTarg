<?php
	
	setlocale( LC_ALL, 'poland' );
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
	
	/* Wgrywanie pliku do folderu z mediami ( testowe ) | zwraca ID dodanego wpisu, albo false */
	function wpMediaImport( $source ){
		/* pobieranie pliku zdalnego */
		$dst = __DIR__ . "/import/" . basename( $source );
		$path = "/wp-content/uploads/" . date( "Y/m" ) . "/" . basename( $source );
		$dst = constant( 'ABSPATH' ) . $path;

		if( !file_exists( $dst ) && copy( $source, $dst ) === true ){
			/* dodawanie wpisu */
			
			$post_data = array(
				'ID' => 0,
				'post_author' => 1,
				'post_title' => 'Test',
				'post_status' => 'publish',
				'post_type' => 'attachment',
				'guid' => get_bloginfo( 'url' ) . $path,
				'post_mime_type' => mime_content_type( $dst ),
				
			);
			
			return wp_insert_post( $post_data );
			
		}
		else{
			return false;
			
		}
		
	}
	
	class JoomlaImporter{
		// ścieżka do pliku JSON ze wpisami z joomli
		private $_fpath;
		// tablica odczytana z pliku JSON
		private $_data = array();
		// tablica z odczytanymi wpisami z joomli
		private $_import = array();
		// ścieżka do miejsca zapisywania obrazów pobieranych z joomli
		private $_img;
		// tryb przetwarzania wpisów EN, [E] - istniejące wpisy, [N] - nowe wpisy
		private $_mode;
		
		public function __construct( $fpath, $mode = 'NE' ){
			if( file_exists( $fpath ) ){
				$this->_update = (bool)$update;
				$this->_img = __DIR__ . "/joomla_img/";
				$this->_fpath = $fpath;
				$this->_loadData();
				$this->_iterateItems();
				
			}
			
		}
		
		// zwraca tablicę odczytanych wpisów
		public function export(){
			return $this->_import;
			
		}
		
		// wczytuje do pamięci dane z pliku JSON
		private function _loadData(){
			$content = file_get_contents( $this->_fpath );
			$this->_data = json_decode( $content, true );
			
		}
		
		// wyciąga dane do wpisu z pojedynczego elementu z JSONa i dodaje wpis do WP
		private function _importItem( $item ){
			// pobiera ID wpisu o takim samym tytule, jeśli wpis nie istnieje zwraca 0 (zero)
			$id = $this->_checkPost( $item['name'] );
			// pomiń, jeśli wpis już istnieje a przetwarzane są tylko NOWE wpisy
			if( $id !== 0 && $this->_mode === 'N' ) return false;
			// pomiń, jeśli wpis NIE istnieje a przetwarzane są tylko ISTNIEJĄCE wpisy
			if( $id === 0 && $this->_mode === 'E' ) return false;
			
			$categories = array();
			$categories[] = getCatByName( 'Import' );
			
			if( !empty( $item['categories'] ) ) foreach( $item['categories'] as $slug ){
				$categories[] = get_category_by_slug( $slug )->cat_ID;
				
			}
			
			$excerpt = "";
			$content = "";
			$thumb = "";
			$youtube = array();
			$gallery_name = "";
			
			foreach( $item['elements'] as $element ){
				
				switch( $element['name'] ){
					case "Ilustracja":
						$thumb = $element['data']['file'];
						
					break;
					case "Lead":
						$excerpt = $element['data'][0]['value'];
						
					break;
					case "Tekst":
						$content = $element['data'][0]['value'];
						
					break;
					case "Media":
					case "Media2":
						if( !empty( $element['data']['url'] ) ){
							$youtube[] = $element['data']['url'];
							
						}
						
					break;
					case "Galeria zdjęć":
						$gallery_name = $element['data']['value'];
						
					break;
					
				}
				
			}
			
			$this->_downloadImg( $thumb );
			
			$t = array(
				'ID' => $id,
				'post_author' => 1,
				'post_date' => $item['created'],
				'post_title' => $item['name'],
				'post_content' => $content,
				'post_excerpt' => $excerpt,
				'post_status' => 'publish',
				'post_category' => $categories,
				'tags_input' => $item['tags'],
				'comment_status' => 'open',
				'meta_input' => array(
					'thumb' => $thumb,
					'youtube' => implode( "|", $youtube ),
					'gallery_name' => $gallery_name,
					
				),
				
			);
			
			$this->_import[] = $t;
			
			wp_insert_post( $t );
			
		}
		
		// funkcja przechodząca po wszystkich importowanych elementach
		private function _iterateItems(){
			if( !empty( $this->_data['items'] ) ) foreach( $this->_data['items'] as $item ){
				$this->_importItem( $item );
				
			}
			
		}
		
		// pobiera obrazek wyróżniajacy na dysk
		private function _downloadImg( $file ){
			$src = "http://nowytarg24.tv/" . $file;
			$path = pathinfo( $src, PATHINFO_DIRNAME );
			if( !file_exists( $path ) ){
				mkdir( $path, 0755, true );
				
			}
			$dst = $this->_img . basename( $src );
			
			if( !file_exists( $dst ) ){
				return @copy( $src, $dst );
				
			}
			else return false;
			
		}
		
		// funkcja sprawdzająca czy dany post już istnieje, zwraca numer ID
		private function _checkPost( $title ){
			$posts = get_posts( array(
				'title' => $title,
				
			) );
			
			return count( $posts ) === 0?( 0 ):( $posts[0]->ID );
			
		}
		
	}

	