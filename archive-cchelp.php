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
	<style type="text/css">
		.shadow:hover {
			-webkit-box-shadow: 0px 0px 18px 0px rgba(50, 50, 50, 0.79);
			-moz-box-shadow:    0px 0px 18px 0px rgba(50, 50, 50, 0.79);
			box-shadow:         0px 0px 18px 0px rgba(50, 50, 50, 0.79);
		}
	</style>
	<section id="primary" class="site-content">
		<div id="content" role="main">
		<a href="/cchelp/" style="text-decoration:none;color:#000000;"><p style="font-weight:bold;font-size:21pt;">Support | Community Commons</p></a>
<?php
		$topicarray = array(
						'Getting Started' => array(
												'slug' => 'getting-started',
												'color' => '#879c3c',
												'text' => 'Getting Started'
												),
						'Maps' => array(
										'slug' => 'maps-2',
										'color' => '#008eaa',
										'text' => 'Mapping'
										),
						'Reports' => array(
										'slug' => 'reports',
										'color' => '#f9b715',
										'text' => 'Reporting'
										),
						'Data' => array(
										'slug' => 'data-2',
										'color' => '#df5827',
										'text' => 'Commons Data and Uploading Local Data'
										),
						'Groups' => array(
										'slug' => 'groups-2',
										'color' => '#df5827',
										'text' => 'Using the Collaboration Spaces'
										),
						'Administrators' => array(
										'slug' => 'administrators',
										'color' => '#879c3c',
										'text' => 'Being an Administrator'
										)
						);
		$typearray = array(
						'FAQs' => 'faqs',
						'How-to Exercises' => 'how-to-exercises',
						'Videos' => 'videos',
						'Webinars' => 'webinars'
						);

		if ( !empty( $tax_term ) && $tax_term->taxonomy == 'cchelp_personas' ) {
			$persona = $tax_term->name;
			$persona_slug = $tax_term->slug;
			$array = array(
				'Daniel' => array(
							'color' => '#008EAA',
							'text' => 'Daniel is a researcher who often serves as evaluation support for community health initiatives. He is an invited or contracted team member of the community coalition who holds a commitment to letting the data inform the work.',
							'image' => 'http://www.communitycommons.org/wp-content/uploads/2014/04/Daniel_Avatar.jpg',
							'video' => '<iframe src="//player.vimeo.com/video/91453831?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'
							),
				'Tonya' => array(
							'color' => '#df5827',
							'text' => 'Tonya is a community organizer and advocate. She is a member of the healthy community coalition who has a deep understanding of the community’s history, desires and needs.',
							'image' => 'http://www.communitycommons.org/wp-content/uploads/2014/04/Tonya_Avatar.jpg',
							'video' => '<iframe src="//player.vimeo.com/video/91451815?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'
							),
				'Sara' => array(
							'color' => '#f9b715',
							'text' => 'Sara provides leadership for a local agency focused on serving a wide range of community needs. She often convenes local stakeholders to create conditions that help advance strategy implementation of local coalitions.',
							'image' => 'http://www.communitycommons.org/wp-content/uploads/2014/04/Sara_Avatar.jpg',
							'video' => '<iframe src="//player.vimeo.com/video/90975840" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'
							),
				'Maria' => array(
							'color' => '#879c3c',
							'text' => 'Maria works for a local agency focused on improving health outcomes across communities in need. She serves as co-chair of the healthy community coalition providing coordination support and community health strategy expertise.',
							'image' => 'http://www.communitycommons.org/wp-content/uploads/2014/04/Maria_Avatar.jpg',
							'video' => '<iframe src="//player.vimeo.com/video/91557344" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'
							)
				);

						
				?>
				<div style="width:100%;padding:10px;margin-bottom:25px;background-color:<?php echo $array[$persona]['color']; ?>">
					<table>
						<tr>
							<td>
								<img src="<?php echo $array[$persona]['image']; ?>" width="75px" />
							</td>
							<td>
								<h1><span style="color:#ffffff;font-weight:bold;font-size:21pt;"><?php echo $persona; ?></span></h1>
								<?php echo $array[$persona]['text']; ?>
								<br /><br />
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
								<?php echo $array[$persona]['video']; ?>
							</td>
						</tr>
					</table>
				</div>
				<?php
					foreach ($topicarray as $topickey => $topicvalue) {
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
											'taxonomy' => 'cc_help_topics',
											'field' => 'slug',
											'terms' => $topicvalue
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
							
									echo "<div id='" . $topicvalue . "-" . $typevalue . "' style='padding:10px;margin-bottom:25px;width:100%;'>";
										echo "<p style='font-weight:bold;font-size:15pt;border-bottom: solid 1px #000000;'>" . $topickey . " [" . $typekey . "]</p>";						
										while ( $loop->have_posts() ) : $loop->the_post();	
										
										if ($typevalue == "faqs") {
												echo "<p>";											
													echo "<a id='click-";
														the_ID();
														echo "' href='#' onclick='javascript:toggle(";
														the_ID();
														echo "); return false;' style='cursor:pointer;'>[+] ";
														the_title();
														echo "</a>";
												echo "</p>";
												echo "<div id='cchelp-";
													the_ID();
												echo "' class='entry-content' style='margin-left:15px;display:none;'>";
													the_content();
												echo '</div>';													
											} else {
												echo "<p style='font-weight:bold;'>";
													the_title(); 											
												echo "</p>";
												echo "<div id='cchelp-";
													the_ID();
												echo "' class='entry-content' style='margin-left:15px;'>";
													the_content();
												echo '</div>';
											}
										endwhile;
									echo "</div>";
									
							}
						}
					}	
		} 
		elseif (!empty( $tax_term ) && $tax_term->taxonomy == 'cc_help_topics') 
		{
			$topic = $tax_term->name;
			$topic_slug = $tax_term->slug;		
			?>
				<div style="width:100%;padding:10px;background-color:<?php echo $topicarray[$topic]['color']; ?>">
					<table>
						<tr>
							<td>
								<h1><span style="color:#ffffff;font-weight:bold;font-size:21pt;"><?php echo $topicarray[$topic]['text']; ?></span></h1>																
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
											'taxonomy' => 'cc_help_topics',
											'field' => 'slug',
											'terms' => $topicarray[$topic]['slug']
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
							
									echo "<div id='" . $topicvalue . "-" . $typevalue . "' style='padding:10px;margin-bottom:25px;width:100%;'>";
										echo "<p style='font-weight:bold;font-size:15pt;border-bottom: solid 1px #000000;'>" . $topickey . " [" . $typekey . "]</p>";						
										while ( $loop->have_posts() ) : $loop->the_post();	
										
										if ($typevalue == "faqs") {
												echo "<p>";											
													echo "<a id='click-";
														the_ID();
														echo "' href='#' onclick='javascript:toggle(";
														the_ID();
														echo "); return false;' style='cursor:pointer;'>[+] ";
														the_title();
														echo "</a>";
												echo "</p>";
												echo "<div id='cchelp-";
													the_ID();
												echo "' class='entry-content' style='margin-left:15px;display:none;'>";
													the_content();
												echo '</div>';													
											} else {
												echo "<p style='font-weight:bold;'>";
													the_title(); 											
												echo "</p>";
												echo "<div id='cchelp-";
													the_ID();
												echo "' class='entry-content' style='margin-left:15px;'>";
													the_content();
												echo '</div>';
											}
										endwhile;
									echo "</div>";
									
							}
						}
					
					
			
			cchelp_footer_buttons();
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
							<div style="width:895px;height:400px;background-color:#ffffff;border:solid 1px #008eaa;padding:25px;">
								<div style="float:left;width:50%;height:100%;vertical-align:top;text-align:left;font-size:13pt;">
									<img src="http://dev.communitycommons.org/wp-content/uploads/2014/04/cogistitle.jpg" /><br /><br />
									<p>The Childhood Obesity GIS collaboration space on the Commons has a variety of tools and applications to turn complex data into maps and other easy-to-understand visualizations, revealing the relationships, patterns, and trends that help tell a story.</p><p>The four personas on the right represent different ways people use the Commons to make a positive change in their community. Click on the ones that resonate with you to learn more.</p>
								</div>
								<div style="float:right;width:50%;background-color:#888888;height:100%;" >
									<div style="height:50%;">
										<div class="shadow" id="divTonya" style="cursor:pointer;width:50%;height:100%;float:left;background-color:#df5827;" title="Go to Tonya's help page">
											<div style="padding:12px;">
												<table>
													<tr>
														<td>
															<img style="float:left;" src="http://www.communitycommons.org/wp-content/uploads/2014/04/Tonya_Avatar.jpg" width="60px;" />
														</td>
														<td style="color:#ffffff;font-weight:bold;font-size:18pt;">
															Tonya
														</td>
													</tr>
													<tr>
														<td colspan="2" style="font-size:9pt;">
															Tonya is a community organizer and advocate. She is a member of the healthy community coalition who has a deep understanding of the community’s history, desires and needs. 
														</td>
													</tr>
												</table>											
											</div>
										</div>
										<div class="shadow" id="divSara" style="cursor:pointer;width:50%;height:100%;float:right;background-color:#f9b715;" title="Go to Sara's help page">
											<div style="padding:12px;">
												<table>
													<tr>
														<td style="color:#ffffff;font-weight:bold;font-size:18pt;">
															Sara
														</td>
														<td>
															<img style="float:right;" src="http://www.communitycommons.org/wp-content/uploads/2014/04/Sara_Avatar.jpg" width="60px;" />
														</td>
													</tr>
													<tr>
														<td colspan="2" style="font-size:9pt;">
															Sara provides leadership for a local agency focused on serving a wide range of community needs. She often convenes local stakeholders to create conditions that help advance strategy implementation of local coalitions. 
														</td>
													</tr>
												</table>											
											</div>
										</div>								
									</div>
									<div style="height:50%;">
										<div class="shadow" id="divDaniel" style="cursor:pointer;width:50%;height:100%;float:left;background-color:#008eaa;" title="Go to Daniel's help page">
											<div style="padding:12px;">
												<table>
													<tr>
														<td>
															<img style="float:left;" src="http://www.communitycommons.org/wp-content/uploads/2014/04/Daniel_Avatar.jpg" width="60px;" />
														</td>
														<td style="color:#ffffff;font-weight:bold;font-size:18pt;">
															Daniel
														</td>
													</tr>
													<tr>
														<td colspan="2" style="font-size:9pt;">
															Daniel is a researcher who often serves as evaluation support for community health initiatives. He is an invited or contracted team member of the community coalition who holds a commitment to letting the data inform the work.
														</td>
													</tr>
												</table>											
											</div>
										</div>
										<div class="shadow" id="divMaria" style="cursor:pointer;width:50%;height:100%;float:right;background-color:#879c3c;" title="Go to Maria's help page">
											<div style="padding:12px;">
												<table>
													<tr>
														<td style="color:#ffffff;font-weight:bold;font-size:18pt;">
															Maria
														</td>
														<td>
															<img style="float:right;" src="http://www.communitycommons.org/wp-content/uploads/2014/04/Maria_Avatar.jpg" width="60px;" />
														</td>
													</tr>
													<tr>
														<td colspan="2" style="font-size:9pt;">
															Maria works for a local agency focused on improving health outcomes across communities in need. She serves as co-chair of the healthy community coalition providing coordination support and community health strategy expertise. 
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

			cchelp_search();
			?>	
				
				
				
	
				
			<br /><h1>Check Out a Guidebook</h1><br />
			<div style="width:895px;">
				<div id="guideStart" class="guidebook" style="background-color:#879c3c;cursor:pointer;border:solid 2px #879c3c;" title="Go to the Getting Started Guidebook">
					<span class="guidebook-text">Getting Started</span>
				</div>
				<div id="guideMaps" class="guidebook" style="background-color:#008eaa;cursor:pointer;border:solid 2px #008eaa;" title="Go to the Mapping Guidebook">
					<span class="guidebook-text">Mapping</span>
				</div>
				<div id="guideReports" class="guidebook" style="background-color:#f9b715;cursor:pointer;border:solid 2px #f9b715;" title="Go to the Reporting Guidebook">
					<span class="guidebook-text">Reporting</span>
				</div>	
			</div>
			
			<div style="width:895px;">
				<div id="guideGroups" class="guidebook" style="background-color:#df5827;cursor:pointer;border:solid 2px #df5827;" title="Go to the Collaboration Guidebook">
					<span class="guidebook-text">Using the Collaboration Spaces</span>
				</div>
				<div id="guideAdmin" class="guidebook" style="background-color:#879c3c;cursor:pointer;border:solid 2px #879c3c;" title="Go to the Administrator Guidebook">
					<span class="guidebook-text">Being an Administrator</span>
				</div>
				<div id="guideData" class="guidebook" style="background-color:#df5827;cursor:pointer;border:solid 2px #df5827;" title="Go to the Data Guidebook">
					<span class="guidebook-text">Commons Data and Uploading Local Data</span>
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
				.guidebook:hover {
					-webkit-box-shadow: 0px 0px 18px 0px rgba(50, 50, 50, 0.79);
					-moz-box-shadow:    0px 0px 18px 0px rgba(50, 50, 50, 0.79);
					box-shadow:         0px 0px 18px 0px rgba(50, 50, 50, 0.79);
					font-weight:bold;
				}	
				
			</style>

			<script type="text/javascript">
				jQuery( document ).ready(function($) {
					$( "#guideStart" ).click(function() {
						window.location.href = '/cchelp/cc_help_topics/getting-started/';
					});
					$( "#guideMaps" ).click(function() {
						window.location.href = '/cchelp/cc_help_topics/maps-2/';
					});
					$( "#guideData" ).click(function() {
						window.location.href = '/cchelp/cc_help_topics/data-2/';
					});
					$( "#guideReports" ).click(function() {
						window.location.href = '/cchelp/cc_help_topics/reports/';
					});
					$( "#guideGroups" ).click(function() {
						window.location.href = '/cchelp/cc_help_topics/groups-2/';
					});
					$( "#guideAdmin" ).click(function() {
						window.location.href = '/cchelp/cc_help_topics/administrators/';
					});			
				});
			</script>					

		<?php	
			cchelp_footer_buttons();		
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
					foreach ($topicarray as $topickey => $topicvalue) {
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
											'taxonomy' => 'cc_help_topics',
											'field' => 'slug',
											'terms' => $topicvalue
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
							echo "<p><a href='#" . $topicvalue . "-" . $typevalue . "'>" . $topickey . " [" . $typekey . "]</a></p><br />";		
						}	
				}
		}
	?>
		</section>

	<?php 
		}
		
		
		
