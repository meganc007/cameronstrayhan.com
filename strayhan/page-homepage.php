<?
/**
 * Template Name: *Homepage
 * A custom page template for the homepage.
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */

get_header(); ?>

<div class="container">

    <div class="row page-content">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-area text-center">
	    
		    <? if(have_posts()) while (have_posts()) : the_post(); ?>

		        <div class="contents clear">
		            
		            <div class="slider text-center">
		            	<div class="search-box">
		            		<h2>Get Started</h2>
		            		<h4><a href="property-search/">Search</a></h4>
		            	</div>
		            	<? echo do_shortcode('[metaslider id=85]') ?>
		            </div>
		
		        </div>
	
		        <? // comments_template('', true); ?>
		
	        <? endwhile; ?>

        </div>

    </div> <!--/PAGE-CONTENT-->

	<?php wp_reset_query(); ?>

    <div class="black-line"></div>

    <div class="row bucket-area">

    	<? 
	    	$args = array(
			        'post_type' => array( 'area' ),
			        'order' => 'ASC',
			        'posts_per_page' => 6,
		        );

	    	$query = new WP_Query($args); 
    	?>

        <? if( $query->have_posts() ) while ( $query->have_posts() ) : $query->the_post(); ?>
		
				<? $slug = $post->post_name;
					$slug = str_replace('-', '+', $slug);
				?>

	        	<div class="col-xs-12 col-md-6 col-lg-4 bucket-item text-center">

				    <div class="contents clear text-center">

						<div class="blur-box">
							<h5><a href="<? bloginfo('url'); ?>/listings?subdivision=<? echo $slug; ?>"><? the_title(); ?></a></h5>
						</div>

		                <p><? the_post_thumbnail(); ?></p>
				
				    </div>

		        </div>

	        <? // comments_template('', true); ?>
	
        <? endwhile; ?>

        <div class="clear"></div>

        <p class="text-center view-more"><a href="<? echo get_post_type_archive_link('area'); ?>">View More Communities</a></p>

    </div> <!--/BUCKET-AREA-->
</div> <!--/CONTAINER-->

<?php wp_reset_query(); ?>

<? get_footer(); ?>