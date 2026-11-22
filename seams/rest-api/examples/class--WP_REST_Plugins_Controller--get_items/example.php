<?php
// The plugins controller lists, installs (from WordPress.org), activates, deactivates and deletes plugins at /wp/v2/plugins, a plugin named by its folder and file without .php; users need the plugin capabilities.
$list = guide_rest( 'GET', '/wp/v2/plugins' )[1];
$hello = guide_rest( 'GET', '/wp/v2/plugins/hello' )[1];
wp_set_current_user( 0 );
return array( array_column( $list, 'plugin' ), $hello['status'], $hello['name'], guide_rest( 'GET', '/wp/v2/plugins' )[0] );
