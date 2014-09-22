	<?php
	/*
	*/
	?>
	<div id="subnav" class="item-list-tabs no-ajax">
		<ul class="nav-tabs"> 
		<?php ccgn_options_menu();?>
		</ul>
	</div>

	<?php
	if( ccgn_is_single_post() ) {
        // echo "is single post";
		$q=new WP_Query(ccgn_get_query());
			global $post;
			if ($q->have_posts() ) : ?>

			<?php do_action( 'bp_before_group_blog_post_content' ) ?>

			

			<?php 
			//bcg_loop_start();//please do not remove it
			while( $q->have_posts()):$q->the_post(); ?>
				<?php get_template_part( 'content', 'group_story' ); ?>
			<?php comments_template(); ?>
		<?php endwhile;?>
		<?php do_action( 'bp_after_group_blog_content' ) ;
		// bcg_loop_end();//please do not remove it
		?>

		<?php else: ?>

			<div id="message" class="info">
				<p><?php _e( 'That post does not appear to exist.', 'bcg' ); ?></p>
			</div>

		<?php endif;

      } else if( ccgn_is_post_edit() ) {

        // echo "is create";
		ccgn_get_post_form( bp_get_group_id() );

      } else { //Is the narrative list
        // echo "is list";
        // bp_get_template_part( 'ccgn/narrative-list.php' );
			?>
			<!-- This is the narrative list template, narrative list portion. -->
			<?php $q=new WP_Query( ccgn_get_query() );?>
			<?php
			// echo '<pre>';
			// var_dump($q);
			// echo'</pre>';
			?>
			<?php if ($q->have_posts() ) : ?>
			<?php do_action( 'bp_before_group_blog_content' ) ?>
			<div class="pagination no-ajax">
				<div id="posts-count" class="pag-count">
					<!-- TODO: pagination -->
					<?php //bcg_posts_pagination_count($q) ?>
				</div>

				<div id="posts-pagination" class="pagination-links">
					<!-- TODO: pagination -->
					<?php //bcg_pagination($q) ?>
				</div>

			</div>

			<?php do_action( 'bp_before_group_blog_list' ) ?>
		<?php
			global $post;
			// bcg_loop_start();//please do not remove it
			while($q->have_posts()):$q->the_post();
			// var_dump($post);
			?>

				<?php get_template_part( 'content', 'narrative' ); ?>

			<?php endwhile;?>
			<?php do_action( 'bp_after_group_blog_content' ) ;
			// bcg_loop_end();//please do not remove it
			?>

		<?php else: ?>

			<div id="message" class="info">
				<p><?php _e( 'No narratives have been published yet.', 'bcg' ); ?></p>
			</div>

		<?php endif;
	}// End is narrative list 
