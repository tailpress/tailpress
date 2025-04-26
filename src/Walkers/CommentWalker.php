<?php

namespace TailPress\Walkers;

class CommentWalker extends \Walker_Comment
{
    protected function html5_comment($comment, $depth, $args)
    {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		$commenter          = wp_get_current_commenter();
		$show_pending_links = ! empty( $commenter['comment_author'] );

		if ( $commenter['comment_author_email'] ) {
			$moderation_note = __( 'Your comment is awaiting moderation.' );
		} else {
			$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.' );
		}
		?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body flex gap-8">

				<footer class="comment-meta flex">
                    <dd class="flex items-start gap-x-4">
                        <div class="flex-none overflow-hidden rounded-xl bg-neutral-100">
                            <?php
                                if ( 0 !== $args['avatar_size'] ) {
                                    echo get_avatar( $comment, 32, '', '', [
                                        'class' => 'h-12 w-12 object-cover grayscale hover:grayscale-0 transition',
                                        'style' => 'style="color: transparent;"'
                                    ]);
                                }
                            ?>
                        </div>
                    </dd>
                    <!-- .comment-author -->
				</footer><!-- .comment-meta -->

                <div class="w-full grow">
                    <div class="comment-metadata flex gap-4 items-center">
                        <div class="font-semibold">
                            <?php
                            $comment_author = get_comment_author_link( $comment );

                            if ( '0' === $comment->comment_approved && ! $show_pending_links ) {
                                $comment_author = get_comment_author( $comment );
                            }

                            echo $comment_author;
                            ?>
                        </div>

						<div class="text-zinc-500 text-sm flex gap-4">
                            <?php
                            printf(
                                '<a href="%s"><time datetime="%s">%s</time></a>',
                                esc_url( get_comment_link( $comment, $args ) ),
                                get_comment_time( 'c' ),
                                sprintf(
                                    /* translators: 1: Comment date, 2: Comment time. */
                                    __( '%1$s at %2$s' ),
                                    get_comment_date( '', $comment ),
                                    get_comment_time()
                                )
                            );
                            edit_comment_link( __( 'Edit' ), ' <span class="edit-link">', '</span>' );
                            ?>
                        </div>
					</div><!-- .comment-metadata -->

					<?php if ( '0' === $comment->comment_approved ) : ?>
					<em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
					<?php endif; ?>

                    <div class="comment-content my-6">
                        <?php comment_text(); ?>
                    </div><!-- .comment-content -->

                    <?php
                    if ( '1' === $comment->comment_approved || $show_pending_links ) {
                        comment_reply_link(
                            array_merge(
                                $args,
                                array(
                                    'add_below' => 'div-comment',
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<div class="reply">',
                                    'after'     => '</div>',
                                )
                            )
                        );
                    }
                    ?>
                </div>
			</article><!-- .comment-body -->
		<?php
	}
}
