<?php
// Registers WordPress's admin color schemes: fresh, light, modern, blue and the rest.
register_admin_color_schemes();
return array_keys( $GLOBALS['_wp_admin_css_colors'] );
