<?php
// The custom_css post holding a theme's Additional CSS, or null.
wp_update_custom_css_post( 'p { margin: 0; }' );
return array( wp_get_custom_css_post()->post_type, wp_get_custom_css_post()->post_name, wp_get_custom_css_post( 'other' ) );
