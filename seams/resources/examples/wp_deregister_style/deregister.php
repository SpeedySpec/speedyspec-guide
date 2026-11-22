<?php
// Removes a registered stylesheet.
wp_register_style( 'guide-style', 'https://cdn.example/style.css', array(), '2.0' );
wp_deregister_style( 'guide-style' );
return wp_style_is( 'guide-style', 'registered' );
