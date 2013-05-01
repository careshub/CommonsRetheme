<?php

function sa_location_search()
{ 

        ?>
        <form method="POST" action="" name="sa_ls" enctype="multipart/form-data"> 
            <input type="text" id="locationtxt" size="65" name="locationtxt" />
            <input type="submit" name="submit" value="Search"/>
        </form>
<br><br>
<?php
        if(isset($_POST['locationtxt']))
    {
		
        global $wpdb;    
        $loc = $_POST['locationtxt'];  
        $loc2 = str_replace(" ","%20",$loc);
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $loc2 . '&sensor=false');
        $output = json_decode($geocode);
        $lat = $output->results[0]->geometry->location->lat;
        $lng = $output->results[0]->geometry->location->lng;
        
 
        
        
        $query = "SELECT DISTINCT $wpdb->posts.ID, $wpdb->posts.post_title, $wpdb->posts.post_content, wpcflat.meta_value AS latitude, wpcflong.meta_value AS longitude,
            3959 * 2 * ASIN ( SQRT (POWER(SIN(($lat - wpcflat.meta_value)*pi()/180 / 2),2) + COS($lat * pi()/180) * COS(wpcflat.meta_value *pi()/180) * POWER(SIN(($lng - wpcflong.meta_value) *pi()/180 / 2), 2) ) ) as distance
        FROM $wpdb->posts
            LEFT JOIN $wpdb->postmeta as wpcflong ON ($wpdb->posts.ID = wpcflong.post_id)
            LEFT JOIN $wpdb->postmeta as wpcflat ON ($wpdb->posts.ID = wpcflat.post_id)

        WHERE $wpdb->posts.ID
        AND wpcflat.meta_key = 'sa_latitude'
        AND wpcflong.meta_key = 'sa_longitude'

        ORDER BY distance
        LIMIT 200";
      
        //print_r($query);
        $results = $wpdb->get_results($query);
         if (!$results) {
          die("Invalid query: " . $wpdb->show_errors());
        } else {
            //var_dump($results);
            echo "Your search: " . $loc;
            ?>
            <div id="contact-content">
                    <script type="text/javascript">
                    var markers = [];    
                    function samap_initialize() {

                        var firstpt = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>);

                        var firstLatlng = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>);              

                        var firstOptions = {
                            zoom: 7,
                            center: firstLatlng,
                            mapTypeId: google.maps.MapTypeId.ROADMAP 
                        };

                        var map = new google.maps.Map(document.getElementById("map_sapolicies"), firstOptions);

                        var firstimage = 'http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/img/star-3.png';
                        var policyimage = 'http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/img/doc-3.png';
                        
                        var firstmarker = new google.maps.Marker({
                            position: firstpt,
                            map: map,
                            icon: firstimage,
                            title: 'Your search location'
                        });


                        <?php 
                            foreach ($results as $result){
                                $theTitle = $result->post_title;
                                $theLat = $result->latitude;
                                $theLng = $result->longitude;
                                $pl = get_permalink($result->ID);    
                                
                        ?>
                      
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(<?php echo $theLat . ", " . $theLng ?>),
                            map: map,
                            icon: policyimage,
                            html: "<b><a href='<?php echo $pl; ?>'><?php echo $theTitle; ?></a></b><br>"
                          });
                        markers.push(marker);
                        google.maps.event.addListener(marker, 'click', function () {
                            infowindow.setContent(this.html);
                            infowindow.open(map, this);
                        });
                            <?php } ?>
                        

                        var contentString1 = 'Your Search Location:<br><?php echo $loc ?>';

                        var infowindow = new google.maps.InfoWindow({
                            content: "loading..."
                        });

                        var infowindow1 = new google.maps.InfoWindow({
                            content: contentString1
                        });

                        google.maps.event.addListener(firstmarker, 'click', function() {
                            infowindow1.open(map,firstmarker);
                        });

                    }
                    </script>

                    <div class="map">
                        <style type="text/css">
                        #map_sapolicies img {
                           max-width: none;
                           border-width:0px;
                           -webkit-box-shadow: none;
                           -moz-box-shadow: none;
                           box-shadow: none;                           
                        }
                        </style>
                        <div id="map_sapolicies" style="width: 600px; height: 600px"></div><br><br>  

                    </div>

                </div>  















            <?php
            
            foreach ($results as $result){
                echo "<div style='color:#fe9600;font-weight:bold;font-size:13pt;'><a href='" . get_permalink($result->ID) . "'>" . $result->post_title . "</a></div><br>";
		echo "<div>" . $result->post_content . "</div><div style='font-style:italic;'>Distance from search center: " . round($result->distance, 2) . " miles</div><br>";			
            

            }
            
            
            
            
        }
        


    }
}
add_shortcode( 'SA_location_search', 'sa_location_search' );





