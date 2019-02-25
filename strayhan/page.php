<?
/**
 * The template for displaying all pages.
 * A custom template for default pages.
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
		            <? the_content(); ?>
		
		        </div>
	
		        <? // comments_template('', true); ?>
		
	        <? endwhile; ?>

        </div>

        <!-- <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 sidebar-area">

            <div class="contents clear">

                <//? get_sidebar(); ?>

            </div>

        </div> -->

    </div> <!--/PAGE-CONTENT-->

</div> <!--/CONTAINER-->

<? get_footer(); ?>