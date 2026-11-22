<?php
// true, or a list of post types, or null when it is missing or unusable.
guide_core_abilities();
$users = new WP_Abilities_Users();
return array_map( fn( $w ) => guide_private( $users, 'normalize_has_published_posts', $w ), array( array(), array( 'has_published_posts' => true ), array( 'has_published_posts' => 'post,page' ), array( 'has_published_posts' => false ) ) );
