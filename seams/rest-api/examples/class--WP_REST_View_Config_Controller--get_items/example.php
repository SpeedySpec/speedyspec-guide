<?php
// The view config controller gives an entity's default view configuration for the admin's data views at /wp/v2/view-config: the default view and layouts, the list of views and the form, each shaped by its schema.
$data = guide_rest( 'GET', '/wp/v2/view-config', array( 'kind' => 'postType', 'name' => 'page' ) )[1];
wp_set_current_user( 0 );
return array( array_keys( $data ), $data['default_view']['type'] ?? null, guide_rest( 'GET', '/wp/v2/view-config', array( 'kind' => 'postType', 'name' => 'page' ) )[0] );
