<?php
	$data = array(
		'weather' => getForecast(),
		'air' => getAirCon(),
		
	);
	
	echo "<!--";
	// print_r( $data );
	echo "-->";
	
	/*	
Array
(
    [weather] => Array
        (
            [current] => Array
                (
                    [coord] => Array
                        (
                            [lon] => 20.03
                            [lat] => 49.48
                        )

                    [weather] => Array
                        (
                            [0] => Array
                                (
                                    [id] => 500
                                    [main] => Rain
                                    [description] => słabe opady deszczu
                                    [icon] => 10n
                                )

                        )

                    [base] => stations
                    [main] => Array
                        (
                            [temp] => 2.58
                            [pressure] => 994
                            [humidity] => 100
                            [temp_min] => 1
                            [temp_max] => 4
                        )

                    [visibility] => 10000
                    [wind] => Array
                        (
                            [speed] => 2.1
                            [deg] => 330
                        )

                    [clouds] => Array
                        (
                            [all] => 90
                        )

                    [dt] => 1514489400
                    [sys] => Array
                        (
                            [type] => 1
                            [id] => 5906
                            [message] => 0.2872
                            [country] => PL
                            [sunrise] => 1514442955
                            [sunset] => 1514472479
                        )

                    [id] => 763523
                    [name] => Nowy Targ
                    [cod] => 200
                )

            [forecast] => Array
                (
                    [0] => Array
                        (
                            [dt] => 1514548800
                            [main] => Array
                                (
                                    [temp] => -3.6
                                    [temp_min] => -3.6
                                    [temp_max] => -3.6
                                    [pressure] => 903.59
                                    [sea_level] => 1021.22
                                    [grnd_level] => 903.59
                                    [humidity] => 92
                                    [temp_kf] => 0
                                )

                            [weather] => Array
                                (
                                    [0] => Array
                                        (
                                            [id] => 600
                                            [main] => Snow
                                            [description] => słabe opady śniegu
                                            [icon] => 13d
                                        )

                                )

                            [clouds] => Array
                                (
                                    [all] => 80
                                )

                            [wind] => Array
                                (
                                    [speed] => 1.33
                                    [deg] => 323.5
                                )

                            [rain] => Array
                                (
                                )

                            [snow] => Array
                                (
                                    [3h] => 0.4575
                                )

                            [sys] => Array
                                (
                                    [pod] => d
                                )

                            [dt_txt] => 2017-12-29 12:00:00
                        )
                    
					...
					
                )

        )

    [air] => Array
        (
            [sensors] => Array
                (
                    [0] => Array
                        (
                            [id] => 16905
                            [stationId] => 10254
                            [param] => Array
                                (
                                    [paramName] => pył zawieszony PM10
                                    [paramFormula] => PM10
                                    [paramCode] => PM10
                                    [idParam] => 3
                                )

                            [sensorDateStart] => 2016-03-21 00:00:00
                            [sensorDateEnd] => 
                        )

                    [1] => Array
                        (
                            [id] => 16904
                            [stationId] => 10254
                            [param] => Array
                                (
                                    [paramName] => dwutlenek siarki
                                    [paramFormula] => SO2
                                    [paramCode] => SO2
                                    [idParam] => 1
                                )

                            [sensorDateStart] => 2016-03-21 00:00:00
                            [sensorDateEnd] => 
                        )

                )

            [measure] => Array
                (
                    [0] => Array
                        (
                            [key] => PM10
                            [values] => Array
                                (
                                    [0] => Array
                                        (
                                            [date] => 2017-12-28 21:00:00
                                            [value] => 
                                        )

                                    [1] => Array
                                        (
                                            [date] => 2017-12-28 20:00:00
                                            [value] => 
                                        )

                                    [2] => Array
                                        (
                                            [date] => 2017-12-28 19:00:00
                                            [value] => 175.63
                                        )
                                    
									...
									
                                )

                        )

                    [1] => Array
                        (
                            [key] => SO2
                            [values] => Array
                                (
                                    [0] => Array
                                        (
                                            [date] => 2017-12-28 21:00:00
                                            [value] => 
                                        )

                                    [1] => Array
                                        (
                                            [date] => 2017-12-28 20:00:00
                                            [value] => 46.581
                                        )

                                    [2] => Array
                                        (
                                            [date] => 2017-12-28 19:00:00
                                            [value] => 44.9754
                                        )

                                    ...

                                )

                        )

                )

            [airquality] => Array
                (
                    [id] => 10254
                    [stCalcDate] => 2017-12-28 20:20:32
                    [stIndexLevel] => Array
                        (
                            [id] => 4
                            [indexLevelName] => Zły
                        )

                    [stSourceDataDate] => 2017-12-28 19:00:00
                    [so2CalcDate] => 2017-12-28 20:20:32
                    [so2IndexLevel] => Array
                        (
                            [id] => 0
                            [indexLevelName] => Bardzo dobry
                        )

                    [so2SourceDataDate] => 2017-12-28 20:00:00
                    [no2CalcDate] => 
                    [no2IndexLevel] => 
                    [no2SourceDataDate] => 
                    [coCalcDate] => 
                    [coIndexLevel] => 
                    [coSourceDataDate] => 
                    [pm10CalcDate] => 2017-12-28 20:20:32
                    [pm10IndexLevel] => Array
                        (
                            [id] => 4
                            [indexLevelName] => Zły
                        )

                    [pm10SourceDataDate] => 2017-12-28 19:00:00
                    [pm25CalcDate] => 
                    [pm25IndexLevel] => 
                    [pm25SourceDataDate] => 
                    [o3CalcDate] => 
                    [o3IndexLevel] => 
                    [o3SourceDataDate] => 
                    [c6h6CalcDate] => 
                    [c6h6IndexLevel] => 
                    [c6h6SourceDataDate] => 
                )

        )

)
	*/
	
