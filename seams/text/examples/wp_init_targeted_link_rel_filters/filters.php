<?php
// Deprecated since 6.7.0: it only reports itself, and adds nothing.
add_action( 'deprecated_function_run', function ( $function_name, $replacement, $version ) { echo "$function_name $version"; }, 10, 3 );
wp_init_targeted_link_rel_filters();
return has_filter( 'content_save_pre', 'wp_targeted_link_rel' );
