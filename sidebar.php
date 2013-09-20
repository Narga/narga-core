<?php
/**
* The sidebar containing the main widget area.
*
* If no active widgets in sidebar, let's hide it completely.
*
* @package WordPress
* @subpackage NARGA Framework
* @since NARGA Framework 1.0
*/
?>
<!-- sidebar -->
<div class="large-4 column">
    <aside class="sidebar" role="complementary">
    <?php dynamic_sidebar("Sidebar"); ?>
    </aside>
</div>
<!-- /sidebar -->
