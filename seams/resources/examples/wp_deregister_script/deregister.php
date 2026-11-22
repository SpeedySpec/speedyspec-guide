<?php
// Removes a registered script; core scripts can't be removed in the admin, with a notice.
wp_register_script( 'guide-app', 'https://cdn.example/app.js', array( 'jquery' ), '1.2' );
wp_deregister_script( 'guide-app' );
return wp_script_is( 'guide-app', 'registered' );
