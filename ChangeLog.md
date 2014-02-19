# NARGA ChangeLog

The content of this file will be list all the tasks has done. I will update it after the newest version released.

## TODO
* Google Font chooser
* Icon webfont
* Integrate Theme Documents
* SASS

## v2.0 - February 18th, 2014
* Update Zurb Foundation v5.1.1 and update styles, scripts path and version information
* Remove Custom Post Excerpt for better performance and useless
* Move all Orbit functions to assets/orbit.php
* Allow user can use Custom Logo instead Text Site Title
* Re-position of Customization Settings: Move Custom Readmore Text to Post Settings

## v1.9 - November 30th, 2013
* Update Zurb Foundation 5.0.2
* Topbar search form only show on medium screen size and up
* Add default.po to help translator.
* Add Pauses Featured Slider while hovering option.

## v1.8 - November 25th, 2013
* Now NARGA is using Zurb Foundation 5
* Remove addition Google Fonts, use Open Sans like default in Foundation 5.
* Update all file information in comment section. Add Right to Left Style file (content add late)
* Change theme folder name from narga-core to narga
* Move all cleanup functions to cleanup.php file, recode all cleanup functions to help maintain in future. Rearranged files, functions follow Underscores starter theme.
* Fix Orbit selector algorithm problem, incorrect value in customization to display post meta information.
* Fix missing media type of css file that enqueue by WordPress.
* Enhanced Topbar function, navigation search form.
* Update scripts, styles version, remove unuse items, minor changed in main stylesheet to compatible with new version.


### v1.7 - October 10th, 2013
* Add options to force display excerpt instead content on front page. User can define the custom length of excerpt and it counts by words. Set it as 0 mean disable this feature. Optimize Cutomizer custom control class
* Change HTML structure of sidebar.php for friendly with child theme. Change sidebar widget title to h3 headline
* Change some function comment. Fix some minor bugs and style. Remove readme.txt
* Add Posts Settings section to allow user can show or hide post features likes post meta, tags ... Move option to show breadcrumb to Post Settings, add option to show or hide post navigation, author information, post meta
* Add option to use built in default image for post without featured image. Default on
* Fix change sidebar position preview.

### v1.6 - September 18th, 2013
* Combine & re-order options in Customization. Add Customize Preview reload function. Add options to custom Read more link text, change sidebar position.
* Add custom favicon feature. Change HTML5 conditional to Header extra, it's contain addition components
* Change Orbit caption text to h3
* Remove unused features of CSS Framework to decrease the size of javascript & stylesheet files. List all Foundation features that supported in current NARGA.


### v1.5.1 - September 04th, 2013
* Fix Edge Case Long Text bug
* Fix Custom Header feature can't hide header text, user can choose display between header text & header image or both. Add `assets/custom-header.php` file
* Change default slides image.
* Minor bugs fixed

### v1.5 - August 30th, 2013
* NARGA Framework now named as NARGA WordPress theme, shortname is NARGA. Change new screenshot.png
* Complete rewrite README file, change description in style.css. Addition information in Customization Panel.
* Footer: Fix Search form text cut-off when it placed on Footer Widge area. Add function to count active footer widgets to help display widgets flexibly. Improve footer HTML structure.
* Add fallback function to top bar, it's appear if a given top bar is empty. Remove right top bar menu because it's useless
* Custom hearder support, it works as logo
* Change position of post navigation, add some CSS selectors to author box, improve Clearing Float.
* Orbit Sliders change to Featured Post Sliders, add condition to show default image slider if featured post was not given featured image.
* Minor bugs fixed & improve some features: pagination, CSS style

### v1.4.1.2 - August 09th, 2013
* Upgrade ZURB Foundation to  v4.3.1
* Update NargaTopbarWalker class to compatible with WordPress 3.6
* Add /assets/jetpack.php to support infinity scroll function of JetPack plugin
* Remove bloat information in style.css, footer.php, remove iOS icon, robot.txt
* Change the way to load jQuery and styles
* Clean code and fix some minor style problem.

### v1.4.0 - July 19th, 2013
* Complete fix Clearing Float
* Enqueue Zepto by function
* Clean Readme.md file; remove bloat code in functions.php, small change in footer. Remove jQuery library by using WordPress build-in.

