<?php
// A post date as ISO 8601 in the site's timezone, or in GMT, falling back to the local date when the GMT one is missing.
function guide_tokyo_timezone( $pre ) {
	return 'Asia/Tokyo';
}
add_filter( 'pre_option_timezone_string', 'guide_tokyo_timezone' );
guide_core_abilities();
$content = new WP_Abilities_Content();
$post = new WP_Post( (object) array( 'ID' => 1, 'post_date' => '2026-01-02 12:00:00', 'post_date_gmt' => '0000-00-00 00:00:00', 'filter' => 'raw' ) );
return array( guide_private( $content, 'format_date', $post, 'date', false ), guide_private( $content, 'format_date', $post, 'date', true ) );
