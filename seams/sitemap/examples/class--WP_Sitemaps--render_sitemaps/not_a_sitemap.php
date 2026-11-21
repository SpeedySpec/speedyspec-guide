<?php
// It renders only requests with the sitemap query var; others pass through untouched.
$GLOBALS['wp_query'] = new class { public function get( $var, $default = '' ) { return $default; } };
( new WP_Sitemaps() )->render_sitemaps();
return 'untouched';
