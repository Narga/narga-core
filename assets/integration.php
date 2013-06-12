<?php
/**
 * Include the Google Analytics Tracking Code (ga.js)
 * @ http://code.google.com/apis/analytics/docs/tracking/asyncUsageGuide.html
 * @since NARGA 1.3.5
 */
if (!function_exists('narga_google_analytics')) :
function narga_google_analytics(){
    if (narga_options('google_analytics') != '' )
        echo '<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push([\'_setAccount\', \'' . narga_options('google_analytics') . '\']);
		  _gaq.push([\'_trackPageview\']);

		  (function() {
		    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
		    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
		    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>';
}

add_action('wp_footer', 'narga_google_analytics');
endif;

/**
 * Verification Code of Webmaster Tool, Bing Site, Yahoo, Site ...
 *
 * @since NARGA 1.3.5
 */
if (!function_exists('narga_services_verification')) :
function narga_services_verification(){
    if (narga_options('google_site') != '' )
        echo '<meta name="google-site-verification" content="' . narga_options('google_site') . '" />';

    if (narga_options('bing_site') != '' )
        echo '<meta name="msvalidate.01" content="' . narga_options('bing_site') . '" />';
        
    if (narga_options('yahoo_site') != '' )
        echo '<meta name="y_key" content="' . narga_options('yahoo_site') . '" />';

    if (narga_options('alexa_site') != '' )
        echo '<meta name="alexaVerifyID" content="' . narga_options('alexa_site') . '" />';
}

add_action('wp_head', 'narga_services_verification');
endif;

?>
