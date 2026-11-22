<?php
// For the loopback request that checks an edited plugin or theme, starts watching for a fatal error, when the request carries a valid wp_scrape_key and nonce; otherwise nothing.
wp_start_scraping_edited_file_errors();
return defined( 'WP_SANDBOX_SCRAPING' );
