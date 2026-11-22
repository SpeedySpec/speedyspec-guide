<?php
// Registers the ipsum/get-design-guide ability: it reads the theme's design guide, needs edit_theme_options, and is read-only; on wp_abilities_api_init.
guide_theme( 'ipsum' );
do_action( 'wp_abilities_api_categories_init' );
$ability = wp_get_ability( 'ipsum/get-design-guide' );
return array( $ability ? $ability->get_label() : null, $ability ? $ability->get_meta()['annotations'] : null );
