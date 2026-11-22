<?php
// WP_Theme_JSON holds a theme.json tree for an origin (default, blocks, theme, custom): sanitized by its schema, merged with others, and turned into a stylesheet of CSS variables, preset classes, styles and layout rules, plus settings per block.
$json = new WP_Theme_JSON( array( 'version' => 3, 'settings' => array( 'color' => array( 'palette' => array( array( 'slug' => 'brand', 'color' => '#ff6600', 'name' => 'Brand' ) ) ) ), 'styles' => array( 'color' => array( 'background' => 'var:preset|color|brand' ), 'nope' => 1 ) ), 'theme' );
$css = $json->get_stylesheet( array( 'variables', 'styles' ) );
return array( str_contains( $css, '--wp--preset--color--brand: #ff6600' ), str_contains( $css, 'background-color: var(--wp--preset--color--brand)' ), array_keys( $json->get_raw_data()['styles'] ), $json->get_settings()['color']['palette']['theme'][0]['slug'] );
