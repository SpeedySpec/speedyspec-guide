<?php
// Sorts themes by name, translated or not, in place.
$themes = array( wp_get_theme( 'twentytwentyone' ), wp_get_theme( 'twentyten' ), wp_get_theme( 'twentyeleven' ) );
WP_Theme::sort_by_name( $themes );
return array_map( 'strval', $themes );
