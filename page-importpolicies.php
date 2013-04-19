<?php
ini_set('max_execution_time', 53000); 

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php 
                        
                        sa_import_policies();         
                        
                        
                        
                        while ( have_posts() ) : the_post(); ?>
				<?php 
                             
                                
                                get_template_part( 'content', 'page' ); ?>
				
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); 

function sa_import_policies() {
    $xmlref = file_get_contents('http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/includes/sapolicies_import.xml');
    $xmlpols =  new SimpleXMLElement($xmlref) ;
    file_put_contents(dirname(__FILE__)."/includes/poloutput_sm.xml", $xmlpols->asXML());
    
    add_sa_policies($xmlpols);
}
function add_sa_policies($xmlpols){
       $count=0;
       foreach($xmlpols->Row as $row){   
                $count=$count+1;
                $desc=(string)$row->Description;

                $my_post = array(
                  'post_title'    => wp_strip_all_tags( (string)$row->Policy ),
                  'post_content'  => $desc,
                  'post_status'   => 'publish',
                  'post_author'   => 1,
                  'post_type' => sapolicies
                );

                // Insert the post into the database
                $post_id = wp_insert_post( $my_post );
                wp_set_post_terms($post_id, (string)$row->Tags, 'sa_policy_tags' );
                $newats = str_replace("|",",",(string)$row->Advocacy_Target);
               
                
                
                $atsparts = explode(",",$newats);
                $atsids=array();
                foreach($atsparts as $atspart){
                    if($atspart=='Reduce access to unhealthy competitive foods in school'){
                        $atsids[]=50114;
                        //localhost = 49379
                        //Better Food at School
                    }
                    if($atspart=='Increase the number of healthy food retail outlets in underserved communities receiving funding from food financing initiatives'){
                        $atsids[]=50115;
                        //localhost = 49385
                        //Better Food in Neighborhoods
                    }
                    if($atspart=='Improve physical activity standards in out-of-school and out-of-class time in underserved communities'){
                        $atsids[]=50117;
                        //localhost = 49386
                        //More Active Play Time
                    }
                    if($atspart=='Increase the use of joint use agreements and street-scale improvements in underserved communities'){
                        $atsids[]=50118;
                        //localhost = 49387
                        //Places for Activity
                    }
                    if($atspart=='Reducing unhealthy beverage comsumption using pricing incentives and disincentives'){
                        $atsids[]=50116;
                        //localhost = 49388
                        //Price of Sugary Drinks
                    }
                    if($atspart=='Increase incentives and demand for strengthening industry self-regulation and government regulation of food marketing to kids'){
                        $atsids[]=50113;
                        //localhost = 49384
                        //Stop Unhealthy Advertising
                    }                    
                }              
                wp_set_object_terms($post_id,$atsids,'sa_advocacy_targets');
                
                
                if ((string)$row->Policy_Stage == 'Pre Policy') {
                    $preparts = explode("|",(string)$row->Policy_Stage);
                    foreach($preparts as $val1) {
                       if ($val1 == 'Describe Problem'){
                           $pre1='Describe Problem';
                       } else {
                           $pre1="";
                       }
                       if($val1 == 'Study Causes and Consequences'){
                           $pre2='Study Causes and Consequences';
                       } else {
                           $pre2="";
                       }
                       if($val1 == 'Describe Trend and Spread of Issues'){
                           $pre3='Describe Trend and Spread of Issues';
                       } else {
                           $pre3="";
                       }
                    }
                }elseif((string)$row->Policy_Stage == 'Develop Policy'){
                    $devparts = explode("|",(string)$row->Policy_Stage);
                    foreach($devparts as $val2) {
                       if ($val2 == 'Promote Awareness'){
                           $dev1='Promote Awareness';
                       } else {
                           $dev1="";
                       }
                       if($val2 == 'Re-frame Issues'){
                           $dev2='Re-frame Issues';
                       } else {
                           $dev2="";
                       }
                       if($val2 == 'Mobilize Publics'){
                           $dev3='Mobilize Publics';
                       } else {
                           $dev3="";
                       }
                    }
                }elseif((string)$row->Policy_Stage == 'Enact Policy'){
                    $enactparts = explode("|",(string)$row->Policy_Stage);
                    foreach($enactparts as $val3) {
                       if ($val3 == 'Create Advocacy'){
                           $enact1='Create Advocacy';
                       } else {
                           $enact1="";
                       }
                       if($val3 == 'Frame Policy'){
                           $enact2='Frame Policy';
                       } else {
                           $enact2="";
                       }
                       if($val3 == 'Pass Policy or Legislation'){
                           $enact3='Pass Policy or Legislation';
                       } else {
                           $enact3="";
                       }
                    }                    
                }elseif((string)$row->Policy_Stage == 'Post Policy'){
                    $postparts = explode("|",(string)$row->Policy_Stage);
                    foreach($postparts as $val4) {
                       if ($val4 == 'Implement Policy'){
                           $post1='Implement Policy';
                       } else {
                           $post1="";
                       }
                       if($val4 == 'Ensure Access and Equity'){
                           $post2='Ensure Access and Equity';
                       } else {
                           $post2="";
                       }
                       if($val4 == 'Sustain, Change, Abandon'){
                           $post3='Sustain, Change, Abandon';
                       } else {
                           $post3="";
                       }
                    }                       
                }
                
                $geog=(string)$row->Geography;
                $st=(string)$row->State;
                $pt=(string)$row->Policy_Type;
                $ps=(string)$row->Policy_Stage;
                $de=(string)$row->Date_Enacted;
                $di=(string)$row->Date_Implemented;
                $fg=(string)$row->Selected_Geography;
                
                update_post_meta($post_id, 'sa_geog', $geog);
                update_post_meta($post_id, 'sa_state', $st);
                update_post_meta($post_id, 'sa_policytype', $pt);
                update_post_meta($post_id, 'sa_policystage', $ps);
                update_post_meta($post_id, 'sa_dateenacted', $de);
                update_post_meta($post_id, 'sa_dateimplemented', $di);
                update_post_meta($post_id, 'sa_pre1', $pre1);
                update_post_meta($post_id, 'sa_pre2', $pre2);
                update_post_meta($post_id, 'sa_pre3', $pre3);
                update_post_meta($post_id, 'sa_dev1', $dev1);
                update_post_meta($post_id, 'sa_dev2', $dev2);
                update_post_meta($post_id, 'sa_dev3', $dev3);
                update_post_meta($post_id, 'sa_enact1', $enact1);
                update_post_meta($post_id, 'sa_enact2', $enact2);
                update_post_meta($post_id, 'sa_enact3', $enact3);
                update_post_meta($post_id, 'sa_post1', $post1);
                update_post_meta($post_id, 'sa_post2', $post2);
                update_post_meta($post_id, 'sa_post3', $post3);   
                update_post_meta($post_id, 'sa_finalgeog', $fg); 
                
                echo $count . ". " . (string)$row->Policy . " updated! " . date('m/d/y',time()) . "<br>";
       }  
    
}