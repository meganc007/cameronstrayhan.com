<?
/**
 * Framework Functions and Definitions
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */
 
/*----------------------------------------------------------------------------------------------------------------------


  MAIN FUNCTIONS


------------------------------------------------------------------------------------------------------------------------*/

    // ******************************************************************************************************************
    // CYSY_GENERATE_TITLE() FUNCTION
    // ******************************************************************************************************************	
 
    function cysy_generate_title() {

        global $title_override;

        if( $title_override ) {
            echo $title_override;
        } else {

            global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' );

            // USE THE BLOG DESCRIPTION FOR THE HOME/FRONT PAGE
            $site_description = get_bloginfo( 'description', 'display' );

            if( $site_description && ( is_home() || is_front_page() ) ) {
                echo " | $site_description";
            }

            // ADD A PAGE NUMBER IF NECESSARY
            if ($paged >= 2 || $page >= 2) {
                echo ' | ' . sprintf( __( 'Page %s', 'framework' ), max( $paged, $page ) );
            }

        }

    }

    // ******************************************************************************************************************
    // REPLACE [...] FROM EXCERPTS WITH A CUSTOM READ MORE LINK
    // ******************************************************************************************************************

    function cysy_auto_excerpt_more( $more ) {
        return '&hellip; <a class="readmore" href="'. get_permalink() . '">' . __( 'Read More', 'Framework' ) . '</a>';
    }

    add_filter( 'excerpt_more', 'cysy_auto_excerpt_more' );

    // ******************************************************************************************************************
    // SET THE EXCERPT LENGTH & ADD CUSTOM CYSY_EXCERPT() FUNCTION
    // ******************************************************************************************************************

    /********************************************************************************************************************
     * To use this function, simply echo it and include optional parameters like so: cysy_excerpt($source, $limit, $string);
     * Example: <? echo cysy_excerpt(get_the_content(), 80, "Read More"); ?>
     ********************************************************************************************************************/

    function cysy_excerpt_length( $length ) {
        return 40;
    }

    add_filter( 'excerpt_length', 'cysy_excerpt_length' );

    function cysy_excerpt( $source = null, $limit = null, $string = null ) {

        if( $source ) {
            $contents = $source;
        } else {
            $contents = get_the_content();
        }

        if( $limit ) {
            $count = $limit;
        } else {
            $count = 500;
        }

        $contents = apply_filters( 'the_content', $contents );
        $contents = preg_replace( "(\[.*?\])",'', $contents );
        $contents = strip_shortcodes( $contents );
        $contents = strip_tags( $contents );
        $permalink = get_permalink();
        $link = '&hellip; <a class="readmore" href="'.$permalink.'">'.$string.'</a>';

        if( strlen( $contents ) > $count ) {
            
            if( $string ) {
                echo substr( $contents, 0, $count ) . $link;
            } else {
                echo substr( $contents, 0, $count ) . '&hellip;';
            }

        } else { 
            echo $contents;
        }
        
    }

    // ******************************************************************************************************************
    // UPDATE NATIVE WP GALLERY SHORTCODE TO USE LIGHTBOX
    // ******************************************************************************************************************

    function cysy_photo_gallery( $attr ) {

        $post = get_post();

        static $instance = 0;
        $instance++;

        if( !empty( $attr[ 'ids' ] ) ) {	
        
            if( empty( $attr[ 'orderby' ] ) )
        
                $attr[ 'orderby' ] = 'post__in';
                $attr[ 'include' ] = $attr[ 'ids' ];
            }
    
            $output = apply_filters( 'post_gallery', '', $attr );
        
        if( $output != '' ) {
            return $output;
        }

        if( isset( $attr[ 'orderby' ] ) ) {
        
            $attr[ 'orderby' ] = sanitize_sql_orderby( $attr[ 'orderby' ] );
            
            if( !$attr[ 'orderby' ] ) {
                unset( $attr[ 'orderby' ] );
            }
        }

        extract( shortcode_atts( array(
            'order'      => 'ASC',
            'orderby'    => 'menu_order ID',
            'id'         => $post->ID,
            'itemtag'    => 'dl',
            'icontag'    => 'dt',
            'captiontag' => 'dd',
            'columns'    => 3,
            'size'       => 'thumbnail',
            'include'    => '',
            'exclude'    => ''
        ), $attr) );

        $id = intval( $id );
        
        if( 'RAND' == $order ) {
            $orderby = 'none';
        }

        if( !empty( $include ) ) {
        
            $_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
            
            $attachments = array();
            
            foreach( $_attachments as $key => $val ) {
                $attachments[ $val->ID ] = $_attachments[ $key ];
            }
            
        } elseif( !empty( $exclude ) ) {
        
            $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
        
        } else {
        
            $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
        
        }

        if( empty( $attachments ) ) {
            return '';
        }

        if( is_feed() ) {
            
            $output = "\n";
        
            foreach ( $attachments as $att_id => $attachment ) {
                $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
            }
            
            return $output;
            
        }

        $itemtag = tag_escape( $itemtag );
        $captiontag = tag_escape( $captiontag );
        $icontag = tag_escape( $icontag );
        $valid_tags = wp_kses_allowed_html( 'post' );
        
        if( !isset( $valid_tags[ $itemtag ] ) ) {
            $itemtag = 'dl';
        }
        if( !isset( $valid_tags[ $captiontag ] ) ) {
            $captiontag = 'dd';
        }
        
        if( !isset( $valid_tags[ $icontag ] ) ) {
            $icontag = 'dt';
        }
        
        $columns = intval( $columns );
        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;

        $selector = "gallery-{$instance}";

        $gallery_style = $gallery_div = '';
        
        if( apply_filters( 'use_default_gallery_style', true ) ) {
            
            /* see gallery_shortcode() in wp-includes/media.php */
            
            $gallery_style  = "<style type='text/css'>";
            
            $gallery_style .= "#{$selector} { margin: auto; }"; 
            $gallery_style .= "#{$selector} .gallery-item { display: inline-block; padding: 0 5px 0 0; text-align: center; margin: 0; width: {$itemwidth}%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }";
  
            $gallery_style .= "#{$selector} .gallery-item { display: inline-block; padding: 0 5px 0 0; text-align: center; width: {$itemwidth}%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }";
        
            $gallery_style .= "#{$selector} .gallery-item-container a { display: block; }";
            $gallery_style .= "#{$selector} .gallery-item-container a img { width: 100%; max-width: auto; }";
            $gallery_style .= "#{$selector} .gallery-caption { margin-left: 0; }";
            $gallery_style .= "</style>";
            
        }

        $size_class = sanitize_html_class( $size );
        $gallery_div = "<div id='$selector' class='gallery page-id-{$id}-gallery gallery-columns-{$columns} gallery-size-{$size_class}'>";
        
        $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

        $i = 0;
        foreach( $attachments as $id => $attachment ) {
            
            $caption = '';
            $thumbsize = $attr[ 'size' ];
            $description = '';
            $link = isset( $attr[ 'link' ] ) && 'file' == $attr[ 'link' ] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false );
            
            $url = isset( $attr[ 'link' ] ) && 'file' == $attr[ 'link' ] ? wp_get_attachment_url( $id ) : wp_get_attachment_url( $id );
            $thumb = isset( $attr[ 'link' ] ) && 'file' == $attr[ 'link' ] ? wp_get_attachment_image_src( $id, $size = $thumbsize, false ) : wp_get_attachment_image_src( $id, $size = $thumbsize, false );
            
            $title = $attachment->post_title;
            $caption = $attachment->post_excerpt;

            if( trim( $caption ) ) {
                $description .= "data-title='";
                $description .= wptexturize( $caption );
                $description .= "'";
            }

            $output .= "<{$itemtag} class='gallery-item'>";
            $output .= "<{$icontag} class='gallery-item-container'>";
            $output .= "<a href='".$url."' data-lightbox='gallery' ".$description."><img src='".$thumb[0]."' alt='".$caption."' /></a>";	
            $output .= "</{$icontag}>";
            $output .= "</{$itemtag}>";

        }

        $output .= "<br style='clear: both;' /></div>\n";

        return $output;

    }

    add_shortcode('gallery', 'cysy_photo_gallery');


    // ******************************************************************************************************************
    // ADDS CYSY_MOST_POPULAR() FUNCTION
    // ******************************************************************************************************************

    /********************************************************************************************************************
     * To use this function, call it in your page template and specify the count and
     * optional thumbnail parameters like so: <? cysy_most_popular(5, true); ?>
     ********************************************************************************************************************/

	function cysy_most_popular($count, $views, $thumbnail = null) {

	    $popular = new WP_Query(array('posts_per_page' => $count, 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'));

	    echo '<ul class="cysy-most-popular">';
		    
	    while ( $popular->have_posts() ) : $popular->the_post();

            $hits = get_post_meta(get_the_ID(), 'post_views_count', true);

		    echo '<li class="cysy-most-popular-item">';

		    if($thumbnail == "true") {
		
		        if(has_post_thumbnail()) {
		            echo '<a class="cysy-most-popular-thumb" href="'.get_the_permalink().'">';
 		            the_post_thumbnail("thumbnail",  array("class" => "graphic"));
		            echo '</a>';
		        } else {
			    echo '<a class="cysy-most-popular-thumb" href="'.get_the_permalink().'">';
 		            echo '<img class="graphic" src="http://via.placeholder.com/880x600?text=No+Thumbnail" alt="'.get_the_title().'" />';
		            echo '</a>';
		        }
		    }

		    echo '<a href="'.get_the_permalink().'">';
            echo get_the_title();
            if($views = "true") {
                echo ' ('.$hits.' Views)';
            }
            echo '</a>';
		    echo '</li>';

	    endwhile;

	    echo '</ul>';

	}

    // ******************************************************************************************************************
    // ADDS CYSY_BUCKET() FUNCTION
    // ******************************************************************************************************************

    /********************************************************************************************************************
     * To use this function, call it in your page template and set the page/post ID
     * and the format ('title', 'content') like so: <? cysy_bucket(10, 'content'); ?>
     ********************************************************************************************************************/

	function cysy_bucket($id = null, $format = null) {

	    $source = get_page($id);

	    if($format == null) {
	  	$format = 'content';
	    }
	    
	    if($format == "title") {
   	        $output = apply_filters('the_title', $source->post_title);
	    }

	    if($format == "content") {
   	        $output = apply_filters('the_content', $source->post_content);
	    }

	    if($format == "thumbnail") {
   	        $output = get_the_post_thumbnail( $source, $size = 'thumbnail' );
	    }

	    if($format == "medium") {
   	        $output = get_the_post_thumbnail( $source, $size = 'medium' );
	    }

	    if($format == "large") {
   	        $output = get_the_post_thumbnail( $source, $size = 'large' );
	    }

	    if($format == "full") {
   	        $output = get_the_post_thumbnail( $source, $size = 'full' );
	    }

	    echo $output;

	}

    // ******************************************************************************************************************
    // ADDS CYSY_IS_RELATIVE() FUNCTION
    // ******************************************************************************************************************

    /********************************************************************************************************************
     * Pass a page/post ID to check if the current page is page X or is a child of
     * page X. Use like so: <? if(cysy_is_relative(12)) { ... } ?>
     ********************************************************************************************************************/

    function cysy_is_relative($page_id) {
	
	global $post;

        if (is_page($page_id) || in_array($page_id, $post->ancestors)) {
            return true;
        } else {
            return false;
        }

    }


    // ******************************************************************************************************************
    // ADDS CYSY_IS_CHILD() FUNCTION
    // ******************************************************************************************************************

    /********************************************************************************************************************
     * Pass a page/post ID to check if the current page is a child of page X.
     * Use like so: <? if(cysy_is_child(8)) { ... } ?>
     ********************************************************************************************************************/

	function cysy_is_child($parent) {

	    global $wp_query;

	    if ($wp_query->post->post_parent == $parent) {
		    $return = true;
	    } else {
		    $return = false;
	    }

	    return $return;

	}

    // ******************************************************************************************************************
    // ADDS CYSY_IS_LAST() FUNCTION
    // ******************************************************************************************************************

    /********************************************************************************************************************
     * Used inside the loop to check if the current item is the last one in the list.
     * Use like so: <? if(cysy_is_last()) { ... } ?>
     ********************************************************************************************************************/

	function cysy_is_last() {

	    global $wp_query;
	    return ($wp_query->current_post == $wp_query->post_count - 1);

	}

    // ******************************************************************************************************************
    // ADDS CYSY_LIST_TAXONOMY() FUNCTION
    // ******************************************************************************************************************

    /********************************************************************************************************************
     * To use this function, add it in your loop and pass it the slug of a taxonomy
     * to get all of the terms. Setting the optional $link parameter to true will make
     * them clickable. Use like so: <? echo cysy_list_taxonomy("amenities", true); ?>
     ********************************************************************************************************************/

	function cysy_list_taxonomy($string, $link = null) {
	
	    $post = get_post($id);
	    $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
	    $terms = wp_get_object_terms($post->ID, $string, $args);
	    $count = count($terms);
	    $base = get_bloginfo('url');
	    $i = 0;
	
	    if ($count > 0) {
    		echo '<span class="'.$string.'-terms">';
    		foreach ($terms as $term) {
        	    $i++;
		        if ($link != 'true') {
    			    $term_list .= $term->name;
		        } else {
			        $term_list .= '<a href="'. $base . '/' . $string . '/' . $term->slug . '" title="' . sprintf(__('View all posts filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a>';
		        }
    		    if ($count != $i) $term_list .= ', '; else $term_list .= '</span>';
    		}
    		echo $term_list;
	    }
	}

    // ******************************************************************************************************************
    // ADDS CYSY_POSTED_ON FUNCTION
    // ******************************************************************************************************************

    /********************************************************************************************************************
	 * To use this function, simply add it in your loop and set any $args separated
     * by a comma like so: <? cysy_posted_on("date", "time", "author"); ?>
     ********************************************************************************************************************/

    if(!function_exists('cysy_posted_on')) {

        function cysy_posted_on() {

            $args = func_get_args();

            $results = '';

            if($args == null) { $array = array('date', 'author'); } else { $array = $args; }

            if(in_array('date', $array)) {

                $results .= '<span class="post-meta post-meta-date">Posted on </span><a href="'.get_permalink().'" title="'.get_the_date().'"><span class="entry-date">'.get_the_date().'</span></a>';
		    
            }

            if(in_array('time', $array)) {

                if(in_array('date', $array)) { $time = ' at '; } else { $time = 'Posted at '; }
		$results .= '<span class="post-meta post-meta-time">'.$time.'</span><a href="'.get_permalink().'" title="'.get_the_time().'"><span class="entry-time">'.get_the_time().'</span></a>';

            }

            if(in_array('author', $array)) {
 
                if(in_array('date', $array) || in_array('time', $array)) { $author = ' by '; } else { $author = 'Posted by '; }
                $results .= '<span class="post-meta post-meta-author">'.$author.'</span> <span class="author vcard"><a class="author-url" href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="View all posts by '.get_the_author().'">'.get_the_author().'</a></span>';

            }

            echo $results;
	   
        }

    }

    // ******************************************************************************************************************
    // ADDS CYSY_POSTED_IN FUNCTION
    // ******************************************************************************************************************

    /********************************************************************************************************************
     * To use this function, simply add it in your loop and set any $args separated
     * by a comma like so: <? cysy_posted_in('categories', 'tags', 'comma'); ?>
     ********************************************************************************************************************/

    if(!function_exists('cysy_posted_in')) {

	function cysy_posted_in() {

            $args = func_get_args();

            $results = '';

            if($args == null) { $array = array('categories', 'tags', 'comma'); } else { $array = $args; }

            if(in_array('comma', $array)) {
                $separator = ', ';
            } elseif(in_array('dash', $array)) {
                $separator = ' - ';
            } elseif(in_array('pipe', $array)) {
                $separator = ' | ';
            } elseif(in_array('bullet', $array)) {
                $separator = ' &bull; ';
            } elseif(in_array('space', $array)) {
                $separator = ' ';
            }

            if(in_array('categories', $array)) {

                $categories = get_the_category();

                $cat_output = '';

                if(!empty($categories)) {

                    $results .= '<div class="posted-in posted-in-categories">';

                    $results .= '<p class="posted-in-label">Categories</p>';

                    foreach($categories as $category) {

                        $cat_output .= '<a class="category-link" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( 'View all posts in %s', 'Framework' ), $category->name ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'Framework' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;

                    }

                    $results .= trim( $cat_output, $separator );

                    $results .= '</div>';

                }		

            }

	    if(in_array('tags', $array)) {

                $posttags = get_the_tags();
                $tag_output = '';

                if(!empty($posttags)) {

                    $results .= '<div class="posted-in posted-in-tags">';

                    $results .= '<p class="posted-in-label">Tags</p>';

                    foreach($posttags as $tag) {

                        $tag_output .= '<a class="tag-link" href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" title="' . esc_attr( sprintf( __( 'View all posts tagged with %s', 'Framework' ), $tag->name ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts tagged with %s', 'Framework' ), $tag->name ) ) . '">' . esc_html( $tag->name ) . '</a>' . $separator;
  			        		
                    }

                    $results .= trim( $tag_output, $separator );

                    $results .= '</div>';

                }		

            }

            echo $results;

        }

    }


 ?>