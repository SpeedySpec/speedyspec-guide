<?php
// Finds a script's translation file from its source URL and loads it; a source outside the site gives false. load_script_textdomain_relative_path filters the relative path.
switch_to_locale( 'fr_FR' );
$file = WP_LANG_DIR . '/plugins/guide-fr_FR-' . md5( 'js/guide.js' ) . '.json';
file_put_contents( $file, '{"locale_data":{}}' );
function guide_print_relative_path( $relative, $src ) {
	echo "relative $relative\n";
	return $relative;
}
add_filter( 'load_script_textdomain_relative_path', 'guide_print_relative_path', 10, 2 );
$found = _load_script_textdomain_from_src( 'guide-js', 'http://example.org/wp-content/plugins/guide/js/guide.js', 'guide', '', false );
unlink( $file );
return array( $found, _load_script_textdomain_from_src( 'x', 'https://cdn.example.com/x.js', 'guide', '', false ) );
