<?
/**
 * Template Name: Full Width
 *
 * A custom page template without sidebar.
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */

get_header(); ?>

<div class="container">

    <div class="row page-content">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-area">
	    
		    <? if(have_posts()) while (have_posts()) : the_post(); ?>

		        <div class="contents clear">
		
		            <h1><? the_title(); ?></h1>	
		            <? the_content(); ?>
		
		        </div>
	
		        <? // comments_template('', true); ?>
		
	        <? endwhile; ?>

        </div>

    </div> <!--/PAGE-CONTENT-->

</div> <!--/CONTAINER-->

<? get_footer(); ?>