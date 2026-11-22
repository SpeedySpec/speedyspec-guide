<?php
// Prints the Underscore templates the updates script uses for its admin notices.
$html = guide_render( 'wp_print_admin_notice_templates' );
return array( str_contains( $html, 'tmpl-wp-updates-admin-notice' ), str_contains( $html, 'tmpl-wp-bulk-updates-admin-notice' ) );
