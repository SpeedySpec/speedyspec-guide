<?php
// Deprecated in 7.2.0: it still removes everything up to the end of the first attribute, quoted or not, and the spaces after it.
add_action( 'deprecated_function_run', function ( $name, $replacement, $version ) { echo "$name $version"; }, 10, 3 );
return wp_kses_html_error( 'title="a b" class=c' );
