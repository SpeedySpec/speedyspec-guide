<?php
// The icons controllers: registered icons at /wp/v2/icons, all, by collection, or one by collection/name, with their SVG; the collections at /wp/v2/icon-collections. Users need to edit posts.
$icons = guide_rest( 'GET', '/wp/v2/icons', array( 'per_page' => 2 ) );
$collections = guide_rest( 'GET', '/wp/v2/icon-collections' )[1];
wp_set_current_user( 0 );
return array( $icons[0], array_keys( $icons[1][0] ?? array() ), array_column( $collections, 'slug' ), guide_rest( 'GET', '/wp/v2/icons' )[0] );
