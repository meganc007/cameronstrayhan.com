<?
/**
 * Framework Functions and Definitions
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */
 
/*----------------------------------------------------------------------------------------------------------------------


  DASHBOARD FUNCTIONS


------------------------------------------------------------------------------------------------------------------------*/

    // ******************************************************************************************************************
    // ADD CUSTOM STYLES TO DASHBOARD
    // ******************************************************************************************************************
 
    function cysy_admin_styles() {
  
        $styles  = '<style>';
        $styles .= '.wp-admin .form-table tr { border-top: 1px solid #eee; }';
        $styles .= '.wp-admin .form-table tr:first-child { border-top: 0; }';
	    $styles .= '.wp-admin .form-table td { padding: 15px 0 !important; }';
        $styles .= '.welcome-panel-close { display: none !important; }';
        $styles .= '.welcome-panel { padding: 12px !important; }';
        $styles .= '.welcome-panel-content { margin-left: 0 !important; }';
  	    $styles .= '</style>';
        
        echo $styles;
    }

    add_action( 'admin_head', 'cysy_admin_styles' ); 

    // ******************************************************************************************************************
    // CHANGE DEFAULT LOGIN SCREEN LOGO TO CUSTOM LOGO
    // ******************************************************************************************************************

    function cysy_login_logo() {

        $logo  = '<style>';
        $logo .= '.login h1 a { background-image: url( "' . get_template_directory_uri() . '/images/graphic_admin_logo.png" ) !important; background-size: 100% auto; width: 150px !important; height: 150px !important; }';
        $logo .= '</style>';
        
        echo $logo;

    }

	add_action('login_head', 'cysy_login_logo');

    // ******************************************************************************************************************
    // CHANGE LOGIN SCREEN LOGO URL TO CYSY.COM
    // ******************************************************************************************************************

    function cysy_login_url( $url ) {

        $url = 'http://cysy.com/';
        return $url;
	
    }

    add_filter( 'login_headerurl', 'cysy_login_url' );

    // ******************************************************************************************************************
    // CHANGE LOGIN SCREEN TITLE TO SITE TITLE
    // ******************************************************************************************************************

    function cysy_login_title( $title ) {
        
        $title = 'CYSY';
        return $title;
        
    }

    add_filter( 'login_headertitle', 'cysy_login_title' );

    // ******************************************************************************************************************
    // REMOVES WORDPRESS VERSION FROM HEADER AND FEEDS FOR SECURITY
    // ******************************************************************************************************************

    function cysy_version_removal() {
    	    
        return '';
        
    }

    add_filter( 'the_generator', 'cysy_version_removal' );

    // ******************************************************************************************************************
    // REMOVES VARIOUS DASHBOARD META BOXES AND WIDGET PANELS FOR A CLEANER LOOK
    // ******************************************************************************************************************

    function cysy_custom_dashboard_widgets() {

        global $wp_meta_boxes;
        
        // ACTIVITY
	    //unset( $wp_meta_boxes[ 'dashboard' ][ 'normal' ][ 'core' ][ 'dashboard_activity' ] );

 	    // AT A GLANCE
	    //unset( $wp_meta_boxes[ 'dashboard' ][ 'normal' ][ 'core' ][ 'dashboard_right_now' ] );

	    // RECENT COMMENTS
	    //unset( $wp_meta_boxes[ 'dashboard' ][ 'normal' ][ 'core' ][ 'dashboard_recent_comments' ] );

	    // INCOMING LINKS
	    unset( $wp_meta_boxes[ 'dashboard' ][ 'normal' ][ 'core' ][ 'dashboard_incoming_links' ] );

	    // PPLUGINS
	    unset( $wp_meta_boxes[ 'dashboard' ][ 'normal' ][ 'core' ][ 'dashboard_plugins' ] );

	    // WORDPRESS DEVELOPMENT BLOG FEED
	    unset( $wp_meta_boxes[ 'dashboard' ][ 'side' ][ 'core' ][ 'dashboard_primary' ] );

	    // OTHER WORDPRESS NEWS FEED
	    unset( $wp_meta_boxes[ 'dashboard' ][ 'side' ][ 'core' ][ 'dashboard_secondary' ] );

	    // QUICK PRESS
	    //unset( $wp_meta_boxes[ 'dashboard' ][ 'side' ][ 'core' ][ 'dashboard_quick_press' ] );

	    // RECENT DRAFTS
	    //unset( $wp_meta_boxes[ 'dashboard' ][ 'side' ][ 'core' ][ 'dashboard_recent_drafts' ] );

		// ADD CUSTOM META BOX (RESOURCES)
        //add_meta_box( 'custom_widget_resources', 'Resources', 'custom_widget_resources', 'dashboard', 'core', 'high' );
        
        // ADD CUSTOM META BOX (NEED ASSISTANCE)
        //add_meta_box( 'custom_widget_assistance', 'Need Assistance?', 'custom_widget_assistance', 'dashboard', 'side', 'high' );

    }

    add_action( 'wp_dashboard_setup', 'cysy_custom_dashboard_widgets' );

    // ******************************************************************************************************************
    // ADD CUSTOM WELCOME PANEL TO THE DASHBOARD
    // ******************************************************************************************************************

    function cysy_welcome_panel() {

        $panel  = '<div class="welcome-panel-content">';
        $panel .= '<h2>Powered by CYber SYtes, Inc.</h2>';
        $panel .= '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam semper felis quis sodales. Integer id malesuada nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis vitae lectus porta, lacinia justo quis, tempor neque. Phasellus euismod laoreet justo. Aenean purus urna, vehicula a porttitor bibendum, scelerisque et odio. Duis rutrum urna id est ornare, in vehicula dui pretium. Maecenas tristique nisi vitae est congue commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pharetra sodales faucibus. Cras eu semper ex, vitae sollicitudin lacus.</p>';
        $panel .= '</div>';
        
        echo $panel;
        
    }

    //remove_action( 'welcome_panel','wp_welcome_panel' );
    //add_action( 'welcome_panel','cysy_welcome_panel' );


    // ******************************************************************************************************************
    // CONTENT FOR CUSTOM META BOXES
    // ******************************************************************************************************************

    function custom_widget_resources() {

        $content  = '<h2>Resources</h2>';
        $content .= '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam semper felis quis sodales. Integer id malesuada nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis vitae lectus porta, lacinia justo quis, tempor neque. Phasellus euismod laoreet justo. Aenean purus urna, vehicula a porttitor bibendum, scelerisque et odio. Duis rutrum urna id est ornare, in vehicula dui pretium. Maecenas tristique nisi vitae est congue commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pharetra sodales faucibus. Cras eu semper ex, vitae sollicitudin lacus.</p>';
        $content .= '<button>Click Me</button>';

        echo $content;

    }

    function custom_widget_assistance() {

        $content  = '<h2>Need Assistance?</h2>';
        $content .= '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam semper felis quis sodales. Integer id malesuada nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis vitae lectus porta, lacinia justo quis, tempor neque.</p>';

	$content .= '<iframe class="support-form" src="https://cybersytes.supportbee.com/web_tickets/new?embed=true&locale=en" style="width: 100%; height: 500px; border: none;"></iframe>';

        echo $content;

    }

    // ******************************************************************************************************************
    // REMOVES UNNECESSARY HEADER INFO
    // ******************************************************************************************************************

    function cysy_remove_header_info() {
    
        remove_action( 'wp_head', 'rsd_link' );
        
    	    remove_action( 'wp_head', 'wlwmanifest_link' );
    	    remove_action( 'wp_head', 'wp_generator' );
    	    remove_action( 'wp_head', 'start_post_rel_link' );
    	    remove_action( 'wp_head', 'index_rel_link' );
    	    remove_action( 'wp_head', 'adjacent_posts_rel_link' );
        
	}

	add_action( 'init', 'cysy_remove_header_info' );

    // ******************************************************************************************************************
    // ADDS CUSTOM DASHBOARD FOOTER
    // ******************************************************************************************************************

    function cysy_remove_footer_admin() {
        
        echo 'Proudly made and managed in America by: <a href="http://www.cysy.com" target="_blank" title="Panama City Beach Web Design">CYber SYtes, Inc.</a>';

    }
	
    add_filter( 'admin_footer_text', 'cysy_remove_footer_admin' );

    // ******************************************************************************************************************
    // REMOVES LOGIN ERROR MESSAGE FOR SECURITY
    // ******************************************************************************************************************

    add_filter( 'login_errors', create_function( '$a', "return null;" ) );

    // ******************************************************************************************************************
    // REMOVES CORE UPDATE NOTIFICATIONS FOR NON ADMINS
    // ******************************************************************************************************************

	if ( ! current_user_can( 'edit_users' ) ) {
  	    remove_action( 'admin_notices', 'update_nag', 3 );
	}

    // ******************************************************************************************************************
    // ADDS LINKS SECTION BACK TO DASHBOARD
    // ******************************************************************************************************************

    add_filter( 'pre_option_link_manager_enabled', '__return_true' );

    // ******************************************************************************************************************
    // REMOVES VARIOUS SECTIONS FROM THE DASHBOARD
    // ******************************************************************************************************************

    function cysy_remove_admin_menus() {

		global $submenu;
        remove_menu_page('link-manager.php'); // HIDE LINKS
        // remove_menu_page('edit.php'); // HIDE POSTS
        // remove_menu_page('edit-comments.php'); // HIDE COMMENTS
        // remove_menu_page('tools.php'); // HIDE TOOLS
        // remove_submenu_page('themes.php','themes.php'); // HIDE THEMES
      	// unset($submenu['themes.php'][6]); // HIDE CUSTOMIZE PAGE

	}

	add_action( 'admin_menu', 'cysy_remove_admin_menus' );







 ?>