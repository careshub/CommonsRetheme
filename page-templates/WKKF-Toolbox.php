<?php
/**
 * Template Name: WKKF Toolbox
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	<style type="text/css">
				.tabs li {
					list-style:none;
					display:inline;
				}
				.tabs a {
					padding:5px 10px;
					display:inline-block;
					background:#999999;
					color:#fff;
					text-decoration:none;
				}
				.tabs a.active {
					background:#fff;
					color:#000;
				}
				.tabs a:hover {
					background:#fe9600;
				}
				.tabcontent {
					padding:10px;					
					background:#fff;					
				}	
				.site {
					background-color:#cccccc;
				}
				.wkkfleft {
					padding:12px 15px;
					background:#999999;
					display:block;
					text-decoration:none;
					color:#ffffff;
				}
				.wkkfleft:hover {
					background:#fe9600;
					color:#ffffff;
				}
				.wkkftitle {
					color:#999999;
					font-weight:bold;
					padding-bottom:30px;
					font-size:18pt;
				}
	</style>

	<div id="primary" class="site-content">
		<div id="content" role="main" style="width:1000px;">
			<div class="wkkftitle">
				WKKF Conversation Framework
			</div>
			<div style="width:150px;display: inline-block;margin-right:20px;">
				<div>
					<a href="#" class="wkkfleft">
						<div>
							Strategy Maps
						</div>
					</a>
					<a href="#" class="wkkfleft">
						<div>
							Goals & Indicators
						</div>
					</a>
					<a href="#" class="wkkfleft">
						<div>
							Budgets
						</div>
					</a>
					<a href="#" class="wkkfleft">
						<div>
							Grants
						</div>
					</a>
					<a href="#" class="wkkfleft">
						<div>
							Grantees
						</div>
					</a>					
				</div>
			</div>
			<div style="width:775px;display: inline-block;vertical-align:top;">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php //get_template_part( 'content', 'page-notitle' ); ?>				
					<?php endwhile; // end of the loop. ?>
			
				  <ul class='tabs'>
					<li><a href='#tab1'>Context</a></li>
					<li><a href='#tab2'>Status</a></li>
					<li><a href='#tab3'>Learnings</a></li>
					<li><a href='#tab4'>Issues</a></li>
					<li><a href='#tab5'>Next Steps</a></li>
				  </ul>
				  <div id='tab1' class="tabcontent">
					<p>Hi, this is the CONTEXT.</p>
				  </div>
				  <div id='tab2' class="tabcontent">
					<p>This is STATUS.</p>
				  </div>
				  <div id='tab3' class="tabcontent">
					<p>And this is LEARNINGS.</p>
				  </div>	
				  <div id='tab4' class="tabcontent">
					<p>And this is the ISSUES.</p>
				  </div>
				  <div id='tab5' class="tabcontent">
					<p>And this is the NEXT STEPS.</p>
				  </div>				  
				<script type="text/javascript">
					jQuery('ul.tabs').each(function(){
					  // For each set of tabs, we want to keep track of
					  // which tab is active and it's associated content
					  var $active, $content, $links = jQuery(this).find('a');

					  // If the location.hash matches one of the links, use that as the active tab.
					  // If no match is found, use the first link as the initial active tab.
					  $active = jQuery($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
					  $active.addClass('active');
					  $content = jQuery($active.attr('href'));

					  // Hide the remaining content
					  $links.not($active).each(function () {
						jQuery(jQuery(this).attr('href')).hide();
					  });

					  // Bind the click event handler
					  jQuery(this).on('click', 'a', function(e){
						// Make the old tab inactive.
						$active.removeClass('active');
						$content.hide();

						// Update the variables with the new link and content
						$active = jQuery(this);
						$content = jQuery(jQuery(this).attr('href'));

						// Make the tab active.
						$active.addClass('active');
						$content.show();

						// Prevent the anchor's default click action
						e.preventDefault();
					  });
					});

				
				</script>
			</div>
			<div style="text-align:right;padding-right:55px;"><img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/wkkf.png' ?>" /></div>  
			
			
			
			
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>