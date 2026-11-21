<?php
// On robots_txt, a public site gets a Sitemap: line with the index URL.
$sitemaps = new WP_Sitemaps();
return array( $sitemaps->add_robots( "User-agent: *", true ), $sitemaps->add_robots( 'User-agent: *', false ) );
