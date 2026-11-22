<?php
// Prints a script tag holding JavaScript.
return guide_render( fn() => wp_print_inline_script_tag( 'var a = 1;' ) );
