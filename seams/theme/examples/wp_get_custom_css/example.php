<?php
// A theme's Additional CSS; filtered by wp_get_custom_css.
wp_update_custom_css_post( 'p { margin: 0; }' );
return array( wp_get_custom_css(), wp_get_custom_css( 'other' ) );
