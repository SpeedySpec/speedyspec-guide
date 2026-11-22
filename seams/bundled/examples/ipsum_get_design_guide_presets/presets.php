<?php
// The theme's and the user's presets of a kind, each with only the keys asked for.
guide_theme( 'ipsum' );
require_once get_template_directory() . '/inc/abilities.php';
return ipsum_get_design_guide_presets( array( 'theme' => array( array( 'slug' => 'base', 'name' => 'Base', 'color' => '#fff', 'x' => 1 ) ), 'custom' => array( array( 'slug' => 'mine', 'color' => '#000' ) ), 'default' => array( array( 'slug' => 'skipped' ) ) ), array( 'slug', 'color' ) );
