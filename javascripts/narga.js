/*
 *  Narga Functions
 *	Copyright (C) 2013 Dinh Quan Nguyen a.k.a Narga <dinhquan (at) narga (dot) net>, NARGA - http://www.narga.net
 *	Free to use under GPL: http://www.opensource.org/licenses/gpl-license.php
 */

/* <![CDATA[ */
//  Quick Reply for Threaded Comments
addComment={moveForm:function(d,f,i,c){var m=this,a,h=m.I(d),b=m.I(i),l=m.I("cancel-comment-reply-link"),j=m.I("comment_parent"),k=m.I("comment_post_ID");if(!h||!b||!l||!j){return}m.respondId=i;c=c||false;if(!m.I("wp-temp-form-div")){a=document.createElement("div");a.id="wp-temp-form-div";a.style.display="none";b.parentNode.insertBefore(a,b)}h.parentNode.insertBefore(b,h.nextSibling);if(k&&c){k.value=c}j.value=f;l.style.display="";l.onclick=function(){var n=addComment,e=n.I("wp-temp-form-div"),o=n.I(n.respondId);if(!e||!o){return}n.I("comment_parent").value="0";e.parentNode.insertBefore(o,e);e.parentNode.removeChild(e);this.style.display="none";this.onclick=null;return false};try{m.I("comment").focus()}catch(g){}return false},I:function(a){return document.getElementById(a)}};

jQuery(document).foundation();

jQuery(".section").mouseenter(function() {
    jQuery(this).toggleClass("active");
}).mouseleave(function() {
    jQuery(this).removeClass("active");
      return false; // Prevents further propagation of event
});
/* ]]> */
