<?
/**
 * The template for displaying Tag Archive pages.
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */

get_header(); ?>

<div class="container">

    <div class="row page-content">

        <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9 content-area">

	        <div class="contents clear">

		        <h1>Tag Archives:</h1>
		        <h3><?php printf( __( 'Results for "%s"', 'framework' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h3>

		        <? get_template_part( 'loop', 'tag' ); ?>
    
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