<?php
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
	
	$data = array(
		'USD' => getTrade( 'USD' ),
		'EUR' => getTrade( 'EUR' ),
		
	);
	
	echo "<!--";
	// print_r( $data );
	echo "-->";
	
?>
<div class='view currency d-flex flex-wrap'>
	<div class='data col-12'>
		Danie z dnia <?php echo $data[ 'USD' ][ 'rates' ][0][ 'effectiveDate' ]; ?>
	</div>
	<?php foreach( $data as $code => $item ): ?>
	<div class='cell col d-flex flex-wrap align-items-center'>
		<img class='icon' src='<?php printf( "%s/media/flag/%s.png", get_template_directory_uri(), $code ); ?>' />
		<div class='code'>
			<?php echo $code; ?>
			
		</div>
		<div class='trade buy'>
			<?php printf( "Kupno: %.2f zł", $item[ 'rates' ][0][ 'bid' ] ); ?>
			
		</div>
		<div class='trade sell'>
			<?php printf( "Sprzedaż: %.2f zł", $item[ 'rates' ][0][ 'ask' ] ); ?>
			
		</div>
		
	</div>
	<?php endforeach; ?>
	
</div>