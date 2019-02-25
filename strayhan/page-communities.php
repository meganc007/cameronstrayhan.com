<?
/**
 * Template Name: Communities Page
 * The template for displaying the communities.
 * A custom template for default pages.
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */

get_header(); ?>

<div class="container">

    <div class="row page-content">

        <div class="col-xs-12 content-area">
	    
		    <? if(have_posts()) while (have_posts()) : the_post(); ?>

		        <div class="contents clear">
		
		            <h1><? the_title(); ?></h1>
		            <? the_content(); ?>
		
		        </div>
	
		        <? // comments_template('', true); ?>
		
	        <? endwhile; ?>


	        <?php wp_reset_query(); ?>

	        <div class="black-line"></div>

		    <div class="row bucket-area">

		    	<? 
			    	$args = array(
					        'post_type' => array( 'area' ),
					        'order' => 'ASC',
				        );

			    	$query = new WP_Query($args); 
		    	?>

		        <? if( $query->have_posts() ) while ( $query->have_posts() ) : $query->the_post(); ?>

			        	<div class="col-xs-12 col-md-6 col-lg-4 bucket-item">

						    <div class="contents clear text-center">

								<div class="blur-box">
									<h5><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h5>
								</div>

				                <p><? the_post_thumbnail(); ?></p>
						
						    </div>

				        </div>			
		        <? endwhile; ?>

		    </div> <!--/BUCKET-AREA-->

        </div>


    </div> <!--/PAGE-CONTENT-->

</div> <!--/CONTAINER-->

<? get_footer(); ?>