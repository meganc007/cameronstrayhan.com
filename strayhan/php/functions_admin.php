<?
/**
 * Framework Functions and Definitions
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */
 
/*----------------------------------------------------------------------------------------------------------------------


  ADMIN FUNCTIONS


------------------------------------------------------------------------------------------------------------------------*/

    // ******************************************************************************************************************
    // REGISTER CUSTOM USER ROLE FOR CLIENTS
    // ******************************************************************************************************************
 

	function cysy_create_client_user_role() {
    
		global $wp_roles;
    
		if (!isset($wp_roles)) {
        	$wp_roles = new WP_Roles();
		}

		$caps = array(
			'level_8' => true,
			'activate_plugins' => true,
			'create_users' => true,
			'customize' => false,
			'delete_others_pages' => true,
			'delete_others_posts' => true,
			'delete_pages' => true,
			'delete_plugins' => false,
			'delete_posts' => true,
			'delete_private_pages' => true,
			'delete_private_posts' => true,
			'delete_published_pages' => true,
			'delete_published_posts' => true,
			'delete_site'  => false,
			'delete_themes' => false,
			'delete_users' => true,
			'edit_dashboard' => true,
			'edit_files' => true,
			'edit_others_pages' => true,
			'edit_others_posts' => true,
			'edit_pages' => true,
			'edit_plugins' => false,
			'edit_posts' => true,
			'edit_private_pages' => true,
			'edit_private_posts' => true,
			'edit_published_pages' => true,
			'edit_published_posts' => true,
			'edit_themes' => false,
			'edit_theme_options' => true,
			'edit_users' => true,
			'export' => true,
			'import' => true,
			'install_plugins' => true,
			'install_themes' => true,
			'list_users' => true,
			'manage_categories' => true,
			'manage_links' => true,
			'manage_options' => true,
			'moderate_comments' => true,
			'promote_users' => true,
			'publish_pages' => true,
			'publish_posts' => true,
			'read_private_pages' => true,
			'read_private_posts' => true,
			'read' => true,
			'remove_users' => true,
			'switch_themes' => true,
			'update_core'  => false,
			'update_plugins' => false,
			'update_themes' => false,
			'upload_files' => true,
			'upload_plugins' => true,
			'upload_themes' => true,
			'unfiltered_html' => true,
    	);

		if(!get_role('client')) {
    		$wp_roles->add_role('client', 'Client', $caps);
		}

	}

	add_action('init', 'cysy_create_client_user_role');



	// ******************************************************************************************************************
    // LIMIT WHAT USERS CLIENT ROLE CAN CREATE/EDIT/ASSIGN
    // ******************************************************************************************************************

	function cysy_get_allowed_roles($user) {
    
		$allowed = array();

    	if(in_array('administrator', $user->roles)) { 

			// ADMINISTRATORS CAN EDIT ALL ROLES
        	$allowed = array_keys( $GLOBALS['wp_roles']->roles );

    	} elseif(in_array('client', $user->roles)) {

			// CLIENTS CAN EDIT ALL USERS BUT ADMINISTRATORS
        	$allowed[] = 'client';
        	$allowed[] = 'editor';
			$allowed[] = 'author';
			$allowed[] = 'contributor';
			$allowed[] = 'subscriber';

    	} elseif(in_array('editor', $user->roles)) {

			// EDITORS CAN EDIT ALL USERS BELOW EDITOR LEVEL
        	$allowed[] = 'author';
			$allowed[] = 'contributor';
			$allowed[] = 'subscriber';

    	}

    	return $allowed;

	}

	function cysy_editable_roles($roles) {
    
		if($user = wp_get_current_user()) {
        
			$allowed = cysy_get_allowed_roles($user);

        	foreach($roles as $role => $caps) {
            
				if(!in_array($role, $allowed)) {
                	unset($roles[$role]);
				}

        	}
    
		}

    	return $roles;
	}

	add_filter('editable_roles', 'cysy_editable_roles');

	function cysy_map_meta_cap($caps, $cap, $user_ID, $args) {
    
		if(($cap === 'edit_user' || $cap === 'delete_user') && $args) {

        	$the_user = get_userdata($user_ID);
        	$target = get_userdata($args[0]);

        	if($the_user && $target && $the_user->ID != $target->ID) {
            
				$allowed = cysy_get_allowed_roles($the_user);

            	if(array_diff($target->roles, $allowed)) {
               		$caps[] = 'not_allowed';
            	}
        
			}
    	
		}

    	return $caps;

	}

	add_filter( 'map_meta_cap', 'cysy_map_meta_cap', 10, 4);

    // ******************************************************************************************************************
    // REGISTER CUSTOM IMAGE SIZES FOR MEDIA LIBRARY
    // ******************************************************************************************************************

    if( function_exists( 'add_theme_support' ) ) {
	
        add_theme_support( 'post-thumbnails' );                         // ADDS SUPPORT FOR FEATURED IMAGES
        add_image_size( 'thumbnail', 240, 240, true );                  // THUMBNAIL PHOTOS
        add_image_size( 'small', 480, 480, false );                     // SMALL PHOTOS
        add_image_size( 'small-cropped', 480, 480, true );              // SMALL PHOTOS (CROPPED)
        add_image_size( 'medium', 800, 800, false );                    // MEDIUM PHOTOS
        add_image_size( 'medium-cropped', 800, 800, true );             // MEDIUM PHOTOS (CROPPED)
        add_image_size( 'large', 1024, 1024, false );                   // LARGE PHOTOS
        add_image_size( 'large-cropped', 1024, 1024, true );            // LARGE PHOTOS (CROPPED)
        add_image_size( 'extra-large', 1200, 1200, false );             // EXTRA LARGE PHOTOS
        add_image_size( 'extra-large-cropped', 1200, 1200, true );      // EXTRA LARGE PHOTOS (CROPPED)
	   
    }

    // ******************************************************************************************************************
    // ADD CUSTOM IMAGE SIZES TO PRESETS MENU
    // ******************************************************************************************************************

    function cysy_custom_image_sizes( $sizes ) {
		
        global $_wp_additional_image_sizes;

        if( empty( $_wp_additional_image_sizes ) ) {
            return $sizes;
        }

        foreach( $_wp_additional_image_sizes as $id => $data ) {

            if( !isset( $sizes[$id] ) ) {
                $sizes[ $id ] = ucwords( str_replace( '-', ' ', $id ) );
            }

        }

        return $sizes;

    }

    add_filter( 'image_size_names_choose', 'cysy_custom_image_sizes' );

    // ******************************************************************************************************************
    // ADDS CYSY_UPDATE_VIEWS() FUNCTION
    // ******************************************************************************************************************
 
	function cysy_update_views( $post_ID ) {
 
        $count_key = 'post_views_count';     
        $count = get_post_meta($post_ID, $count_key, true);
      
        if( $count == '' ) {
            $count = 0;
            delete_post_meta( $post_ID, $count_key );
            add_post_meta( $post_ID, $count_key, '0' );
        } else {
            $count++; 
	        update_post_meta($post_ID, $count_key, $count);
        }
        
	}

    // ******************************************************************************************************************
    // ADDS CYSY_POST_VIEWS() FUNCTION
    // ******************************************************************************************************************
 
    function cysy_post_views( $post_ID ) {
 
        $count_key = 'post_views_count';     
        $count = get_post_meta( $post_ID, $count_key, true );

        if( $count == '1' ) {
            echo $count . ' View';
        } else {
            echo $count . ' Views';
        }
        
    }

    // ******************************************************************************************************************
    // ADDS CYSY_GET_POST_VIEWS() FUNCTION
    // ******************************************************************************************************************

    function cysy_get_post_views( $post_ID ) {

        $count_key = 'post_views_count';
        $count = get_post_meta( $post_ID, $count_key, true );
        return $count;

    }

    // ******************************************************************************************************************
    // ADDS VIEW COUNT COLUMN TO POST SECTION IN DASHBOARD
    // ******************************************************************************************************************
 
    function cysy_post_column_views( $newcolumn ) {

        $newcolumn[ 'post_views' ] = __( 'Views' );
        return $newcolumn;

    }

    function cysy_post_custom_column_views( $column_name, $id ) {

        if( $column_name === 'post_views' ) {
            echo cysy_get_post_views( get_the_ID() );
        }
    }

    add_filter( 'manage_posts_columns', 'cysy_post_column_views' );
    add_action( 'manage_posts_custom_column', 'cysy_post_custom_column_views', 10, 2 );

    // ******************************************************************************************************************
    // WIDGETIZED AREAS
    // ******************************************************************************************************************
	
    // WIDGETIZED AREA 1
    register_sidebar( array(
        'name' => __( 'Widget Area 1', 'Framework' ),
        'id' => 'widget-area-1',
        'description' => __( 'The primary widget area', 'Framework' ),
        'before_widget' => '<div class="widget-area widget-area-1">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );

    // WIDGETIZED AREA 2
    register_sidebar( array(
        'name' => __( 'Widget Area 2', 'Framework' ),
        'id' => 'widget-area-2',
        'description' => __( 'The secondary widget area', 'Framework' ),
        'before_widget' => '<div class="widget-area widget-area-2">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );

    // ******************************************************************************************************************
    // ADDS MENU_ORDER OPTION FOR POSTS
    // ******************************************************************************************************************

    function posts_order() {

        add_post_type_support( 'post', 'page-attributes' );

    }

    add_action( 'admin_init', 'posts_order' );

    // ******************************************************************************************************************
    // CUSTOM SHORTCODE TO ALLOW PHP CONTENT
    // ******************************************************************************************************************

    function php_shortcode( $atts , $content = null ) {
        
        if( strpos( $content, "<" . "?php" ) !== false ) {
        
            ob_start(); eval( "?" . ">" . $content );
            $content = ob_get_contents();
            ob_end_clean();
            
        }
        
        return $content;
        
    }

    add_shortcode( 'php', 'php_shortcode' );

    function shortcodes_to_exempt_from_wptexturize( $shortcodes ) {
        $shortcodes[] = 'php';
        return $shortcodes;
    }

    add_filter( 'no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize' );

    // ******************************************************************************************************************
    // ADD WRAPPER TO WP AUTO-EMBEDED VIDEO IFRAMES  
    // ******************************************************************************************************************


    // ADJUST YOUTUBE PARAMETERS
    function custom_youtube_settings( $url ) {
        
        if( strpos( $url, 'youtu.be' ) !== false || strpos( $url, 'youtube.com' ) !== false ) {
            $parameters = preg_replace( "@src=(['\"])?([^'\">\s]*)@", "src=$1$2&showinfo=0&rel=0&autohide=1", $url );
            return $parameters;
        }

        return $url;
        
    }

    add_filter( 'embed_handler_html', 'custom_youtube_settings' );
    add_filter( 'embed_oembed_html', 'custom_youtube_settings' );

    function custom_embedWrapper( $html, $url, $attr, $post_id ) {

        $post = get_post( $post_id );

        static $wrapper_id = 0;
        $wrapper_id++;

        if( strpos( $html, 'youtube.com' ) !== false || strpos( $html, 'youtu.be' ) !== false ) {
            return '<div class="youtube-wrapper youtube-wrapper-'.$wrapper_id.'">' . $html . '</div>';
        }

        if( strpos( $html, 'vimeo' ) !== false ) {
            return '<div class="vimeo-wrapper vimeo-wrapper-'.$wrapper_id.'">' . $html . '</div>';
        }

        return $html;

    }

    add_filter( 'embed_oembed_html', 'custom_embedWrapper', 10, 4 );


 ?>