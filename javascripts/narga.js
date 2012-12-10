/*
 *  Narga JavaScripts Functions created on 08/04/2006, last update on 11/11/2012
 *	Copyright (C) 2003 Dinh Quan Nguyen a.k.a Narga <dinhquan (at) narga (dot) net>
 *	Website:	http://www.narga.net
 *				    http://www.narga.org
 *
 *	You are allowed to use this software in any way you want providing:
 *		1. You must retain this copyright notice at all time
 *		2. You must not claim that you or any other third party is the author of this software in any way.
 *		3. Feedback to me (dinhquan@narga.net) when you use my scripts, I will add you to customer list!
 *		4. The CSS, XHTML, JS and design is released under GPL: http://www.opensource.org/licenses/gpl-license.php
 */
/* <![CDATA[ */
jQuery(window).load(function() {
  jQuery('#narga-orbit-slider').orbit({
  animation: 'fade',                  // fade, horizontal-slide, vertical-slide, horizontal-push
  animationSpeed: 800,                // how fast animtions are
  timer: true,                        // true or false to have the timer
  resetTimerOnClick: false,           // true resets the timer instead of pausing slideshow progress
  advanceSpeed: 4000,                 // if timer is enabled, time between transitions
  pauseOnHover: false,                // if you hover pauses the slider
  startClockOnMouseOut: false,        // if clock should start on MouseOut
  startClockOnMouseOutAfter: 1000,    // how long after MouseOut should the timer start again
  directionalNav: true,               // manual advancing directional navs
  captions: true,                     // do you want captions?
  captionAnimation: 'fade',           // fade, slideOpen, none
  captionAnimationSpeed: 800,         // if so how quickly should they animate in
  bullets: false,                     // true or false to activate the bullet navigation
  bulletThumbs: false,                // thumbnails for the bullets
  bulletThumbLocation: '',            // location from this file where thumbs will be
  afterSlideChange: function(){},     // empty function
  fluid: true                         // or set a aspect ratio for content slides (ex: '4x3')
});
});
jQuery(document).ready(function() {
//  Quick Reply for Threaded Comments
addComment={moveForm:function(d,f,i,c){var m=this,a,h=m.I(d),b=m.I(i),l=m.I("cancel-comment-reply-link"),j=m.I("comment_parent"),k=m.I("comment_post_ID");if(!h||!b||!l||!j){return}m.respondId=i;c=c||false;if(!m.I("wp-temp-form-div")){a=document.createElement("div");a.id="wp-temp-form-div";a.style.display="none";b.parentNode.insertBefore(a,b)}h.parentNode.insertBefore(b,h.nextSibling);if(k&&c){k.value=c}j.value=f;l.style.display="";l.onclick=function(){var n=addComment,e=n.I("wp-temp-form-div"),o=n.I(n.respondId);if(!e||!o){return}n.I("comment_parent").value="0";e.parentNode.insertBefore(o,e);e.parentNode.removeChild(e);this.style.display="none";this.onclick=null;return false};try{m.I("comment").focus()}catch(g){}return false},I:function(a){return document.getElementById(a)}};
})

/* ]]> */
