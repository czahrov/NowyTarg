<?php
	$data = getLatestNews( array(
		'numberposts' => 2,
		'exclude' => array( get_post()->ID ),
		
	) );
	
?>
<div class="col-xl-12 section_title latest_news">
	<h1>Ostatnie nowości</h1>
	<div class="row clear">
		<?php foreach( $data as $item ): ?>
		<div class="col-md-6 load_more">
			<a class="link_post" href="<?php the_permalink( $item->ID ); ?>">
				<div class="post_aktualnosci" style='background-image:url(<?php echo getPostImg( $item->ID ); ?>);'>
					<div class="news_date"><?php echo get_the_date( "Y-m-d", $item->ID ); ?></div>
					<span><?php echo get_comment_count( $item->ID )['approved']; ?> komentarzy</span>
				</div>
				<span class="post_aktualnosci_tiitle">
					<?php echo $item->post_title; ?>
				</span>
				<p class="post_aktulanosci">
					<?php echo shortText( $item->post_excerpt ); ?>
				</p>
			</a>
		</div>
		<?php endforeach; ?>
	</div>
</div>