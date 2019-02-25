<?
/**
 * The template for displaying the Area Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */
 

get_header(); ?>

<div class="container">

    <div class="row page-content">

        <div class="col-xs-12 col-sm-10 content-area">

	        <div class="contents clear">


		        <? if (have_posts()) the_post(); ?>
		
		            <?if (is_day()) : ?>
			            <h1>Daily Archives:</h1>
			            <h3><?php printf(__('Results for %s', 'framework'), get_the_date()); ?></h3>
		            <?elseif (is_month()) : ?>
			            <h1>Monthly Archives:</h1>
			            <h3><?php printf(__('Results for %s', 'framework'), get_the_date('F Y')); ?></h3>
		            <?elseif (is_year()) : ?>
			            <h1>Yearly Archives:</h1>
			            <h3><?php printf(__('Results for %s', 'framework'), get_the_date('Y')); ?></h3>
		            <?else : ?>
			            <h1>Area Archives:</h1>
			            <h3><?php _e('All Areas', 'framework'); ?></h3>
		            <?endif; ?>
		
		        <? rewind_posts(); ?>
	
		        <? get_template_part( 'loop', 'archive' ); ?>

            </div>

        </div>

    </div> <!--/PAGE-CONTENT-->

</div> <!--/CONTAINER-->

<? get_footer(); ?>