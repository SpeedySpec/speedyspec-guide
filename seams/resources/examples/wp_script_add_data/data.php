<?php
// Adds data to a script, such as strategy or conditional; false for an unknown handle.
wp_register_script( 'guide-app', 'https://cdn.example/app.js', array( 'jquery' ), '1.2' );
return array( wp_script_add_data( 'guide-app', 'strategy', 'async' ), wp_scripts()->get_data( 'guide-app', 'strategy' ), wp_script_add_data( 'nope', 'x', 1 ) );
