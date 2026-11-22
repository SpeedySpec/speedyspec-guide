<?php
// Hooked to update_option_home and update_option_siteurl: flushes the rewrite rules when the site's address changes during an upgrade or install.
return update_home_siteurl( 'http://example.org', 'http://example.org' );
