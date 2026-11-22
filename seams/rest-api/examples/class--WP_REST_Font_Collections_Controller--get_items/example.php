<?php
// Font collections are registered with wp_register_font_collection(), from a JSON file or URL or from data; the controller lists them and serves one with its families and categories.
wp_register_font_collection( 'guide-fonts', array( 'name' => 'Guide fonts', 'font_families' => array( array( 'font_family_settings' => array( 'name' => 'Mono', 'slug' => 'mono', 'fontFamily' => 'monospace' ), 'categories' => array( 'mono' ) ) ), 'categories' => array( array( 'name' => 'Mono', 'slug' => 'mono' ) ) ) );
$one = guide_rest( 'GET', '/wp/v2/font-collections/guide-fonts' )[1];
return array( in_array( 'guide-fonts', array_column( guide_rest( 'GET', '/wp/v2/font-collections' )[1], 'slug' ), true ), $one['name'], $one['font_families'][0]['font_family_settings']['slug'] );
