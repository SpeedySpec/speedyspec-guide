<?php
// Adds JavaScript to print before or after a registered script; false for an unknown handle, and script tags in the code are wrong.
wp_register_script( 'guide-app', 'https://cdn.example/app.js', array( 'jquery' ), '1.2' );
wp_add_inline_script( 'guide-app', 'window.ready = true;' );
wp_add_inline_script( 'guide-app', 'var config = {};', 'before' );
return array( wp_scripts()->get_data( 'guide-app', 'after' ), wp_scripts()->get_data( 'guide-app', 'before' ), wp_add_inline_script( 'nope', 'x' ) );
