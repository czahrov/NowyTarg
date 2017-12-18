<?php
	$comments = get_comments( array(
		'post_id' => get_post()->ID,
		'order' => 'ASC',
		'order_by' => 'date',
		
	) );
	
	if( empty( $comments ) ):
?>
<p class="comment-nr col-12">Jeszcze nikt nie komentował tego arytukłu.<br>Twój komentarz może być pierwszy!</p>
<?php else: ?>
<p class="comment-nr col-12"><span><?php echo get_comments_number( get_post()->ID ); ?></span> komentarzy</p>
<?php
	foreach( $comments as $item ):
	$class = $item->comment_parent == 0?( '' ):( ' answer ' );
?>
<div class="comment-aded<?php echo $class; ?>">
	<p class="comm-nick"><?php echo $item->comment_author; ?></p>
	<p class="comm-date"><?php echo get_comment_date( 'F d, Y, \o H:i:s', $item->comment_ID ); ?></p>
	<p class="comm-msg"><?php echo $item->comment_content; ?></p>
	<!--
	<button class="button-answer">Odpowiedz</button>
	-->
	<button class="button-answer">
		<?php
			// get_comment_reply_link( array $args = array(), int|WP_Comment $comment = null, int|WP_Post $post = null );
			comment_reply_link( array(
				'depth' => 1,
				'max_depth' => get_option( 'thread_comments_depth' ),
				
			), $item->comment_ID );
			
		?>
	</button>
</div>
<?php endforeach; ?>
<?php endif; ?>


<!--
<?php
	// print_r( $comments );
?>

-->