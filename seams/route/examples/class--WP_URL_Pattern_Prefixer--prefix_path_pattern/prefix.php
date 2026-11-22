<?php
// Prefixes a path pattern with the base path of a context (home, site, uploads, content, plugins, template, stylesheet), unless it already has it; special characters in the base are escaped.
function guide_home_with_plus() {
	return 'http://example.org/blog+1';
}
add_filter( 'pre_option_home', 'guide_home_with_plus', 20 );
$prefixer = new WP_URL_Pattern_Prefixer();
return array( $prefixer->prefix_path_pattern( '/a/*' ), $prefixer->prefix_path_pattern( '/blog\\+1/a/*' ), $prefixer->prefix_path_pattern( '/x', 'content' ), $prefixer->prefix_path_pattern( '/x', 'nope' ), array_keys( WP_URL_Pattern_Prefixer::get_default_contexts() ), Closure::bind( fn() => self::escape_pattern_string( 'a+b(c)*' ), null, WP_URL_Pattern_Prefixer::class )() );
