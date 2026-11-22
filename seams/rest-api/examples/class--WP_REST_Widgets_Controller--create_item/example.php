<?php
// The sidebars and widgets controllers: widget areas at /wp/v2/sidebars with their widget IDs, and widgets at /wp/v2/widgets, created, moved between areas, updated and deleted by users who can edit theme options.
register_sidebar( array( 'id' => 'side', 'name' => 'Side' ) );
[ $status, $widget ] = guide_rest( 'POST', '/wp/v2/widgets', array( 'sidebar' => 'side', 'id_base' => 'block', 'instance' => array( 'raw' => array( 'content' => '<p>Hi</p>' ) ) ) );
$sidebar = guide_rest( 'GET', '/wp/v2/sidebars/side' )[1];
$moved = guide_rest( 'POST', "/wp/v2/widgets/{$widget['id']}", array( 'sidebar' => 'wp_inactive_widgets' ) )[1]['sidebar'];
return array( $status, $widget['id'], $sidebar['widgets'], $moved );
