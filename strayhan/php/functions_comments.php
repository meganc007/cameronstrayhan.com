<?
/**
 * framework functions and definitions for comments and pingbacks
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */
 
 
/*----------------------------------------------------------------------------------------------------------------------

  FUNCTIONS FOR COMMENTS & PINGBACKS

-------------------------------------------------------------------------------------*/

    // ******************************************************************************************************************
    // MAKE THE COMMENT TEXTAREA NOT REQUIRED
    // ******************************************************************************************************************

    function my_comment_form_defaults($defaults) {

        $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

        return $defaults;

    }

    add_filter('comment_form_defaults', 'my_comment_form_defaults');


    // ******************************************************************************************************************
    // CHANGE THE COMMENT FORM DISCLAIMER TEXT
    // ******************************************************************************************************************

    function cysy_comment_disclaimer_text( $arg ) {

        $arg['comment_notes_before'] = "<p>Required fields are marked *</p>";

        return $arg;

    }

    add_filter( 'comment_form_defaults', 'cysy_comment_disclaimer_text' );


    // ******************************************************************************************************************
    // REMOVES DEFAULT STYLES FOR COMMENTS WIDGET
    // ******************************************************************************************************************

	function framework_remove_recent_comments_style() {
	    global $wp_widget_factory;
	    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	}

	add_action( 'widgets_init', 'framework_remove_recent_comments_style' );

    // ******************************************************************************************************************
    // REMOVE COMMENT WEBSITE FIELD
    // ******************************************************************************************************************

    function cysy_disable_comment_url($fields) { 
        unset($fields['url']);
        return $fields;
    }

    add_filter('comment_form_default_fields','cysy_disable_comment_url');

    // ******************************************************************************************************************
    // ADDS FUNCTIONS FOR COMMENTS AND PINGBACKS
    // ******************************************************************************************************************
 
        if( ! function_exists( 'framework_comment' ) ) {

            function framework_comment( $comment, $args, $depth ) {
	        
		$GLOBALS['comment'] = $comment;

	        switch ( $comment->comment_type ) :

		    case '' : ?>
	
                        <li <? comment_class('clear'); ?> id="li-comment-<? comment_ID(); ?>">

		            <div id="comment-<? comment_ID(); ?>">

			        <div class="avatar-container">
				    <? echo get_avatar( $comment, 150 ); ?>
				</div>

	                        <div class="comment-contents">

				    <div class="comment-author vcard">

				        <cite class="fn"><? echo get_comment_author(); ?></cite>
								
                                    </div> <!-- /COMMENT-AUTHOR VCARD -->

		                    <div class="comment-meta commentmetadata">
                                	
                                        <a href="<? echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			                       		
                                            <?
					        echo get_comment_date('M j');
						$comment_year = get_comment_date('Y');
						$current_year = date('Y');
						if($comment_year != $current_year) { echo ', ' . $comment_year; }
					    ?>

                                	</a>
									
		                    </div> <!-- /COMMENT-META COMMENTMETADATA -->

		                    <div class="comment-body">
									
                                        <? comment_text(); ?>

                                        <? if ( $comment->comment_approved == '0' ) : ?>
			                    		
                                            <em><? _e( 'Your comment is awaiting moderation.', 'Framework' ); ?></em>
		                    		
                                        <? endif; ?>
								
                                   </div>

                                   <div class="edit-reply">
			                    	
                                       <? edit_comment_link( __( 'Edit', 'Framework' ), '', '' ); ?><? comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		                    	
                                   </div> <!-- /EDIT-REPLY -->

                               </div>

	                   </div> <!-- /COMMENT -->
                    
                        </li>

	            <? break;
					
		    case 'pingback'  :
		    case 'trackback' : ?>
	
                        <li class="post pingback clear">

	                    <p><? _e( 'Pingback:', 'Framework' ); ?>
							
                                <? comment_author_link(); ?><? edit_comment_link( __('Edit', 'Framework'), ' ' ); ?>
						
                            </p>
                    
                        </li>
					
                    <? break;
				
                endswitch;

            }

        }

    // ******************************************************************************************************************
    // DISABLE SELF PINGBACKS
    // ******************************************************************************************************************

    function disable_self_ping( &$links ) {
 
        foreach ( $links as $l => $link ) {
            if ( 0 === strpos( $link, get_option( 'home' ) ) ) {
                unset($links[$l]);
            }
	    }
    
    }

    add_action( 'pre_ping', 'disable_self_ping' );
 
 
 
 ?>