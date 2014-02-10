<?php if ( post_password_required() ) return; ?>

			<div id="comments" class="comments-area">

<?php 			comment_form( array( 
					'comment_notes_before' => '',
					'comment_notes_after' => '',
					'fields' => array(
						'author' => '<p class="comment-form-author"><label for="author">Nome ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required' . $aria_req . ' /></p>',
						'email' => '<p class="comment-form-email"><label for="email">E-mail ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label><input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" required' . $aria_req . ' /></p>',
						'url' => '<p class="comment-form-url"><label for="url">Site</label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'
					),
					'comment_field' => '<p class="comment-form-comment"><label for="comment">Comentário</label><textarea id="comment" name="comment" cols="45" rows="8" required aria-required="true"></textarea></p>'
				) ); ?>

				<?php if ( have_comments() ) : ?>
					<ol class="commentlist">
						<?php wp_list_comments(); ?>
					</ol>
				<?php endif; ?>

			</div>