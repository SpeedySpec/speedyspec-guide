<?php
// When the site doesn't need it, content is returned as it is.
add_filter( 'pre_option_https_migration_required', fn() => '' );
return wp_replace_insecure_home_url( 'http://example.org/a' );
