<?php
// A theme's block patterns from its patterns folder, by file with their headers (title, slug, categories, keywords and the rest), cached for the theme's version.
$patterns = wp_get_theme( 'twentytwentyfive' )->get_block_patterns();
$first = reset( $patterns );
return array( count( $patterns ) > 10, array_keys( $first ) );
