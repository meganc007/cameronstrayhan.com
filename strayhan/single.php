<?
/**
 * The Template for displaying all single posts.
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */

get_header(); ?>

<div class="container">

    <div class="row page-content">

        <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9 content-area">
	    
		    <? if(have_posts()) while (have_posts()) : the_post(); ?>

		        <div class="contents clear">
		
		            <h1><? the_title(); ?></h1>
					<p><? cysy_posted_on(); ?></p>

				     <?php if ( has_post_thumbnail() ): ?>

		            	<div class="text-center thumbnail">
			        		<? the_post_thumbnail(); ?>
			        	</div>
		            	
		            <?php endif ?>

		            <? the_content(); ?>
					
					<hr />
					
					<? cysy_posted_in('categories', 'tags', 'comma'); ?>
					
                </div>
		
	        <? endwhile; ?>

        </div>

    </div> <!--/PAGE-CONTENT-->

</div> <!--/CONTAINER-->

<? get_footer(); ?>