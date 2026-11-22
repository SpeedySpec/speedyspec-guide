<?php
// Whether the home URL is https.
add_filter( 'pre_option_home', fn() => 'https://example.org', 20 );
return wp_is_home_url_using_https();
