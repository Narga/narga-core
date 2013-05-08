Introduction
====================
NARGA Framework is an extremely versatile HTML5 & CSS3 WordPress framework based on ZURB's [Foundation](http://foundation.zurb.com), a powerful tool for building prototypes on any kind of devices. It'll help you do amazing things faster & easier than ever before. Along with the elegant design the theme is easily customizable with numerous theme options through Theme Customization. This Framework follows [HTML5 Boilerplate](http://html5boilerplate.com) standard with the layout grid inspired by ZURB Foundation Templates and is [hNews microformat](https://www.readability.com/publishers/guidelines) ready. It is optimized for Search Engine while at the same time improves readability.

Because it's a percentage based grid system, it means that it will perfectly adapt to all screen resolutions (mobile, tablets and big screens). It is extremely easy to create your blog, CMS, brochure and any other kind of sites with NARGA Framework.

I've tested and found that NARGA Framework works well with [bbPress 2.0](http://bbpress.org/) and [BuddyPress 1.5](http://buddypress.org/) but this time it's not official compatible with them.

###Links of NARGA Framework###
* Homepage:         [http://www.narga.net/narga-core][6]
* Demo:             [http://www.narga.net/narga-core-demo][3]
* Forum:            [http://www.narga.net/forum/][1]
* BitBucket:        [https://bitbucket.org/narga/narga-core][8]
* GitHub            [https://github.com/narga/narga-core]

###Learn more about Foundation###
* [Foundation Homepage](http://foundation.zurb.com)
* [Foundation Documentation](http://foundation.zurb.com/docs)
* [Foundation GitHub](https://github.com/zurb/foundation)

What are the Features?
======================
NARGA Framework inherits all the cool features from Foundation, and packs with several other interesting features to optimize the experience for WordPress and HTML5. 

###Support Features###
* HTML5 Boilerplate standard and is hNews microformat ready.
* Optimized for SEO.
* Inspired from ZURB Foundation Templates for better WordPress practice.
* Basic CSS included, you can also use it as a finished theme.
* Foundation files are separate, you can update Foundation without any problems. Of course, is is always a good idea to have some backups.
* Support child themes, all parent functions can replace in functions.php.

###WordPress Features###
* Fully compatible with WordPress v3.4+ Theme Customizer features. It's also named as NARGA Framework Options Panel
* Clean image HTML output for TinyMCE, only class and alt are returned. Post title will be automatically used for alt.
* Custom menu output for ZURB's
* Custom caption output for HTML5 figure and figcaption tags.
* Custom filter for images, will automatically wrap images with figure tag.
* Two Widget: sidebar and footer.
* Two menus: top bar fixed navigation menu and information menu on sidebar.
* Several custom page templates are included in the package. A folder named custom is used for storing all your custom page templates. You can share your custom templates in the forum.
* Looks good but what if you don't need these features? Sure, you can turn them off.

Usage
=====
Download NARGA Framework then install it on your local WordPress or real website.

This is meant to be a base theme for WordPress custom theme development. A knowledge of WordPress theme development practices as well as understanding of HTML, CSS/LESS, jQuery and PHP are required.

Always get update by clone this repository:

``git clone git@github.com:Narga/narga-core.git
``

* Extract narga-core.zip and upload the theme folder via FTP to your wp-content/themes/ directory.
* Go to your WordPress Admin Dashboard > Appearance > Themes and select the NARGA screenshot.
* Use Live Preview of NARGA Framework to change the options before active.
* Make your own child theme with highly customizable functions from this framework

Shortcodes
=========
I've converted almost main ZURB Foundation functions to shortcodes. That’s why the decision is up to you – you either install our shortcode plugins designed to work with themes using Foundation CSS & JS or you don’t. It’s that easy!

***Alert Box Shortcode***

The [alert]…[/alert] shortcode gives you and your editors and easy way to display the [Foundation Alerts][http://foundation.zurb.com/old-docs/f3/elements.php#alertsEx] with some additional options.

_Shortcode options_

[alert]…[/alert] // no options

[alert type=alert]…[/alert] // type attribute alert

[alert type=success]…[/alert] // type attribute success

[alert type=secondary]…[/alert] // type attribute secondary

[alert close=no]…[/alert] // no close button

[alert timeout=10000]…[/alert] // timeout of 10s

***Columns Shortcodes***

One of the best features of Foundation is the powerful grid it offers, used throughout required+ Foundation. We took the grid and turned it into an easy and powerful shortcode plugin, meet [column]:

// The first example
[column columns=4]…[/column][column columns=8]…[/column]

// The second example
[column columns=3]…[/column][column columns=6]…[/column][column columns=3]…[/column]

// The third example (note the offset attribute)
[column columns=6 offset=3]…[/column][column columns=3]…[/column]


***Button Shortcode***

Easy to add a button with pre-define shortcodes

[button]…[/button] // no options

[alert style=secondary/alert/success]…[/alert] // style of buttons

[alert type=radius/round]…[/alert] // type of buttons

***Panel Shortcode***

A panel is a simple, helpful Foundation component that enables you to outline sections of your page easily. 

[panel][/panel]

***Tabular shortcode***

Okay, they're not the sexiest things ever, but tables get the job done (for tabular data, of course).

[tabs] [tab][/tab] [/tabs]

***Hide/Show Shortcode***

_Show block_

[show][/show]

_Hide block_

[hide][/hide]

***Reveal Shortcode***

Simple modal windows to create an even more stunning experience for users.

[reveal link="Link text" linkclass="button radius alert"]
…
[=reveal link="Link text" linkclass="button radius secondary"]
…
[=/reveal]
[/reveal]

***HTML5 Audio player***

Converts audio5 shortcode to HTML5 audio tag

[audio5 src="http://yoursite.com/upload-folder/filename.mp3" loop="true" autoplay="autoplay" preload="auto" loop="loop" controls=""]

***HTML5 Video player***

Converts video5 shortcode to HTML5 video tag

[video5 src="http://yoursite.com/upload-folder/filename.mp4" ontrols=""]

***Social Media buttons***

_Twitter button shortcode_

[t related='NARGA Framework - A rock solid starting WordPress HTML5 theme for developers' countbox='horizontal/vertical' via='narga' ]

_Facebook Like button shortcode_

[fb  send='true' action='recommend' layout='button_count/box_count']

_Google Plus button shortcode_

[gp size='small/medium/tall']

***GitHub Gist shortcode***

Display GitHub Gist with shortcode without raw HTML embed

[gist id="ID" file="FILE"]

License
=======

[GNU General Public License][4]

NARGA Framework by [Nguyễn Đình Quân][2] is licensed under a [GNU General Public License][4].

Permissions beyond the scope of this license may be available at [NARGA Proprietary Use License][7].

Ownership
=========
You may not claim intellectual or exclusive ownership of any of our products, modified or unmodified. All products are property of [Narga][2] and their respective designers. Our products are provided “as is” without warranty of any kind, either expressed or implied. In no event shall we be liable for any damages including, but not limited to, direct, indirect, special, incidental or consequential damages or other losses arising out of the use of or inability to use our products.

Also if you intend to use the **NARGA Framework** in a commercial project, or a template you intend to redistribute in any form, please retain a "[Powered by Narga][2]" logo and link in the backend administrative interface.

 [1]: http://www.narga.net/forum/
 [2]: http://www.narga.net/
 [3]: http://www.narga.net/narga-core-demo
 [4]: http://www.gnu.org/licenses/gpl-2.0.html
 [5]: http://www.narga.net/contact/
 [6]: http://www.narga.net/narga-core
 [7]: http://www.narga.net/terms
 [8]: https://bitbucket.org/narga/narga-core