?>
<div class='view weather open d-flex flex-wrap'>
	<div class='cell left d-flex flex-column'>
		<div class='title'>
			<?php
				// echo strftime( "%d %B", (int)$data[ 'weather' ][ 'current' ][ 'dt' ] ) . "<br>Nowy Targ" ;
				echo date_i18n( "d F", (int)$data[ 'weather' ][ 'current' ][ 'dt' ] ) . "<br>Nowy Targ" ;
			?>
		</div>
		<div class='box d-flex align-items-center flex-grow justify-content-around'>
			<div class='text'>
				<?php printf( "%.0f&#8451", $data[ 'weather' ][ 'current' ][ 'main' ][ 'temp' ] ); ?>
			</div>
			<img class='icon' src='<?php printf( "%s/media/weather/%s.png", get_template_directory_uri(), $data[ 'weather' ][ 'current' ][ 'weather' ][0][ 'icon' ] ); ?>' title='<?php echo $data[ 'weather' ][ 'current' ][ 'weather' ][0][ 'description' ]; ?>' />
		
		</div>
		
	</div>
	<div class='cell right d-flex flex-column'>
		<div class='title'>
			<?php
				// 2017-12-29 13:21:02
				$dt = date_create_from_format( "Y-m-d H:i:s", $data[ 'air' ][ 'airquality' ][ 'stCalcDate' ] );
				
				// printf( "%s<br>Nowy Targ", strftime( "%A %H:%M:%S", $dt->getTimestamp() ) );
				printf( "%s<br>Nowy Targ", date_i18n( "l H:i:s", $dt->getTimestamp() ) );
				
			?>
		</div>
		<div class='box d-flex align-items-center flex-grow justify-content-around'>
			<?php
				$note = strtolower( $data[ 'air' ][ 'airquality' ][ 'stIndexLevel' ][ 'indexLevelName' ] );
				
			?>
			<img class='icon' src='<?php printf( "%s/media/air/%s.png", get_template_directory_uri(), $note );
			?>' />
			<div class='text'>
				<?php echo $data[ 'air' ][ 'airquality' ][ 'stIndexLevel' ][ 'indexLevelName' ]; ?>
			</div>
		
		</div>
		
	</div>
	<div class='more text-center col-12' onclick='void(0);'>
		więcej &#9660;
		<div class='sub d-flex flex-column'>
			<?php foreach( $data[ 'weather' ][ 'forecast' ] as $item ): ?>
			<div class='cell cell weather d-flex align-items-center justify-content-around'>
				<div class='title text-left'>
					<?php
						// echo strftime( "%d.%m, %A", (int)$item[ 'dt' ] );
						echo date_i18n( "d.m, l", (int)$item[ 'dt' ] );
					?>
				</div>
				<div class='box d-flex align-items-center justify-content-between'>
					<div class='text'>
						<?php printf( "%.0f&#8451", $item[ 'main' ][ 'temp' ] ); ?>
					</div>
					<img class='icon' src='<?php printf( "%s/media/weather/%s.png", get_template_directory_uri(), $item[ 'weather' ][0][ 'icon' ] ); ?>' title='<?php echo $item[ 'weather' ][0][ 'description' ]; ?>'/>
				
				</div>
				
			</div>
			<?php endforeach; ?>
			
		</div>
		
	</div>
	
</div>