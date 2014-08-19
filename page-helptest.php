<?php
ini_set('max_execution_time', 53000); 

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php 
                        
                        //mb_group_dependent_help();         
                        //cchelp_add_initial_groups();
						cchelp_getuser_group_ids();
						cchelp_guides();
                        
                        while ( have_posts() ) : the_post(); ?>
				<?php 
                             
                                
                                //get_template_part( 'content', 'page' ); ?>
				
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); 

function mb_group_dependent_help() {
	
	$userid = bp_loggedin_user_id();
	$gids = groups_get_user_groups($userid);

	foreach ($gids['groups'] as $groupid) {
		
		if ($groupid=='1') {
			echo "This is group 1.<br />";
		}
		else if ($groupid=='4') {
			echo "This is group 4.<br />";
		} 
		else if ($groupid=='5') {
			echo "This is group 5.<br />";
		}
	}

	echo "<br /><br /><br /><br /><br />";
}

function cchelp_add_initial_groups()
{	
	if (bp_has_groups()) {		
			while ( bp_groups() ) : bp_the_group(); 	
				wp_insert_term( bp_get_group_name(), 'cc_help_groups', array('slug' => 'ccgroup-association-' . bp_get_group_id()) );		
			endwhile; 
    }  
}

function cchelp_getuser_group_ids() {

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
	cchelp_prime_query($group_posts);
	
}





function cchelp_prime_query($group_posts) {
	
	$COGIScount = 0;
	$PRIMEcount = 0;
	foreach ($group_posts->posts as $post) :
		$term_list = wp_get_post_terms( $post->ID, 'cc_help_groups');		
		foreach ($term_list as $term) {
			if($term->description == "PRIME")
			{			
				if($PRIMEcount < 1) {
					echo "<h1>PRIME POSTS:</h1><br /><br />";
					$PRIMEcount = 1;
				}
				if($term->name == "COGIS" && $COGIScount < 1) {
					$COGIScount = 1;
				?>
					<div style="width:895px;height:285px;background-color:#dcdcdc;padding:25px;">
						<div style="float:left;width:65%;height:100%;vertical-align:middle;text-align:center;font-size:50pt;position:relative;top:71px;">
							COGIS<br />Help Section
						</div>
						<div style="float:right;width:35%;background-color:#888888;height:100%;" >
							<div style="height:50%;">
								<div id="divTonya" style="cursor:pointer;width:50%;height:100%;float:left;background-color:#df5827;color:#ffffff;text-align:center;font-size:30pt;" title="Go to Tonya's help page">
									<span style="position:relative;top:45px;">Tonya</span>
								</div>
								<div id="divSara" style="cursor:pointer;width:50%;height:100%;float:right;background-color:#f9b715;color:#ffffff;text-align:center;font-size:30pt;" title="Go to Sara's help page">
									<span style="position:relative;top:45px;">Sara</span>
								</div>								
							</div>
							<div style="height:50%;">
								<div id="divDaniel" style="cursor:pointer;width:50%;height:100%;float:left;background-color:#008eaa;color:#ffffff;text-align:center;font-size:30pt;" title="Go to Daniel's help page">
									<span style="position:relative;top:45px;">Daniel</span>
								</div>
								<div id="divMaria" style="cursor:pointer;width:50%;height:100%;float:right;background-color:#879c3c;color:#ffffff;text-align:center;font-size:30pt;" title="Go to Maria's help page">
									<span style="position:relative;top:45px;">Maria</span>
								</div>							
							</div>
						</div>
					</div>
					
					<script type="text/javascript">
					jQuery( document ).ready(function($) {
						$( "#divTonya" ).click(function() {
							window.location.href = 'Persona/?id=Tonya';
						});
						$( "#divSara" ).click(function() {
							window.location.href = 'Persona/?id=Sara';
						});
						$( "#divDaniel" ).click(function() {
							window.location.href = 'Persona/?id=Daniel';
						});
						$( "#divMaria" ).click(function() {
							window.location.href = 'Persona/?id=Maria';
						});						
					});
					</script>
			
				<?php
				} elseif($term->name != "COGIS") {
				?>
					 <h1><?php echo get_the_title($post->ID); ?></h1>
					 <div class='post-content'><?php echo $post->post_content; ?></div> 
				 <?php
				}
			}		
		}
	endforeach;
	wp_reset_postdata();
 }


 
 

 
function cchelp_guides() {
	get_template_part( 'search', 'cchelp' ); 
?>
	<br /><br /><h1>HELP GUIDES:</h1><br /><br />
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
				window.location.href = 'help-guides/?id=maps';
			});
			$( "#guideData" ).click(function() {
				window.location.href = 'help-guides/?id=data';
			});
			$( "#guideReports" ).click(function() {
				window.location.href = 'help-guides/?id=reports';
			});
			$( "#guideGroups" ).click(function() {
				window.location.href = 'help-guides/?id=groups';
			});
			$( "#guideAdmin" ).click(function() {
				window.location.href = 'help-guides/?id=admin';
			});			
		});
	</script>	
	

<?php
}

