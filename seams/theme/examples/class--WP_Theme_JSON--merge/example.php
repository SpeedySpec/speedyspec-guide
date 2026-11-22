<?php
// Merges another theme.json over this one: settings and styles combined, presets replaced per origin, so user data overrides the theme's and the theme's the defaults.
$base = new WP_Theme_JSON( array( 'version' => 3, 'styles' => array( 'color' => array( 'text' => 'black', 'background' => 'white' ) ) ) );
$base->merge( new WP_Theme_JSON( array( 'version' => 3, 'styles' => array( 'color' => array( 'text' => 'navy' ) ) ), 'custom' ) );
return $base->get_raw_data()['styles']['color'];
