<?php
// Sends the XML content type when it can, and prints the sitemap; render_index() does the same for the index.
$renderer = new WP_Sitemaps_Renderer();
$renderer->render_sitemap( array( array( 'loc' => 'http://example.org/' ) ) );
$renderer->render_index( array( array( 'loc' => 'http://example.org/?sitemap=posts' ) ) );
return null;
