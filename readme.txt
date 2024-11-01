=== WP Cache Blocks ===
Contributors: wpxue
Donate link: http://www.wpxue.com/donate/
Tags: cache, caching, output caching, cache block, performance,cache blocks, html cache, wp cache
Requires at least: 2.8
Tested up to: 3.0.1
Stable tag: trunk

WP cache blocks  can be cached in any part of the wordpress theme, this plugin will make you site much faster and responsive. Automatically update the cache expired,or Automatically update the cache when you add or updated post/comment.

== Description ==

WP cache blocks  is an extremely efficient WordPress page caching system to make you site much faster and responsive.
WP cache blocks  can be cached in any part of the wordpress theme, Automatically update the cache expired,or Automatically update the cache when you add or updated post/comment.



== Installation ==

1. Upload `wp-cache-blocks` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3.  Edit your theme,you can do like this:



Access the Theme Editor from the Administration > Appearance > Editor menu.

Add cache block areas to the any parts of your theme. 

See below.

<strong>Warning:cache_id must be unique.</strong>

use like this in any template file:

`<?php WPxue_StartCache(cache_id);if(!WPxue_Have_Cached(cache_id)){ ?>
//the content you want to cache
//it can be any code
<?php }	WPxue_EndCache(cache_id);?>`

you can also use like this:


`<?php WPxue_StartCache(cache_id);if(!WPxue_Have_Cached(cache_id)): ?>
//the content you want to cache
//it can be any code
<?php endif; WPxue_EndCache(cache_id);?>`



== Screenshots ==
1. 
2. 

 

== Changelog ==

= 1.0 =
* Initial release.
