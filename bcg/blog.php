	<?php
	/*
	This page is used for group blog home page/categories archives*/
	?>
	<?php $q=new WP_Query(bcg_get_query());?>
	<?php if ($q->have_posts() ) : ?>
	<?php do_action( 'bp_before_group_blog_content' ) ?>
	<div class="pagination no-ajax">
		<div id="posts-count" class="pag-count">
			<?php bcg_posts_pagination_count($q) ?>
		</div>

		<div id="posts-pagination" class="pagination-links">
			<?php bcg_pagination($q) ?>
		</div>

	</div>

	<?php do_action( 'bp_before_group_blog_list' ) ?>
<?php
	global $post;
	bcg_loop_start();//please do not remove it
	while($q->have_posts()):$q->the_post();?>
	<!-- <div class="post" id="post-<?php the_ID(); ?>">

						<div class="author-box">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), '50' ); ?>
							<p><?php printf( __( 'by %s', 'bcg' ), bp_core_get_userlink( $post->post_author ) ) ?></p>
						</div>

						<div class="post-content">
							<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'bcg' ) ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

							<p class="date"><?php the_time() ?> <em><?php _e( 'in', 'bcg' ) ?> <?php the_category(', ') ?> <?php printf( __( 'by %s', 'bcg' ), bp_core_get_userlink( $post->post_author ) ) ?></em></p>

							<div class="entry">
								<?php the_excerpt( ); ?>
							</div>

							<p class="postmetadata"><span class="tags"><?php the_tags( __( 'Tags: ', 'bcg' ), ', ', '<br />'); ?></span> <span class="comments"><?php comments_popup_link( __( 'No Comments &#187;', 'bcg' ), __( '1 Comment &#187;', 'bcg' ), __( '% Comments &#187;', 'bcg' ) ); ?></span></p>
						</div>

					</div> -->
	<?php get_template_part( 'content' ); ?>

	<?php endwhile;?>
	<?php do_action( 'bp_after_group_blog_content' ) ;
	bcg_loop_end();//please do not remove it
	?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'This group has no Blog posts.', 'bcg' ); ?></p>
	</div>

<?php endif; ?>