?>		
			<script type="text/javascript"> 
			function toggle(postid) {
				//alert(postid);
				var ele = document.getElementById("cchelp-" + postid);
				var text = document.getElementById("click-" + postid);
				if(ele.style.display == "block") {
						ele.style.display = "none";
						var currtext = text.innerHTML;
						var clickstr = currtext.replace("[-] ","[+] ");
						text.innerHTML = clickstr;
						//text.innerHTML = "show";
				}
				else {
						ele.style.display = "block";
						var currtext = text.innerHTML;
						var clickstr = currtext.replace("[+] ","[-] ");
						text.innerHTML = clickstr;					
						//text.innerHTML = "hide";
				}
				
			} 		
			</script>		


<?php	
	get_footer(); 

function cchelp_search() {
?>
			<div>
				<br /><br />
				<h3>Search Support</h3>
				<form action="" method="POST" name="cchelpsearch">			 
								<input type="text" id="cchelpterms" name="cchelpterms" style="width:350px;" placeholder="Enter keywords"/>			 
								<input type="hidden" name="cc_post_type" value="post" /> <!-- // hidden 'your_custom_post_type' value -->			 
								<input type="submit" alt="Search" value="Search" />			 
				</form>
			</div>
			<?php
			if (isset($_POST['cchelpterms'])) {
				$args2 = array( 
				'post_type' => 'cchelp', 				
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
}	
	
function cchelp_footer_buttons() {
?>	
			<div style="width:895px;">
				<div id="guideTraining" class="guidebook2" title="Training">
					<span class="guidebook2-text">View a recorded training webinar, sign up for our next one<br />-OR-<br />Contact us for customized training solutions</span>
				</div>
				<div id="guideContact" class="guidebook2" title="Contact Us">
					<span class="guidebook2-text"><strong>Still stuck?</strong><br /><br />Contact us here</span>
				</div>
				<div id="guideInspiration" class="guidebook2" title="Inspiration">
					<span class="guidebook2-text">Need some inspiration?<br />How to use the Commons to create real change in your community</span>
				</div>
			</div>	
	<style type="text/css">
				.guidebook2
				{
					width:225px;
					height:300px;			
					text-align:center;
					padding:10px;
					margin-right:35px;	
					margin-bottom:35px;	
					background-color:#ffffff;
					cursor:pointer;
					border:solid 2px #008eaa;
					float:left;			
				}
				.guidebook2-text
				{
					position:relative;
					top:50px;
					color:#008eaa;
					font-size:16pt;	
					line-height:30px;		
				}		
				.guidebook2:hover {
					-webkit-box-shadow: 0px 0px 18px 0px rgba(50, 50, 50, 0.79);
					-moz-box-shadow:    0px 0px 18px 0px rgba(50, 50, 50, 0.79);
					box-shadow:         0px 0px 18px 0px rgba(50, 50, 50, 0.79);
				}	
	</style>
	<script type="text/javascript">
				jQuery( document ).ready(function($) {
					$( "#guideTraining" ).click(function() {
						window.location.href = '/cchelp/cc_help_topics/getting-started/';
					});
					$( "#guideContact" ).click(function() {
						window.location.href = '/cchelp/cc_help_topics/maps-2/';
					});
					$( "#guideInspiration" ).click(function() {
						window.location.href = '/cchelp/cc_help_topics/data-2/';
					});		
				});		
	</script>
<?php
}
	?>