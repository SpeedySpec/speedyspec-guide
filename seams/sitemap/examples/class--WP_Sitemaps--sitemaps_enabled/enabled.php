<?php
// On for a public site; wp_sitemaps_enabled decides.
$sitemaps = new WP_Sitemaps();
$public = $sitemaps->sitemaps_enabled();
add_filter( 'wp_sitemaps_enabled', '__return_false' );
return array( $public, $sitemaps->sitemaps_enabled() );
