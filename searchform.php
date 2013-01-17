<?php
/**
 * The template for displaying search forms in Narga WordPress Framework
 * @package Narga WordPress Framework 
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
<div class="row collapse">
  <div class="nine mobile-three columns">
    <input type="text" class="input-text" value="" name="s" placeholder="<?php _e('Enter your search keywords...', 'narga'); ?>">
  </div>
  <div class="three mobile-one columns">
    <input type="submit" id="searchsubmit" value="Search" class="button expand postfix">
  </div>
</div>

