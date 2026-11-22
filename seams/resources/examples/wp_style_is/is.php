<?php
// Whether a stylesheet is in a list: enqueued (the default), registered, to_do or done.
wp_register_style( 'guide-style', 'https://cdn.example/style.css', array(), '2.0' );
return array( wp_style_is( 'guide-style' ), wp_style_is( 'guide-style', 'registered' ) );
