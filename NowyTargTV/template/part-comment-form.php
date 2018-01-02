<div class='col-12'>
	<?php
		// comment_form( array $args = array(), int|WP_Post $post_id = null );
		comment_form( array(
			'fields' => array(
				/* 'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
							'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>', */
				'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" placeholder="podpis" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>',
				/* 'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
							'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>', */
				/* 'email'  => '<p class="comment-form-email"><input id="email" name="email" placeholder="adres email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>', */
				'email' => '',
				/* 'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
							'<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>', */
				'url' => '',
				
			),
			'class_submit' => 'send-comment',
			'label_submit' => 'Dodaj komentarz',
			'title_reply' => 'Napisz komentarz',
			'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h3><div><u>Komentarze muszą najpierw zostać zaakceptowane przez administratora</u></div>',
			'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required" placeholder="Twój komentarz"></textarea></p>',
			
		) );
		
	?>
</div>