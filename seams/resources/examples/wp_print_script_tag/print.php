<?php
// Prints a script tag with the attributes given.
return guide_render( fn() => wp_print_script_tag( array( 'src' => 'a.js', 'defer' => true ) ) );
