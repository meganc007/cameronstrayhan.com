<?
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to framework_comment which is
 * located in the functions.php file.
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */
?>


<? if ( post_password_required() ) { ?>
    <p class="nopassword"><? _e( 'This post is password protected. Enter the password to view any comments.', 'Framework' ); ?></p>
			
<?
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;

} ?>

<? if ( have_comments() ) { ?>

    <h4 id="comments-title">
        <? printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'Framework' ), number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' ); ?>
	</h4>

    <ol class="commentlist">
        <? wp_list_comments( array( 'callback' => 'framework_comment' ) ); ?>
    </ol>

    <? if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<section class="previous_next clear">

				<div class="nav-previous"><? previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'Framework' ) ); ?></div>

				<div class="nav-next"><? next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'Framework' ) ); ?></div>
            
			</section> <!--/PREVIOUS_NEXT-->

    <? endif; ?>

<? } else {

    if ( ! comments_open() ) { ?>
	
        <p class="nocomments"><? _e( 'Comments are closed.', 'Framework' ); ?></p>

    <? } ?>

<? } ?>

<? comment_form(); ?>
