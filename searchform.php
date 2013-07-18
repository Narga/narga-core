<?php
/**
* The template for displaying search forms in Narga WordPress Framework
* @package Narga WordPress Framework 
*/
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="row collapse">
        <div class="large-9 small-9 columns">
            <input type="text" class="input-text" value="" name="s" placeholder="<?php _e('Enter your search keywords...', 'narga'); ?>">
        </div>
        <div class="large-3 small-3 columns">
            <input type="submit" id="searchsubmit" value="<?php _e( 'Search', 'narga' ); ?>" class="button expand postfix">
        </div>
    </div>
</form>
