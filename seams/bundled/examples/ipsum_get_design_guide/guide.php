<?php
// The theme's design guide read from the site as it is: theme, color scheme, colors with their roles, gradients, duotone, typography, spacing, layout and guidelines by default, or the sections asked for.
guide_theme( 'ipsum' );
require_once get_template_directory() . '/inc/abilities.php';
$guide = ipsum_get_design_guide();
$layout = ipsum_get_design_guide( array( 'fields' => array( 'layout', 'theme' ) ) );
return array( array_keys( $guide ), $guide['theme'], $layout );
