<?php
// Adds the font CSS for the site's language to the theme style, for languages that need other fonts; on wp_enqueue_scripts.
guide_theme( 'twentytwenty' );
twentytwenty_register_styles();
add_filter( 'locale', fn() => 'ko_KR' );
twentytwenty_non_latin_languages();
$after = (array) wp_styles()->get_data( 'twentytwenty-style', 'after' );
return substr( end( $after ), -70 );
