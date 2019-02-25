<?
/**
 * Framework Functions and Definitions
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */
 
/*----------------------------------------------------------------------------------------------------------------------


  NAVIGATION FUNCTIONS


------------------------------------------------------------------------------------------------------------------------*/
 
    // ******************************************************************************************************************
    // REGISTER WP_NAV_MENU LOCATIONS
    // ******************************************************************************************************************
	
    register_nav_menus( array(
        
        'main-navigation' => __( 'Main Navigation', 'Framework' ),
        'footer-navigation' => __( 'Footer Navigation', 'Framework' ),
        
    ) );

    // ******************************************************************************************************************
    // ADDS WP_NAV_MENU WALKER CAPABILITIES
    // ******************************************************************************************************************

    class My_Walker extends Walker_Nav_Menu {

        function start_el( &$output, $item, $depth, $args ) {

            global $wp_query;
            
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : ( array ) $item->classes;

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item) );
            $class_names = ' class="'. esc_attr( $class_names ) . '"';

            $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

            $attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
            $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
            $description = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

            if( $depth != 0 ) {
                $description = $append = $prepend = "";
            }

            $item_output = @$args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= '<span class="menu-item-label">' . @$args->link_before .apply_filters( 'the_title', $item->title, $item->ID ) . '</span>';

            $item_output .= '<span class="menu-item-description">' . $item->description . '</span>';

            $item_output .= @$args->link_after;
            $item_output .= '</a><div id="menu-item-content-'. $item->ID . '" class="menu-item-content">';

            $content = get_post_meta( $item->object_id, 'cysy_wp_nav_menu_html', $single = true );

            if( $content ) {
                $item_output .= '<div id="menu-item-feature-'. $item->ID . '" class="menu-item-feature">'.do_shortcode( "[php] $content [/php]" ).'</div>';
            }

            $item_output .= @$args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, @$args );
            
        }

        function end_el( &$output, $item, $depth, $args ) {

            $indent = str_repeat( "\t", $depth );
            $output .= "</div></li>\n";

        }

        function start_lvl( &$output, $depth = 0, $args = array() ) {

            $indent = str_repeat( "\t", $depth );
            $output .= "\n$indent<ul class='sub-menu'>\n";
            
        }

        function end_lvl( &$output, $depth = 0, $args = array() ) {

            $indent = str_repeat( "\t", $depth );
            $output .= "$indent</ul>\n";
        
        }

    }

    // ******************************************************************************************************************
    // ADDS A HOME LINK TO CUSTOM NAV MENU FALLBACK
    // ******************************************************************************************************************

    function cysy_page_menu_args( $args ) {
    
        $args[ 'show_home' ] = true;
        return $args;
    
    }

    add_filter( 'wp_page_menu_args', 'cysy_page_menu_args' );

    // ******************************************************************************************************************
    // AUTOMATICALLY UPDATES WP_NAV_MENU TO ONLY SHOW ITEMS SET TO 'PUBLISHED'
    // ******************************************************************************************************************

    function cysy_exclude_nav_items( $items, $menu, $args ) {

        global $wpdb;
    
        $allowed_post_types = array('post', 'page');

        $sql = "SELECT ID FROM {$wpdb->prefix}posts WHERE ( post_status = 'draft' OR post_status = 'pending' OR post_status = 'trash' ) AND ID = %d && post_type = %s";

        foreach( $items as $k => $item ) {
    
            if( in_array( $item->object, $allowed_post_types ) ) {
    
                $query = $wpdb->prepare( $sql, $item->object_id, $item->object );
                $result = $wpdb->get_var( $query );
                if( $result ) {
                    unset( $items[ $k ] );
                }
            }
            
        }

        return $items;
        
    }

    add_filter( 'wp_get_nav_menu_items', 'cysy_exclude_nav_items', 10, 3 );







 ?>