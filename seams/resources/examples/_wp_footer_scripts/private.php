<?php
// Prints the late styles and the footer scripts; on wp_print_footer_scripts.
wp_enqueue_script( 'guide-foot', 'https://cdn.example/foot.js', array(), null, true );
return str_contains( guide_render( '_wp_footer_scripts' ), 'foot.js' );
