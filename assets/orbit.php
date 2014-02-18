<?php
/**
 * Orbit Slider as Featured Post
 * Function to render orbit slide based on featured category and number of slide in Customize.
 *
 * @since NARGA v1.1
 */
if (!function_exists('narga_orbit_slider')) :  
    function narga_orbit_slider() {
        echo '<div class="orbit-container">
            <ul data-orbit data-options="bullets:false;';
        if (narga_options('resume_on_mouseout') == 1) :
            echo 'resume_on_mouseout: true.;';
        endif;
        echo '">';
        $args = array(
            'showposts' => narga_options('number_slide'),
            'post_type' => 'any',
            'cat' => narga_options('featured_category'),
        );
        $narga_slider_query = new WP_Query($args);
        while ($narga_slider_query->have_posts()) : $narga_slider_query->the_post();
        if(has_post_thumbnail()) {
            $number = 1; $number = $number++;
            echo '
                <li>';
            the_post_thumbnail('post-thumbnail', array( 'alt' => get_the_title(), 'title' => get_the_title(), 'data-caption' => '#htmlCaption-'.$narga_slider_query->current_post,));
            echo '
                <div class="orbit-caption"><h3><a href="' . get_permalink(). '" ' . 'title="' . get_the_title() . '">' . get_the_title(). '</a></h3></div></li>' . "\n";
        } elseif (! has_post_thumbnail() && (narga_options('default_slides_image') == '1') ) {
            echo '
                <li><img width="640" height="290" src="' . get_template_directory_uri() . '/images/default-slide-image.png" class="attachment-post-thumbnail wp-post-image" alt="' . get_the_title() . '" title="' . get_the_title() . '" data-caption="#htmlCaption-' .$narga_slider_query->current_post . '" />';
            echo '
            <div class="orbit-caption"><h3><a href="' . get_permalink(). '" ' . 'title="' . get_the_title() . '">' . get_the_title(). '</a></h3></div></li>' . "\n";
         } else echo '';
endwhile;
echo '</ul>';
if (narga_options('slide_indicator') == 1) :
    $i = 1;
    echo '<ol class="orbit-bullets">';
    if ( narga_options('default_slides_image') == '1' ) :
        for($i; $i <= narga_options('number_slide'); $i++) {
            echo '<li data-orbit-slide-number="' . $i . '"></li>';
        }
    elseif ( narga_options('default_slides_image') == '0' ) :
        for($i; $i <= $number+2; $i++) {
            echo '<li data-orbit-slide-number="' . $i . '"></li>';
        }
    endif;
    echo '</ol>';
endif;
echo '</div>';
    }
endif;

?>
