<?php
// Registers a font collection for the Font Library: a name, a description, its font families (a JSON file or URL, or an array) and categories; an error for a bad or taken slug.
$collection = wp_register_font_collection( 'guide-fonts', array( 'name' => 'Guide fonts', 'font_families' => array( array( 'font_family_settings' => array( 'name' => 'Inter', 'slug' => 'inter', 'fontFamily' => 'Inter' ) ) ) ) );
return array( get_class( $collection ), $collection->get_data()['name'], wp_register_font_collection( 'Bad Slug', array() ) instanceof WP_Error );
