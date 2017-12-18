<?php

/* Klasa importująca wpisy z JSONa */
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
				$this->_fpath = $fpath;
				$this->_loadData();
				// $this->_iterateItems();
				
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
						// <img src="images/galerie/2017/2017.11.06.abw/P2890524.JPG" alt="" />
						/* $pattern = '~(<img src=")(.+?)(".+?>)~'; */
						$pattern = '~(images/[^"]+)~';
						/* $replace = "${1}" . get_home_url( 'wp-content/themes/NowyTargTV/joomla_import/images' ) . "/${2}${3}"; */
						$replace = home_url( 'wp-content/themes/NowyTargTV/joomla_import' ) . "/$0";
						$content = preg_replace( $pattern, $replace, $element['data'][0]['value'] );
						
					break;
					case "Media":
					case "Media2":
						if( !empty( $element['data']['url'] ) ){
							$youtube[] = $element['data']['url'];
							
						}
						
					break;
					case "Galeria zdjęć":
						if( !empty( $element['data']['value'] ) ){
							$gallery_name = "images/galerie/" . $element['data']['value'];
							
						}
						
					break;
					
				}
				
			}
			
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
			
			$NID = wp_insert_post( $t );
			
			if( !empty( $gallery_name ) ){
				set_post_format( $NID, 'gallery' );
				
			}
			elseif( count( $youtube ) > 0 ){
				set_post_format( $NID, 'video' );
				
			}
			
		}
		
		// funkcja przechodząca po wszystkich importowanych elementach
		private function _iterateItems( $offset = 0, $length = null ){
			
			$part = array_slice( $this->_data['items'], $offset, $length );
			if( !empty( $part ) ){
				foreach( $part as $item ){
					$this->_importItem( $item );
					
				}
				
				return true;
				
			}
			else{
				return false;
				
			}
			
		}
		
		// funkcja sprawdzająca czy dany post już istnieje, zwraca numer ID
		private function _checkPost( $title ){
			$posts = get_posts( array(
				'title' => $title,
				
			) );
			
			return count( $posts ) === 0?( 0 ):( $posts[0]->ID );
			
		}
		
		// Zewnętrzny dostęp do funkcji ładującej wpisy
		public function loadItems( $offset = 0, $length = null ){
			return $this->_iterateItems( $offset, $length );
			
		}
		
	}

