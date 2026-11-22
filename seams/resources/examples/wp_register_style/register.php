<?php
// Registers a stylesheet by handle with its source, dependencies, version and media; false when the handle is taken.
wp_register_style( 'guide-style', 'https://cdn.example/style.css', array(), '2.0' );
$s = wp_styles()->registered['guide-style'];
return array( $s->src, $s->ver, $s->args, wp_register_style( 'guide-style', 'other.css' ) );
