<?php
/**
 * The Template for building the search page.
 *
 */
get_header(); ?>
	<!-- <div id="primary" class="site-content"> -->
		<div id="content" role="main">
			<div class="padder">

			<h1 class="page-title">Searching for: <?php 
			$terms = (isset ($_GET['s'])) ? $_GET['s'] : '';
			echo $terms;
			?></h1>
			<div class="jump-menu">
				Jump to&emsp;
				<a href="#groups-results">Groups</a> 
				<a href="#article-results">News &amp; Features</a> 
				<a href="#activity-results">Activity Updates</a> 
				<a href="#members-results">Members</a> 
				<!-- <a href="#forum-results">Forum Topics</a>  -->
			</div>
			
			<?php do_action("advance-search");
			//the search action refers to functions both in the BP-Global-Unified-Search plugin and functions.php 
			?>
			</div><!-- .padder -->
		</div><!-- #content -->
	<!-- </div> --><!-- #primary -->

<?php //get_sidebar('search'); ?>
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery.localScroll();
});
</script>
<?php get_footer( 'buddypress' ); ?>
