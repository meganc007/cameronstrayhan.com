<?
/**
 * Framework Functions and Definitions
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */

/*----------------------------------------------------------------------------------------------------------------------


  DEREGISTER, REGISTER, AND ENQUEUE CUSTOM SCRIPTS


------------------------------------------------------------------------------------------------------------------------*/

    // ******************************************************************************************************************
    // ENQUEUE LOCAL JQUERY FILE
    // ******************************************************************************************************************
	
    /********************************************************************************************************************
    * We deregister the built-in jQuery that comes with Wordpress and register our own local copy because upgrading
    * Wordpress sometimes upgrades the version of jQuery that comes with it and this may break certain features that make 
    * use of functions that may be deprecated in newer versions.
    *********************************************************************************************************************/

    function cysy_replace_jquery() {
		
        // DEREGISTER BUILT-IN JQUERY
        wp_deregister_script( 'jquery' );
	
        // REGISTER LOCAL JQUERY
        wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery-2.2.4.min.js' );
	
        // ENQUEUE CUSTOM JQUERY
        wp_enqueue_script( 'jquery' );

    }	

    add_action( 'wp_enqueue_scripts', 'cysy_replace_jquery' );
	
    // ******************************************************************************************************************
    // FILES TO ENQUEUE TO THE HEADER
    // ******************************************************************************************************************

	function cysy_enqueue_header() {
        
        // ENQUEUE BOOTSTRAP STYLESHEET
        wp_enqueue_style( 'bootstrap-styles', get_template_directory_uri() . '/bootstrap.css' );

        // ENQUEUE BOOTSTRAP THEME STYLESHEET
        wp_enqueue_style( 'bootstrap-theme-styles', get_template_directory_uri() . '/bootstrap-theme.css' );
	
        // ENQUEUE DEFAULT STYLESHEET
        wp_enqueue_style( 'styles', get_template_directory_uri() . '/style.css' );
		
        // ENQUEUE FONT-AWESOME STYLESHEET
        wp_enqueue_style( 'font-awesome-styles', get_template_directory_uri() . '/font-awesome.css' );

        // ENQUEUE ANIMATE STYLESHEET
        wp_enqueue_style( 'animate-styles', get_template_directory_uri() . '/animate.css' );

        // ENQUEUE MOBILE STYLESHEET
        wp_enqueue_style( 'mobile-styles', get_template_directory_uri() . '/mobile.css' );

        // ENQUEUE LIGHTBOX STYLESHEET
        wp_enqueue_style( 'lightbox-styles', get_template_directory_uri() . '/lightbox.css' );
	
        // ENQUEUE MODERNIZR SCRIPT
        wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.5.3.js' );

        // ENQUEUE SCRIPTS FOR NESTED COMMENTS
        if( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }

    }

    add_action('wp_enqueue_scripts', 'cysy_enqueue_header');
	
    // ******************************************************************************************************************
    // FILES TO ENQUEUE TO THE FOOTER
    // ******************************************************************************************************************

    function cysy_enqueue_footer() {	
	
        // ENQUEUE BOOTSTRAP SCRIPT
        wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', null, null, true );
        
        // ENQUEUE LIGHTBOX SCRIPT
        wp_enqueue_script( 'lightbox-script', get_template_directory_uri() . '/js/lightbox.min.js', null, null, true );

        // ENQUEUE WOW.JS SCRIPT
        wp_enqueue_script( 'wow-script', get_template_directory_uri() . '/js/wow.min.js', null, null, true );
        
        // ENQUEUE FOOTER SCRIPTS
        wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', null, null, true );
	
    }

    add_action( 'wp_enqueue_scripts', 'cysy_enqueue_footer' );

/*----------------------------------------------------------------------------------------------------------------------


  INCLUDES FOR FUNCTION FILES & OTHER LIBRARIES


------------------------------------------------------------------------------------------------------------------------*/

    // ******************************************************************************************************************
    // DASHBOARD FUNCTIONS
    // ******************************************************************************************************************
	
	include( TEMPLATEPATH . '/php/functions_dashboard.php' );

    // ******************************************************************************************************************
    // ADMIN FUNCTIONS
    // ******************************************************************************************************************
	
	include( TEMPLATEPATH . '/php/functions_admin.php' );

    // ******************************************************************************************************************
    // NAVIGATION FUNCTIONS
    // ******************************************************************************************************************
	
	include( TEMPLATEPATH . '/php/functions_navigation.php' );

    // ******************************************************************************************************************
    // MAIN FUNCTIONS
    // ******************************************************************************************************************
	
	include( TEMPLATEPATH . '/php/functions_main.php' ); 

    // ******************************************************************************************************************
    // COMMENTS, TRACKBACK, & PINGBACK FUNCTIONS
    // ******************************************************************************************************************
	
	include( TEMPLATEPATH . '/php/functions_comments.php' );	

    // ******************************************************************************************************************
    // CUSTOM FIELD FUNCTIONS
    // ******************************************************************************************************************
	
	include( TEMPLATEPATH . '/php/functions_custom_fields.php' );

    // ******************************************************************************************************************
    // CUSTOM FUNCTIONS
    // ******************************************************************************************************************
	
	include( TEMPLATEPATH . '/php/functions_custom.php' );


?>