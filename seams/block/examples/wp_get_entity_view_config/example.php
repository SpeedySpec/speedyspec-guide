<?php
// An entity's view configuration for the admin's data views: default view, layouts, views and form, from its filter over the defaults.
$config = wp_get_entity_view_config( 'postType', 'page' );
return array_keys( $config );
