<?php
// Registers a script by handle with its source, dependencies, version and arguments (in footer, strategy); false when the handle is taken.
wp_register_script( 'guide-app', 'https://cdn.example/app.js', array( 'jquery' ), '1.2' );
$s = wp_scripts()->registered['guide-app'];
return array( $s->src, $s->deps, $s->ver, wp_register_script( 'guide-app', 'other.js' ) );
