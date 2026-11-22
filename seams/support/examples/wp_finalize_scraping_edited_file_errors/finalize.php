<?php
// Prints the check's result, between the markers the editor looks for: the last fatal error, or success.
$_GET['wp_scrape_key'] = 'k';
return guide_render( fn() => wp_finalize_scraping_edited_file_errors( 'k' ) );
