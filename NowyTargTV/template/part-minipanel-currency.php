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
	
	$data = getTrade( array( 'USD', 'EUR' ) );
	
	echo "<!--";
	// print_r( $data );
	echo "-->";
	
?>
<div class='view currency d-flex flex-wrap'>
	<?php foreach( $data as $code => $item ): ?>
	<div class='cell d-flex flex-column'>
		<div class='title'>
			Dane z dnia <?php echo $item[ 'rates' ][0][ 'effectiveDate' ]; ?>
		</div>
		<div class='box d-flex align-items-center flex-grow justify-content-around flex-wrap'>
			<img class='icon' src='<?php printf( "%s/media/flag/%s.png", get_template_directory_uri(), $code ); ?>' />
			<div class='text'>
				<?php echo $code; ?>
			</div>
		
		</div>
		<div class='box d-flex flex-column'>
			<div class='trade buy'>
				<?php printf( "Kupno: %.2f zł", $item[ 'rates' ][0][ 'bid' ] ); ?>
				
			</div>
			<div class='trade sell'>
				<?php printf( "Sprzedaż: %.2f zł", $item[ 'rates' ][0][ 'ask' ] ); ?>
				
			</div>
		
		</div>
		
	</div>
	
	<?php endforeach; ?>
	
</div>