<?php
// The sections the design guide gives when none are asked for.
guide_theme( 'ipsum' );
require_once get_template_directory() . '/inc/abilities.php';
return ipsum_get_design_guide_default_fields();
