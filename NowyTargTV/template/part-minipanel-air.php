<?php
	$data = array(
		'weather' => getForecast(),
		'air' => getAirCon(),
		
	);
	
	// źródło: http://powietrze.gios.gov.pl/pjp/content/annual_assessment_air_exposure_alarms_level
	$limit = array(
		'O3' => 180,
		'SO2' => 500,
		'NO2' => 400,
		'PM10' => 200,
		
	);
	
	echo "<!--";
	// print_r( $data );
	echo "-->";
	
?>
<div class='view air d-flex'>
	<div class='cell status col-4 d-flex flex-column'>
		<div class='title'>
			Dzisiaj:
		</div>
		<div class='box col d-flex align-items-center'>
			<?php
				$note = '';
				switch( strtolower( $data[ 'air' ][ 'airquality' ][ 'stIndexLevel' ][ 'indexLevelName' ] ) ){
					case "bardzo dobry":
					case "dobry":
						$note = "good";
						
					break;
					case "umiarkowany":
					case "dostateczny":
						$note = "average";
						
					break;
					case "zły":
					case "bardzo zły":
						$note = "bad";
						
					break;
					
				}
				
			?>
			<img class='icon' src='<?php printf( "%s/media/air/%s.png", get_template_directory_uri(), $note ); ?>' />
			<div class='text col text-center'>
				<?php echo $data[ 'air' ][ 'airquality' ][ 'stIndexLevel' ][ 'indexLevelName' ]; ?>
			</div>
			
		</div>
		
	</div>
	<div class='cell params col d-flex flex-column'>
		<div class='title'></div>
		<div class='box d-flex col-12 align-items-center justify-content-around'>
			<?php
				foreach( $data[ 'air' ][ 'measure' ] as $item ):
				$value = null;
				foreach( $item[ 'values' ] as $sub ){
					$value = $sub[ 'value' ];
					if( $value !== null ) break;
					
				}
				
			?>
			<div class='item text-center d-flex flex-column'>
				<div class='name'>
					<?php echo $item[ 'key' ]; ?>
				</div>
				<div class='procent'>
					<?php
						printf( "%.1f%%", $value / $limit[ $item[ 'key' ] ] * 100 );
					?>
				</div>
				
			</div>
			<?php endforeach; ?>
			
		</div>
		
	</div>
	
</div>