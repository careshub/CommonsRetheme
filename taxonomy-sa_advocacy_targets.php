<?php get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>

		<div id="content" role="main">
			<div class="padder">
				<div id="tabs">

					<?php if ( is_tax( 'sa_advocacy_targets', 'sa-active-spaces' ) ) 
							echo 'ths is active spaces'; 

					?>
					<div class="item-list-tabs">
						<ul class="nav-tabs">
							<li><a href="#policies">Policies</a></li>
							<li><a href="#resources">Resources</a></li>
						</ul>
					</div>
					<div id="policies">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', get_post_type() ); ?>
							<?php comments_template( '', true ); ?>
						<?php endwhile; // end of the loop. ?>
						<?php twentytwelve_content_nav( 'nav-below' ); ?>
					</div>
					<div id="resources">
						Resources.
					</div>
				</div>

		</div><!-- .padder -->
		</div><!-- #content -->
<script type="text/javascript">
jQuery(document).ready(function($) {

	$('ul.nav-tabs').each(function(){
	  // For each set of tabs, we want to keep track of
	  // which tab is active and its associated content
	  var $active, $content, $links = $(this).find('a');

	  // If the location.hash matches one of the links, use that as the active tab.
	  // If no match is found, use the first link as the initial active tab.
	  $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
	  $active.parents('li').addClass('current');
	  $content = $($active.attr('href'));

	  // Hide the remaining content
	  $links.not($active).each(function () {
	    $($(this).attr('href')).hide();
	  });

	  // Bind the click event handler
	  $(this).on('click', 'a', function(e){
	    // Make the old tab inactive.
	    $active.parents('li').removeClass('current');
	    $content.hide();

	    // Update the variables with the new link and content
	    $active = $(this);
	    $content = $($(this).attr('href'));

	    // Make the tab active.
	    $active.parents('li').addClass('current');
	    $content.show();

	    // Prevent the anchor's default click action
	    // e.preventDefault();
	  });
	});
});

</script>
<?php get_template_part('page-templates/wrapper-salud-bottom'); ?>
<?php get_footer(); ?>