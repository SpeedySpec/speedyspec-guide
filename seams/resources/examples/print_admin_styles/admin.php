<?php
// Prints the queued styles in the admin; gives the handles printed.
wp_enqueue_style( 'guide-admin', 'https://cdn.example/admin.css', array(), null );
ob_start();
$done = print_admin_styles();
$html = ob_get_clean();
return array( in_array( 'guide-admin', $done, true ), str_contains( $html, 'admin.css' ) );
