<?php
// Hooked to wp_head: prints the Additional CSS of the active theme in a style tag.
wp_update_custom_css_post( 'body { color: red; }' );
return guide_render( 'wp_custom_css_cb' );
