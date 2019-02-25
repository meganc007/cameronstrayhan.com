<?
/**
 * The template for displaying search forms in CYSY Framework
 *
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'framework' ); ?></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'framework' ); ?>" />
		<button type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'framework' ); ?>"><i class="fa fa-search" aria-hidden="true"></i></button>
	</form>
