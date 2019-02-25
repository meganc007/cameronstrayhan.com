<?
/**
 * The Header for the theme
 *
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */
?>

<!DOCTYPE html>

    <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
    <!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
    <!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

    <head>

        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><? cysy_generate_title(); ?></title>

        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<? bloginfo( 'pingback_url' ); ?>" />

	    <? if(is_single()) {
	        cysy_update_views(get_the_ID());
	    } ?>
    
        <?
	
            /*****************************************************************************
	         * All scripts and stylesheets should be enqueued from the functions.php file
	         * in either the header or footer area. You can also add your javascript to
	         * the scripts.js file in the footer and ALWAYS make sure you call wp_head()
	         * just before the closing </head> tag of your theme.
	         *****************************************************************************/
	
	         wp_head();

	    ?>

		<!-- Google Fonts -->
	    <link href="https://fonts.googleapis.com/css?family=Arapey" rel="stylesheet">
		
		<!-- Facebook Comments Notification Account -->
	    <meta property="fb:admins" content="Placeholder ID #"/>

	    <!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112885395-1"></script>
		<script>
			  window.dataLayer = window.dataLayer || [];
			  function gtag(){dataLayer.push(arguments);}
			  gtag('js', new Date());

			  gtag('config', 'UA-112885395-1');
		</script>


    </head>

    <body <? body_class(); ?>>
    	<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>

        <div class="wrapper">

	        <header>

                <div class="container-fluid">

                    <div class="row header-content">

                    	<div class="col-xs-12 social-header text-center">
                    		<ul>
                    			<li>
                    				<h3><a href="https://www.facebook.com/CameronKStrayhan/?ref=bookmarks" target="_blank">Facebook</a></h3>
                    			</li>
                    			<li>
                    				<h3><a href="https://www.instagram.com/cameronstrayhanliving/" target="_blank">Instagram</a></h3>
                    			</li>
                    			<li>
                    				<h3><a href="https://www.pinterest.com/dwc300/pins/" target="_blank">Pinterest</a></h3>
                    			</li>
                    		</ul>
                    	</div>

        				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-area text-center">
	
		            	    <a class="logo text-center" href="<? echo home_url('/'); ?>" title="<? echo esc_attr( get_bloginfo('name', 'display')); ?>" rel="home">
			                    <img src="<? bloginfo('template_url'); ?>/images/graphic_logo.png" alt="<? bloginfo('name'); ?> - 30A Real Estate in NW Florida" />
		                    </a>

                        </div>

                    </div>

                </div>

                <div class="container">
                	<div class="black-line"></div>
					
                	<nav id="main-navigation">

			            <div class="container text-center">

			    	        <? $walker = new My_Walker; wp_nav_menu(array('container' => '', 'theme_location' => 'main-navigation', 'fallback_cb' => 'false', 'items_wrap' => '<ul id="menu-main-navigation">%3$s<li class="menu-item menu-right mobile-menu"><a id="mobile-nav-btn" href="#"><span>Menu</span></a><div class="menu-item-content"><ul id="menu-mobile-navigation" class="sub-menu">%3$s</ul></div></li></ul>', 'walker' => $walker)); ?>
	    		
			            </div>
	    
			        </nav>
                </div>
       
	        </header>

	        <main class="clear">