<?php
// Adds the font CSS for the site's language to the theme style, for languages that need other fonts; on wp_enqueue_scripts.
guide_theme( 'twentytwenty' );
twentytwenty_register_styles();
function guide_korean_locale( $locale ) {
	return 'ko_KR';
}
add_filter( 'locale', 'guide_korean_locale' );
twentytwenty_non_latin_languages();
$after = (array) wp_styles()->get_data( 'twentytwenty-style', 'after' );
return substr( end( $after ), -70 );
