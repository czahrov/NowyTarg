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
	
	$pollution = array();
	foreach( $data[ 'air' ][ 'measure' ] as $item ){
		$value = null;
		foreach( $item[ 'values' ] as $sub ){
			
			$value = $sub[ 'value' ];
			if( $value !== null ){
				$pollution[ $item[ 'key' ] ] = array(
					// 2017-12-29 13:00:00
					'date' => date_create_from_format( "Y-m-d H:i:s", $sub[ 'date' ] ),
					'value' => $value,
					
				);
				
				break;
			}
			
		}
		
	}
	
?>
<div class='view air d-flex'>
	<div class='cell left d-flex flex-column'>
		<div class='title'>
			Powietrze, Nowy Targ
		</div>
		<div class='box d-flex align-items-center flex-grow justify-content-around'>
			<?php
				$note = strtolower( $data[ 'air' ][ 'airquality' ][ 'stIndexLevel' ][ 'indexLevelName' ] );
				
				
			?>
			<img class='icon' src='<?php printf( "%s/media/air/%s.png", get_template_directory_uri(), $note ); ?>'/>
			<div class='text col text-center'>
				<?php echo $data[ 'air' ][ 'airquality' ][ 'stIndexLevel' ][ 'indexLevelName' ]; ?>
			</div>
			
		</div>
		
	</div>
	<div class='cell right d-flex flex-column'>
		<div class='title'>
			<?php
				$text = array();
				
				foreach( $pollution as $code => $item ){
					$text[] = "{$code}: " . strftime( "%H:%M", $item[ 'date' ]->getTimestamp() );
					
				}
				
				echo implode( ", ", $text );
				
			?>
		</div>
		<div class='box d-flex flex-grow align-items-center justify-content-around'>
			<?php foreach( $pollution as $code => $item ): ?>
			<div class='param text-center d-flex flex-column'>
				<div class='name'>
					<?php echo $code; ?>
				</div>
				<div class='procent' title='<?php printf( "%s/%s[µg/m3]", $item[ 'value' ], $limit[ $code ] ); ?>'>
					<?php
						printf( "%.0f%%", $item[ 'value' ] / $limit[ $code ] * 100 );
					?>
				</div>
				
			</div>
			<?php endforeach; ?>
			
		</div>
		
	</div>
	
</div>