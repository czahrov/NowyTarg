<?php
	$tags = getTagCloud();
	
?>
<div class="col-xl-3 section_title sidebar">
	<!-- najnowsze wideo -->
	<?php get_template_part( "template/segment-sidebar", "najnowsze_video" ); ?>
	<!-- filmy -->
	<?php get_template_part( "template/segment-sidebar", "video_promocyjne" ); ?>
	<!-- znaczniki -->
	<h1 class="clear">Znaczniki portalu</h1>
	<ul class="hash_tags">
		<?php foreach( $tags as $item ): ?>
		<li>
			<a href="<?php echo get_tag_link( $item->term_id ); ?>"><?php echo $item->name; ?></a>
		</li>
		<?php endforeach; ?>
	</ul>
	<!-- rozkład jazdy -->
	<h1 class="clear">Rozkład jazdy</h1>
	<div class="last_video_box clear">
		<a href="http://www.mzk.nowytarg.pl/site/rozkladjazdy" target="_blank">
			<img src="<?php echo get_template_directory_uri(); ?>/media/mzk.png">
		</a>
	</div>
</div>