<?php
// What each palette color is for, by slug: base, contrast and the accents the theme uses.
guide_theme( 'ipsum' );
require_once get_template_directory() . '/inc/abilities.php';
return array_keys( ipsum_get_color_roles() );
