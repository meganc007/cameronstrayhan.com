


<?
/**
 * The template for displaying 404 pages (Not Found).
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */

get_header(); ?>

<div class="container">

    <div class="row page-content">

        <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9 content-area">

	        <div class="contents clear">

		        <h1><? _e( 'Wow... There\'s Nothing Here.', 'Framework' ); ?></h1>
		        <p><? _e( 'Apologies, We weren\'t able to find what you\'re looking for. Perhaps searching will help find a related post.', 'Framework' ); ?></p>
		
		        <? get_search_form(); ?>
		
		        <script type="text/javascript">
			        // focus on search field after it has loaded
			        document.getElementById('s') && document.getElementById('s').focus();
		        </script>

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