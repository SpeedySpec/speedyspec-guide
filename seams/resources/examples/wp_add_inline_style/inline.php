<?php
// Adds CSS to print after a registered style; style tags in the CSS are wrong.
wp_register_style( 'guide-style', 'https://cdn.example/style.css', array(), '2.0' );
wp_add_inline_style( 'guide-style', 'body { color: red; }' );
return wp_styles()->get_data( 'guide-style', 'after' );
