<?
/**
 * The template for displaying Search Results pages.
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */

get_header(); ?>

<div class="container">

    <div class="row page-content">

        <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9 content-area">

	        <div class="contents clear">

		        <? if ( have_posts() ) : ?>
		
		            <h1>Search Results:</h1>
			        <h3><?php printf( __('Results for "%s"', 'framework'), '<span>' . get_search_query() . '</span>'); ?></h3>
		        
                    <? get_template_part('loop', 'search'); ?>
		    
		        <? else : ?>
		
		            <h1><? _e('Nothing Found', 'Framework'); ?></h1>
		            <p><? _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'Framework'); ?></p>
		    
			        <? get_search_form(); ?>
		    
		        <? endif; ?>
		
           </div>

        </div>

        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 sidebar-area">

            <div class="contents clear">

                <? get_sidebar(); ?>

            </div>

        </div>

    </div> <!--/PAGE-CONTENT-->

</div> <!--/CONTAINER-->

<? get_footer(); ?>