<?php
/**
 * The template for displaying search forms in NARGA
 * 
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.0
*/
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="row collapse">
        <label class="hide" for="s"><?php _e('Search for:', 'narga'); ?></label>
        <div class="large-9 small-9 column">
            <input type="text" class="input-text" value="" name="s" placeholder="<?php _e('Search...', 'narga'); ?>">
        </div>
        <div class="large-3 small-3 column">
            <input type="submit" id="searchsubmit" value="<?php _e( 'Search', 'narga' ); ?>" class="button expand postfix">
        </div>
    </div>
</form>
