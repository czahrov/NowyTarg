<?php
	$data = getAktualnosci( array(
		'numberposts' => 9,
		
	) );
	
?>
<div class="row section_title aktualnosci">
	<div class="col-md-12">
		<a href='<?php echo get_category_link( getCatByName( 'Aktualności' ) ); ?>'>
			<h1>Aktualności</h1>
		</a>
	</div>
	<div class="col clear-mobile">
		<div class='row no-gutters'>
			<?php
				foreach( $data as $num => $item ):
				if( $num === 0 ):
			?>
			<a class="link_post big col-12" href="<?php the_permalink( $item->ID ); ?>">
				<div class="post_news_big" style='background-image: url(<?php echo getPostImg( $item->ID, 'full' ); ?>);'>
					<?php echo genPostIcon( $item->ID ); ?>
					<img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/media/cover_img.png">
					<span><?php echo $item->post_title; ?></span>
				</div>
			</a>
			<?php else: ?>
			<a class="link_post col-6" href="<?php the_permalink( $item->ID ); ?>">
				<div class="post_news_small col-12" style='background-image: url(<?php echo getPostImg( $item->ID, 'large' ); ?>);'>
					<?php echo genPostIcon( $item->ID ); ?>
				</div>
				<span class="post_news_small_tiitle d-block col-12"><?php echo $item->post_title; ?></span>
			</a>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="col-md-12">
				<a class="load_more" item-segment='aktualnosci' item-cat='<?php echo getCatByName( 'Aktualności' ); ?>'>
					ZAŁADUJ WIĘCEJ
				</a>
				
			</div>
			
		</div>
		
	</div>
	
</div>
