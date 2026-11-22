<?php
// The JSON schema of the design guide the ability returns: one property per section.
guide_theme( 'ipsum' );
require_once get_template_directory() . '/inc/abilities.php';
$schema = ipsum_get_design_guide_schema();
return array( $schema['type'], array_keys( $schema['properties'] ) );
