<?php
// A Navigation Link variation for a post type or taxonomy.
$variation = build_variation_for_navigation_link( get_post_type_object( 'page' ), 'post-type' );
return array( $variation['name'], $variation['title'], $variation['attributes'] );
