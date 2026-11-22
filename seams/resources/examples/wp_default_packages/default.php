<?php
// Registers the vendor scripts, development scripts and packages, adds their inline scripts, and on the front end only what they need.
$s = new WP_Scripts();
wp_default_packages( $s );
return array( isset( $s->registered['wp-element'] ), isset( $s->registered['react'] ) );
