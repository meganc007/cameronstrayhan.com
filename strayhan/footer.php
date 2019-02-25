<?
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */
?>


	        </main> <!--/MAIN-->
			
			<div class="container">
				<div class="row page-content">
					<div class="black-line"></div>
				</div>
			</div>

	        <div class="container text-center">
	        	<div class="row">
	        		<div class="col-sm-12">
	        			<h2>JOIN OUR NEWSLETTER</h2>
	        			<p>Stay connected with us and join our ever-growing newsletter! Sign up to receive monthly emails from us <br> about new and exciting properties available in your area.</p>
	        			
	        			<div class="row">
	        				<!-- Begin Constant Contact Inline Form Code -->
								<div class="ctct-inline-form" data-form-id="8a205af7-0022-4972-a6c8-6f7cd10e5f01"></div>
							<!-- End Constant Contact Inline Form Code -->
							
	        			</div>
	        		</div>
	        	</div>
	        </div>

	        <footer>

	        	<!-- Begin Constant Contact Active Forms -->
				<script> 
					var _ctct_m = "cf4655c4d760b4d56cf07e9eb78619a9";
				</script>
				<script id="signupScript" src="//static.ctctcdn.com/js/signup-form-widget/current/signup-form-widget.min.js" async defer></script>
				<!-- End Constant Contact Active Forms -->

		        <div class="container">

		        	<div class="black-line"></div>

					<? wp_nav_menu(array('container' => '', 'theme_location' => 'footer-navigation', 'fallback_cb' => 'false', 'items_wrap' => '<ul id="menu-footer-navigation">%3$s<ul>')); ?>

		            <div class="col-sm-9 pull-left">
		            	<p class="copyright">
			            	Copyright &copy;  <? echo date('Y') ?>. All Rights Reserved. Proudly made and managed in America by <a href="http://www.cysy.com" target="_blank" title="Panama City Beach Web Design" rel="nofollow">CYSY</a>.
			            </p>
			            <br>
			            <p>
			            	Sotheby’s International Realty® is a registered trademark licensed to Sotheby’s International Realty Affiliates LLC. Each office is independently owned and operated.
			            </p>
		            </div>

		            <div class="col-sm-3 pull-right">
		            	<img src="<? bloginfo('template_url'); ?>/images/Scenic_HorzBW.jpg" alt="<? bloginfo('name'); ?> - Properties for Sale 30A FL" class="text-center">
		            </div>

		        </div>

	        </footer>

	    </div> <!--/WRAPPER-->

	    <?

            /*****************************************************************************
	         * You can add your custom javascript code to the scripts.js file and ALWAYS
	         * make sure you call wp_footer() just before the closing </body> tag of your
	         * theme, or you will break many plugins, which generally use this hook to
	         * reference JavaScript files.
	         *****************************************************************************/

	         wp_footer();
	
	     ?>

    </body>

</html>