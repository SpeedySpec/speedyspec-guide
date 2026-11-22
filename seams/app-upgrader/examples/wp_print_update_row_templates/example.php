<?php
// Prints the Underscore templates the updates script uses for plugin and theme update rows.
$html = guide_render( 'wp_print_update_row_templates' );
return array( str_contains( $html, 'tmpl-item-update-row' ), str_contains( $html, 'tmpl-item-deleted-row' ) );
