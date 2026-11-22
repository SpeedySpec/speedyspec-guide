<?php
// The fonts folder's paths and URLs, made when asked; deprecated in favour of wp_get_font_dir() when not making it.
function guide_temporary_font_path( $dir ) {
	$dir['path'] = sys_get_temp_dir() . '/guide-fonts';
	return $dir;
}
add_filter( 'font_dir', 'guide_temporary_font_path' );
$dir = wp_font_dir( false );
return $dir['baseurl'];
