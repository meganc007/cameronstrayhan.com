<?
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */

get_header(); ?>

<div class="container">

    <div class="row page-content">

        <div class="col-xs-12 content-area">
		
            <div class="contents clear">

				<? $blog_title = get_the_title( get_option('page_for_posts', true) ); ?>

				<h1><? echo $blog_title; ?></h1>

		        <? get_template_part( 'loop', 'index' ); ?>
    
		    </div>

        </div>

    </div> <!--/PAGE-CONTENT-->

</div> <!--/CONTAINER-->

<? get_footer(); ?>