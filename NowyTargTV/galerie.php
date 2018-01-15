<?php
/*
	Template Name: Stare galerie
*/
get_header();
get_template_part( "template/part", "top" );

$relative_path = "/joomla_import/images";
chdir( __DIR__ . $relative_path );

$baseURL = getcwd();
// echo "baseURL: {$baseURL}<br>";
$baseURI = get_the_permalink();
// echo "baseURI: {$baseURI}<br>";

$subdir = empty( $_GET[ 'dir' ] )?( '/' ):( $_GET[ 'dir' ] );

$folders_pattern = "{$baseURL}{$subdir}*";
// echo "folders_pattern: " . $folders_pattern . "<br>";
$folders = glob( $folders_pattern, GLOB_ONLYDIR | GLOB_MARK );

$files_pattern = "{$baseURL}{$subdir}*.*";
// echo "files_pattern: " . $files_pattern . "<br>";
$files = glob( $files_pattern );


?>

<div id='old' class=''>
	<div class='container'>
		<div class='row'>
			<div class='location'>
				Aktualnie przeglądany katalog:
				<?php
					$segments = explode( "/", $subdir );
					$out = array(
						"<a href='{$baseURI}' class='item'>Katalog główny</a>"
					);
					$t = "";
					foreach( $segments as $item ){
						if( !empty( $item ) ){
							$t .= "/$item";
							$out[] = sprintf(
								"<a href='%s' class='item'>%s</a>",
								$baseURI . "?dir={$t}/",
								$item
								
							);
							
						}
						
					}
					
					echo implode( "", $out );
					
				?>
			</div>
			
		</div>
		<div class='row'>
			<div class='title cell col-4'>
				Podfoldery
			</div>
			<div class='title cell col-8'>
				Pliki
			</div>
			
		</div>
		<div class='row'>
			<div class='cell col-4'>
				<?php
					// print_r( $folders );
					foreach( $folders as $item ){
						$t = str_replace( "{$baseURL}", '', $item );
						
						printf(
							"<a href='%s%s'>%s</a>",
							get_the_permalink(),
							"?dir=$t",
							str_replace( $subdir, '', $t )
							
						);
						
					}
					
				?>
			</div>
			<div class='cell col-8'>
				<?php
					// print_r( $files );
					foreach( $files as $item ){
						$t = str_replace( "{$baseURL}", '', $item );
						
						printf(
							"<a href='%s' target='_blank'>%s</a>",
							get_template_directory_uri() . $relative_path . $t,
							str_replace( $subdir, '', $t )
							
						);
						
					}
					
				?>
				
			</div>
			
		</div>
		
	</div>
	
</div>

<?php
	get_template_part( "template/part", "bot" );
	get_footer();
?>