### v1.3.9 - July 18th, 2013
* Fix Image Clearing Float on page, add single image attachment template.
* Remove integrate.php & shortcodes.php because they are plugin territory, implement to Pro Pack in future. Remove information in Readme file, move function that removes the extra 10px of width from wp-caption and changes to HTML5 figure/figcaption.
* Remove zepto script in footer when using build-in WordPress jQuery
* Minor bugs fixed: home_url needs escaping in searchform.php, rename custom query name in Orbit function, narga_assets function now hooked correctly

### v1.3.8 - June 20th, 2013
* Compress zepto.js to zepto.min.js, compresstion all image files
* Optimize shortcode function to load addition javascript files asynchronous
* Add option to allow user hide Top Bar Title.
* Not display 'comments are closed' on page with comment disabled.
* Fix images clear float and content/sidebar overlap.
* Add .no-border, .alignnone CSS selector

### v1.3.7 - June 11st, 2013
* Add Google Adsense shortcode
* Add Integration Services Options that's allow user integrate Google Analytics, Google Webmaster Tools, Yahoo Site, Bing Site, Alexa Verification ...
* Fix jQuery library not load by default
* Minor bugs fix

### v1.3.6 - June 05th, 2013
* Remove duplicate navigation in search result page
* Change theme-customizer.php to customizer.php
* Change some CSS selector of layout
* README file edited
* Refactoring Customize function, class, options for control theme options easier. Allow Customize text strings translable.
* Rewrite Top Bar function to render with more options: sticky, contain to grid... move all Top Bar function to standalone file.
* Fix archive template to display tags, category, archive
* Optimize header.php, orbit slide, add slider indicator

### v1.3.5 - May 20th, 2013
* Add breadcrumbs function and display on category, single, page
* Fix important bugs when remove Post Thumbnails function
* Improve layout and fixed bugs
* Add TODO section to implement in future

### v1.3.4 - May 8th, 2013
* Update ZURB Foundation v4.1.6
* Remove unused Post Thumbnail Control function
* Remove default entry title font size
* Add more CSS selectors to comment list
* Remove some shortcodes which is un-compatible with ZURB Foundation v4.1.6
* Change order of javascript files when page loading
* Improve style and fixed bugs

### v1.3.3 - May 3rd, 2013
* Upgrade ZURB Foundation v4.1.5
* Update README file for more compatible with GPL, remove others content, script which is not compatible with GPL, add Shortcode manual
* Remove custom function that replace default jQuery library by Google jQuery, it's planning re-add in future as a option in Customization
* Change the way to load default stylesheet style.css, in previous version it's loading duplicate in function.php and header.php
* Fix Image Clear Float
* Add post navigation to drive user to previous or next post
* Fix topbar navigation height
* Beautifier CSS code in style.css to easier viewing and edititng.
* Remove default body font for child theme
* Re-struture comments list
* Fix some Internationalization strings
* Remove Secondary Menu as Widgetable on sidebar because it's useless, re-add if I receive any requests
* Temporate remove audio post format until WordPress v3.6 was released, fix Video Post Format distorted
* Add function to change content width on full-width template
* Remove comment form submit button style, remove .bypostauthor style for more customizable in child theme
* Remove unused codes, fix some minor bugs

### v1.3.1 - March 23rd, 2013
* Add footer widgets
* Change CSS selectors for more flexible layout, remove and rewrite some in style.css
* Fix posts and comments pagination function compatible with Foundation 4
* Fix some un-translatable text (more will come when I found it)
* Fix head function to display correctly HTML

### v1.3 - March 22nd, 2013
* Update ZURB Foundation v4.0.9, jQuery v1.9.1, change content width to 690px
* Clean topbar search form, change template CSS class to work with ZURB Foundation 4
* Add footer navigation menu.
* Rewrite orbit function to compatible with ZURB Foundation 4
* Remove automatic add odd and even class per post. Remove Customizer and useless functions. Remove Video post format defined file, add post format label.
* Localization in footer, fix some un-translatable text.
* Add author information box below post content in single post. Fix post tags disapppear from previous version.
* Optimize and remove unused codes

