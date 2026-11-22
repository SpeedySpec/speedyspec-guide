<?php
// Whether the site URL is https, through the site_url filter.
add_filter( 'site_url', fn( $url ) => str_replace( 'http://', 'https://', $url ) );
return wp_is_site_url_using_https();
