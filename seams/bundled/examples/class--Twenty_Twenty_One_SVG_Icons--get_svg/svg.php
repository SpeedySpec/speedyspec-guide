<?php
// The theme's SVG icons, ui and social, given with a size and accessibility attributes; the groups and the social domain map can be filtered.
guide_theme( 'twentytwentyone' );
function guide_add_dot_icon( $icons ) {
	return $icons + array( 'dot' => '<svg viewBox="0 0 1 1"><circle/></svg>' );
}
add_filter( 'twenty_twenty_one_svg_icons_ui', 'guide_add_dot_icon' );
return array( Twenty_Twenty_One_SVG_Icons::get_svg( 'ui', 'dot', 10 ), (fn( $s ) => preg_replace( '/<path.*<\/svg>/s', '…</svg>', $s ))( Twenty_Twenty_One_SVG_Icons::get_social_link_svg( 'https://wordpress.org/x', 20 ) ) );
