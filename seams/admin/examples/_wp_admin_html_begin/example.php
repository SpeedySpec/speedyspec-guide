<?php
// Prints the start of an admin page: the doctype, html element with its classes and language, and the opening head.
$html = guide_render( '_wp_admin_html_begin' );
return array( str_starts_with( $html, '<!DOCTYPE html>' ), str_contains( $html, '<head>' ) );
