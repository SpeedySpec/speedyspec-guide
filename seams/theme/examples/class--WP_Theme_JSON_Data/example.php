<?php
// WP_Theme_JSON_Data wraps one origin's theme.json for the wp_theme_json_data_* filters: update_with() merges new data in, get_data() gives the tree.
$data = new WP_Theme_JSON_Data( array( 'version' => 3, 'settings' => array( 'color' => array( 'custom' => true ) ) ), 'theme' );
$data->update_with( array( 'version' => 3, 'settings' => array( 'color' => array( 'custom' => false ) ) ) );
return array( $data->get_data()['settings']['color']['custom'], get_class( $data->get_theme_json() ) );
