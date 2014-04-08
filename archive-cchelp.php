<?php
get_header(); 

//Which term is this page showing?
if ( isset( $wp_query->query_vars['term'] ) ) {
	$tax_term = get_term_by( 'slug', $wp_query->query_vars['term'], $wp_query->query_vars['taxonomy'] );
}

$gids = groups_get_user_groups( bp_loggedin_user_id() );
$gidarr = array_map( 'cchelp_get_group_tax_slug', $gids['groups'] );
$args = array(
		'post_type' => 'cchelp',
		'tax_query' => 
			array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'cc_help_groups',
				'field' => 'slug',
				'terms' => $gidarr					
			), 
			array(
				'taxonomy' => 'cc_help_groups',
				'field' => 'slug',
				'terms' => 'all'
			),
		)
		);
$group_posts = new WP_Query($args);

?>

	<section id="primary" class="site-content">
		<div id="content" role="main">
		<a href="/cchelp/" style="text-decoration:none;color:#000000;"><p style="font-weight:bold;font-size:21pt;">Support | Community Commons</p></a>
<?php
		if ( !empty( $tax_term ) && $tax_term->taxonomy == 'cchelp_personas' ) {
			$persona = $tax_term->name;
			$persona_slug = $tax_term->slug;
			$array = array(
				'Daniel' => array(
							'color' => '#008EAA',
							'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...',
							'image' => 'http://dev.communitycommons.org/wp-content/uploads/2014/04/male.jpg',
							),
				'Tonya' => array(
							'color' => '#df5827',
							'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...',
							'image' => 'http://dev.communitycommons.org/wp-content/uploads/2014/04/female.jpg',
							),
				'Sara' => array(
							'color' => '#f9b715',
							'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...',
							'image' => 'http://dev.communitycommons.org/wp-content/uploads/2014/04/female.jpg',
							),
				'Maria' => array(
							'color' => '#879c3c',
							'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...',
							'image' => 'http://dev.communitycommons.org/wp-content/uploads/2014/04/female.jpg',
							)
				);
			$typearray = array(
								'Getting Started' => 'getting-started',
								'Maps' => 'maps-2',
								'Reports' => 'reports',
								'Data' => 'data-2',
								'Groups' => 'groups-2',
								'Administrators' => 'administrators'
								);
						
				?>
				<div style="width:100%;height:100px;padding:10px;margin-bottom:25px;background-color:<?php echo $array[$persona]['color']; ?>">
					<table>
						<tr>
							<td>
								<img src="<?php echo $array[$persona]['image']; ?>" width="75px" />
							</td>
							<td>
								<h1><span style="color:#ffffff;font-weight:bold;font-size:21pt;"><?php echo $persona; ?></span></h1>
								<?php echo $array[$persona]['text']; ?>
							</td>
						</tr>
					</table>
				</div>
				<?php
					foreach ($typearray as $typekey => $typevalue) {
						$args = array( 
						'post_type' => 'cchelp',	
						'tax_query' => array(
								'relation' => 'AND',
								array(
									'taxonomy' => 'cchelp_personas',
									'field' => 'slug',
									'terms' => $persona_slug
								),
								array(
									'taxonomy' => 'cc_help_types',
									'field' => 'slug',
									'terms' => $typevalue
								)
							)
						);
						$loop = new WP_Query( $args );						

						if ($loop->have_posts()) {
							echo "<div id='" . $typevalue . "' style='background-color:#e0e0e0;padding:10px;margin-bottom:25px;width:100%;'>";
								echo "<p style='font-weight:bold;font-size:12pt;'>" . $typekey . "</p>";						
								while ( $loop->have_posts() ) : $loop->the_post();							
									echo '<div class="entry-content" style="margin-left:15px;">';
										the_content();
									echo '</div>';						
								endwhile;
							echo "</div>";
						}
					}	
		} 
		elseif (!empty( $tax_term ) && $tax_term->taxonomy == 'cc_help_types') 
		{
			echo $tax_term->name;
		
		} else {

			$COGIScount = 0;
			$PRIMEcount = 0;
			foreach ($group_posts->posts as $post) :
				$term_list = wp_get_post_terms( $post->ID, 'cc_help_groups');		
				foreach ($term_list as $term) {
					if($term->description == "PRIME")
					{			
						if($PRIMEcount < 1) {
							//echo "<h1>PRIME POSTS:</h1><br /><br />";
							$PRIMEcount = 1;
						}
						if($term->slug == "ccgroup-association-54" && $COGIScount < 1) {
							$COGIScount = 1;
						?>
							<div style="width:895px;height:285px;background-color:#ffffff;border:solid 1px #008eaa;padding:25px;">
								<div style="float:left;width:50%;height:100%;vertical-align:top;text-align:left;">
									<img src="http://dev.communitycommons.org/wp-content/uploads/2014/04/cogistitle.jpg" />
									<p style="margin-right:20px;font-size:11pt;">The Childhood Obesity GIS collaboration space on the Commons has a variety of tools and applications to turn complex data into maps and other easy-to-understand visualizations, revealing the relationships, patterns, and trends that help tell a story.</p><p style="margin-right:20px;font-size:11pt;">The four personas on the right represent different ways people use the Commons to make a positive change in their community. Click on the ones that resonates with you to learn more.</p>
								</div>
								<div style="float:right;width:50%;background-color:#888888;height:100%;" >
									<div style="height:50%;">
										<div id="divTonya" style="cursor:pointer;width:50%;height:100%;float:left;background-color:#df5827;" title="Go to Tonya's help page">
											<div style="padding:12px;">
												<table>
													<tr>
														<td>
															<img style="float:left;" src="http://dev.communitycommons.org/wp-content/uploads/2014/04/female.jpg" width="60px;" />
														</td>
														<td style="color:#ffffff;font-weight:bold;font-size:18pt;">
															Tonya
														</td>
													</tr>
													<tr>
														<td colspan="2">
															Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...
														</td>
													</tr>
												</table>											
											</div>
										</div>
										<div id="divSara" style="cursor:pointer;width:50%;height:100%;float:right;background-color:#f9b715;" title="Go to Sara's help page">
											<div style="padding:12px;">
												<table>
													<tr>
														<td style="color:#ffffff;font-weight:bold;font-size:18pt;">
															Sara
														</td>
														<td>
															<img style="float:right;" src="http://dev.communitycommons.org/wp-content/uploads/2014/04/female.jpg" width="60px;" />
														</td>
													</tr>
													<tr>
														<td colspan="2">
															Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...
														</td>
													</tr>
												</table>											
											</div>
										</div>								
									</div>
									<div style="height:50%;">
										<div id="divDaniel" style="cursor:pointer;width:50%;height:100%;float:left;background-color:#008eaa;" title="Go to Daniel's help page">
											<div style="padding:12px;">
												<table>
													<tr>
														<td>
															<img style="float:left;" src="http://dev.communitycommons.org/wp-content/uploads/2014/04/male.jpg" width="60px;" />
														</td>
														<td style="color:#ffffff;font-weight:bold;font-size:18pt;">
															Daniel
														</td>
													</tr>
													<tr>
														<td colspan="2">
															Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...
														</td>
													</tr>
												</table>											
											</div>
										</div>
										<div id="divMaria" style="cursor:pointer;width:50%;height:100%;float:right;background-color:#879c3c;" title="Go to Maria's help page">
											<div style="padding:12px;">
												<table>
													<tr>
														<td style="color:#ffffff;font-weight:bold;font-size:18pt;">
															Maria
														</td>
														<td>
															<img style="float:right;" src="http://dev.communitycommons.org/wp-content/uploads/2014/04/female.jpg" width="60px;" />
														</td>
													</tr>
													<tr>
														<td colspan="2">
															Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...
														</td>
													</tr>
												</table>											
											</div>
										</div>							
									</div>
								</div>
							</div>
							
							<script type="text/javascript">
							jQuery( document ).ready(function($) {
								$( "#divTonya" ).click(function() {
									window.location.href = '/cchelp/cchelp_personas/tonya-cogis-2/';
								});
								$( "#divSara" ).click(function() {
									window.location.href = '/cchelp/cchelp_personas/sara-cogis-2/';
								});
								$( "#divDaniel" ).click(function() {
									window.location.href = '/cchelp/cchelp_personas/daniel-cogis-2/';
								});
								$( "#divMaria" ).click(function() {
									window.location.href = '/cchelp/cchelp_personas/maria-cogis-2/';
								});						
							});
							</script>
					
						<?php
						} elseif($term->slug != "ccgroup-association-54") {
						?>
						
							 <h1><?php echo get_the_title($post->ID); ?></h1>
							 <div class='post-content'><?php echo $post->post_content; ?></div> 
						 <?php
						}
					}		
				}
			endforeach;
			wp_reset_postdata();		
			?>	
				
				
				
			<div>
				<br /><br />
				<h3>Search Support</h3>
				<form action="<?php the_permalink(); ?>" method="POST" name="cchelpsearch">			 
								<input type="text" id="cchelpterms" name="cchelpterms" style="width:350px;" placeholder="Enter keywords"/>			 
								<input type="hidden" name="cc_post_type" value="post" /> <!-- // hidden 'your_custom_post_type' value -->			 
								<input type="submit" alt="Search" value="Search" />			 
				</form>
			</div>
			<?php
			if (isset($_POST['cchelpterms'])) {
				$args2 = array( 
				'post_type' => 'cchelp', 
				'posts_per_page' => 10, 
				's' => $_POST['cchelpterms'] 
				);
				$loop2 = new WP_Query( $args2 );
				while ( $loop2->have_posts() ) : $loop2->the_post();
			?>
					<div class="entry-content">
					<header class="entry-header clear">
						<h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'CommonsRetheme' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
						
						<?php the_excerpt(); ?>
					</header>
					</div>
				
			<?php
				endwhile;
			}			
			?>	
				
			<br /><h1>Help Guides</h1><br />
			<div style="width:895px;">
				<div id="guideMaps" class="guidebook" style="background-color:#879c3c;cursor:pointer;" title="Go to the Map Guidebook">
					<span class="guidebook-text">Map Guidebook</span>
				</div>
				<div id="guideData" class="guidebook" style="background-color:#008eaa;cursor:pointer;" title="Go to the Data Guidebook">
					<span class="guidebook-text">Data Guidebook</span>
				</div>
				<div id="guideReports" class="guidebook" style="background-color:#f9b715;cursor:pointer;" title="Go to the Report Guidebook">
					<span class="guidebook-text">Report Guidebook</span>
				</div>	
			</div>
			
			<div style="width:895px;">
				<div id="guideGroups" class="guidebook" style="background-color:#df5827;cursor:pointer;" title="Go to the Group Guidebook">
					<span class="guidebook-text">Group Guidebook</span>
				</div>
				<div id="guideAdmin" class="guidebook" style="background-color:#879c3c;cursor:pointer;" title="Go to the Administrator Guidebook">
					<span class="guidebook-text">Administrator Guidebook</span>
				</div>

			</div>	
			<style type="text/css">
				.guidebook
				{
					width:225px;
					height:300px;			
					text-align:center;
					padding:10px;
					margin-right:35px;	
					margin-bottom:35px;	
					float:left;			
				}
				.guidebook-text
				{
					position:relative;
					top:113px;
					color:#ffffff;
					font-size:22pt;	
					line-height:30px;		
				}
			</style>

			<script type="text/javascript">
				jQuery( document ).ready(function($) {
					$( "#guideMaps" ).click(function() {
						window.location.href = '/cchelp/cc_help_types/maps-2';
					});
					$( "#guideData" ).click(function() {
						window.location.href = '/cchelp/cc_help_types/data-2';
					});
					$( "#guideReports" ).click(function() {
						window.location.href = '/cchelp/cc_help_types/reports';
					});
					$( "#guideGroups" ).click(function() {
						window.location.href = '/cchelp/cc_help_types/groups-2';
					});
					$( "#guideAdmin" ).click(function() {
						window.location.href = '/cchelp/cc_help_types/administrators';
					});			
				});
			</script>					
				
				
				
				
				
				
				
				
				
		<?php		
			//echo "<br /><h1>GENERIC POSTS:</h1><br />";	

			// if(have_posts()) : while(have_posts()) : the_post();
				// the_title();
				// echo '<div class="entry-content">';
				// the_content();
				// echo '</div>';
			// endwhile; endif;
		
		}
		?>
		</div><!-- #content -->
	</section><!-- #primary -->
	<?php 
		if ( !empty( $tax_term ) && $tax_term->taxonomy == 'cchelp_personas' ) {
	?>
		<section style="float:right;width:275px;margin-top:100px;">
	<?php
		foreach ($typearray as $typekey => $typevalue) {
						$args = array( 
						'post_type' => 'cchelp',	
						'tax_query' => array(
								'relation' => 'AND',
								array(
									'taxonomy' => 'cchelp_personas',
									'field' => 'slug',
									'terms' => $persona_slug
								),
								array(
									'taxonomy' => 'cc_help_types',
									'field' => 'slug',
									'terms' => $typevalue
								)
							)
						);
						$loop = new WP_Query( $args );						

						if ($loop->have_posts()) {							
							echo "<p><a href='#" . $typevalue . "'>" . $typekey . "</a></p><br />";		
						}			
		}
	?>
		</section>

	<?php 
		}
	get_footer(); 
	?>