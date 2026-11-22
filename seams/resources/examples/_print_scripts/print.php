<?php
// Prints the scripts' print_html; deprecated in 7.2.0.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v\n" ), 10, 3 );
wp_scripts()->print_html = '<script>/* x */</script>';
return guide_render( '_print_scripts' );
