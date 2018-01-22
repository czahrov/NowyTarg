<?php
	if( isMobile() ){
		$num = empty( getUstawienia()[ 'nowosci_mob_num' ] )?( 2 ):( (int)getUstawienia()[ 'nowosci_mob_num' ][0] );
		
	}
	else{
		$num = empty( getUstawienia()[ 'nowosci_num' ] )?( 2 ):( (int)getUstawienia()[ 'nowosci_num' ][0] );
		
	}
	
	$data = getLatestNews( array(
		'numberposts' => $num,
		'exclude' => array( get_post()->ID ),
		
	) );
	
?>
<div class="col-xl-12 section_title latest_news">
	<h1>Ostatnie nowości</h1>
	<div class="row clear">
		<?php foreach( $data as $item ): ?>
		<div class="col-md-6">
			<a class="link_post" href="<?php the_permalink( $item->ID ); ?>">
				<div class="post_aktualnosci" style='background-image:url(<?php echo getPostImg( $item->ID, 'full' ); ?>);'>
					<div class="news_date"><?php echo get_the_date( "Y-m-d H:i", $item->ID ); ?></div>
					<span>
						<?php
							$num = count( get_approved_comments( $item->ID ) );
							if( $num > 0 ) printf( "komentarzy: %u", $num );
						?>
					</span>
				</div>
				<span class="post_aktualnosci_tiitle">
					<?php echo $item->post_title; ?>
				</span>
				<p class="post_aktulanosci">
					<?php
						$text = "";
						$lead = get_post_meta( $item->ID, 'lead', true );
						if( !empty( $lead ) ){
							$text = $lead;
							
						}
						else{
							$text = $item->post_excerpt;
							
						}
						
						echo shortText( $text );
						
					?>
				</p>
			</a>
		</div>
		<?php endforeach; ?>
	</div>
</div>