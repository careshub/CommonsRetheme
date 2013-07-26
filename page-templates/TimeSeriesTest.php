<?php
/**
 * Template Name: Time Series Test
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
// ini_set('display_errors', 'On');
// error_reporting(E_ALL | E_STRICT);
get_header(); ?>


<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/highcharts.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/exporting.js'; ?>"></script>

      <?php while ( have_posts() ) : the_post(); ?>
        <?php //get_template_part( 'content', 'page-notitle' ); ?>
        <?php //comments_template( '', true ); ?>
      <?php endwhile; // end of the loop. ?>
	<div id="primary" class="site-content width-full">
    <div id="content" role="main" style="padding:20px;">  
		
	<div id="timeseries1" style="width:900px;"></div>
	<script type="text/javascript">	
		var $j = jQuery.noConflict();
		$j(function () {
        $j('#timeseries1').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: '% Children in Free/Reduced Lunch Program'
            },
            subtitle: {
                text: 'Georgia and the United States, 2007-2011'
            },
            xAxis: {
                categories: ['2007-2008', '2008-2009', '2009-2010', '2010-2011']
            },
            yAxis: {
                title: {
                    text: 'Percent in Free/Reduced Lunch (%)'
                },
                min: 40,
				max: 60
            },
            tooltip: {
				
            },
			credits: false,
            series: [{
                name: 'Custom Report Area',
                data: [42.56, 47.33, 44.55, 41.61]
				},
                {
                name: 'Georgia',
                data: [50.98, 53.09, 56.14, 57.44]
				}, 
				{
                name: 'United States',
                data: [40.84, 42.60, 45.82, 47.38]                
            }]		
		});
	});		
	</script>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	</div>
</div>
 
<?php get_footer(); ?>