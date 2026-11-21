<?php
// Prints the rules as a speculationrules script; with speculative loading off, nothing.
wp_print_speculation_rules();
echo "(nothing with plain permalinks)\n";
guide_permalinks( '/%postname%/' );
add_filter( 'wp_speculation_rules_href_exclude_paths', fn() => array() );
ob_start();
wp_print_speculation_rules();
$html = ob_get_clean();
return array( str_starts_with( $html, '<script type="speculationrules">' ), str_contains( $html, '"eagerness":"conservative"' ) );