### v1.2.6 - February 24th, 2013
* Prefix all class, functions, namespace with narga
* Remove PressTrends function to prevent it phones home, follow Theme Review Wiki Guide
* Fix typo in alert shortcode, remove favicon to allow child theme use user-defined icon 

### v1.2.5 - February 1st, 2013
* Update ZURB Foundation v3.2.5
* Fix sticky class conflict with ZURB Foundation Topbar
* Rewrite loop functions to display sticky post and normal post seperator
* Add twentytwelve title function to get blog title nicely formated

### v1.2.4 - January 12nd, 2013
* Fix Google+ button syntax
* Change main HTML5 structure to improved CSS selectors, not really effect to current child themes
* Register Theme Customizer Link to WordPress Dashboard for access more easier
* Fix localization strings, add comment pagination function, improved homepage pagination function
* Remove unused and optimized codes, move PressTrends function to functions.php instead /assets/theme-customization.php

### v1.2.3 - January 04th, 2013
* Change license from Creative Common License to GPL v2
* Update LICENSE, README files
* Add CSS selector to archive and category template part
* Remove duplicate codes in header

### v1.2.2 - January 02nd, 2013
* Change comment navigation link to pagination link
* Change default option of theme's background support
* Load Google jQuery as default instead local jQuery and allow load local jQuery when it's unreachable
* Remove unused codes and fix some minor bugs

### v1.2.1 - December 27th, 2012
* Complete rewrite loop content function
* Fully support WordPress Post Format and allow user can styling it
* Remove old loop files
* Optimize 404 page, archive page, search result, category templates
* Improve audio5 shortcode, combine and rewrite comment addition action for administrator, rewrite entry meta information function
* Fix grid post thumbnail on single page
* Some minor bugs fix and add more information to template files

### v1.1.1 - December 25th, 2012
* Use twentytwelve gallery style
* Rewrite select featured category function
* Add more theme description and optimize style.css
* Some minor bugs fix

### v1.1.0 - December 24th, 2012
* Remove Custom Taxonomy Control for the Theme Customizer Class then write new function to list featured category.
* Clean, remove unused codes to compatible with WordPress Theme Standard
* Use default comment form function, move custom comments list function to functions.php, define new style for submit button.
* Enables post and comment RSS feed links to head
* Set theme tags in style.css
* Increase screenshot.png size to 600x450
* Alias README.md as readme.txt

### v1.0.5 - December 20th, 2012
* Change CSS style to justify all text in content section
* Change to new brand icon
* Add more CSS selectors to help users control the layout easier
* Optimize the post loop on the homepage
* Temporate remove post formats to fix the layout, it'll re-add late
* Update Readme file, move all source codes to BitBucket repository, re-write HTML codes for valid with HTML5 Validator
* Fix strange layout errors, clean unused codes
* The first released

### v1.0.3 - December 13rd, 2012
* Optimize layout for compatible with HTML5, fix Orbit layout and position
* Fix typo bugs of orbit function
* Rewrite Textare Control Class for theme customization
* Change the way to load pro and custom functions in assets folder
* Fix wrapper problem on small screen devices
* Clean some unused codes

### v1.0.2 - December 10th, 2012
* Fix fatal bugs in orbit slide function can not generate images list by category. Re-position of orbit slider. Change default slide images to 805x360 to fit the default layout.
* Fix figure border when hover the mouse, make images with figure responsive
* Fix position of sidebar.
* Remove Primary Navigation and plan to add it late with ZURB Drop-Down Menu
* Add function to generate blog name and subheader for custom as users want without copy the header.php file in child theme. User can upload their own logo in the future.
* Add GitHub Gist, Video5, Audio5 shortcodes
* Add theme's image: screenshot.png

### v1.0.1 - December 6th, 2012
* Add function to load jQuery library if Google CND not reachable
* Add functions to load pro functions, custom functions, custom css if it exists in uploads folder and child theme folder.
* Add ChangeLog file (this file) to logging the changes.
* Rewrite IE conditional HTML5
* Fix fatal bug to load external style from child theme when it's available


