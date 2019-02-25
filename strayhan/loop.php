<?
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */
?>

<? if ( ! have_posts() ) : ?>

    <article id="post-0" class="post error404 not-found clear">

        <h1><? _e( 'No Results Found', 'Framework' ); ?></h1>
        <p><? _e( 'Apologies, We weren\'t able to find what you\'re looking for. Perhaps searching will help find a related post.', 'Framework' ); ?></p>
        <? get_search_form(); ?>
	
    </article> <!--/POST-0-->

<? endif; ?>

<? while ( have_posts() ) : the_post(); ?>

    <article id="post-<? the_ID(); ?>" <? post_class('clear'); ?>>

        <div class="post-thumbnail">

            <? if(has_post_thumbnail()) { ?>
    		    <a class="thumbnail-link" href="<? the_permalink(); ?>"><? the_post_thumbnail('thumbnail'); ?></a>
			<? } else { ?>
                <a class="thumbnail-link" href="<? the_permalink(); ?>"><img src="http://via.placeholder.com/240x200?text=No+Thumbnail" /></a>
            <? } ?>

        </div>

        <div class="post-info">

			<h2 class="entry-title"><a href="<? the_permalink(); ?>" title="<? printf( esc_attr__( 'Permalink to %s', 'Framework' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><? the_title(); ?></a></h2>

			<p><? cysy_posted_on(); ?></p>

			<? if(wp_is_mobile()) { ?>
				<? the_excerpt(); ?>
            <? } else { ?>
				<? the_excerpt(); ?>
			<? } ?>
			
            <? cysy_posted_in('categories', 'tags', 'comma'); ?>
			
            <!-- Comments link -->
			<p><? comments_popup_link( __( '<i class="fa fa-comments" aria-hidden="true"></i> Leave a comment', 'Framework' ), __( '<i class="fa fa-comments" aria-hidden="true"></i> 1 Comment', 'Framework' ), __( '<i class="fa fa-comments" aria-hidden="true"></i> % Comments', 'Framework' ) ); ?></p>

        </div>
				
	</article>

<? endwhile; ?> <!--/LOOP-->

<? if ( $wp_query->max_num_pages > 1 ) : ?>

    <div class="prev-next clear">
	
        <div class="prev-next-wrapper">

	        <?
            global $wp_query;
            $big = 999999999; // need an unlikely integer
            echo paginate_links(array(
				'type' => 'plain',
            	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		        'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'mid_size' => 1,
                'prev_text'    => __('&#171; Previous'),
                'next_text'    => __('Next &#187;'),
                'total' => $wp_query->max_num_pages
            ));
            ?>

        </div>

    </div> <!-- /#PREVIOUS_NEXT -->
       
<? endif; ?>