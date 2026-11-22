<?php
// With WP_HTTP_BLOCK_EXTERNAL, requests to other hosts are blocked, except WP_ACCESSIBLE_HOSTS (wildcards allowed) and, unless block_local_requests says so, the site itself.
$http = new WP_Http();
$before = $http->block_request( 'http://other.example/' );
define( 'WP_HTTP_BLOCK_EXTERNAL', true );
define( 'WP_ACCESSIBLE_HOSTS', 'api.wordpress.org,*.allowed.example' );
return array( $before, $http->block_request( 'http://other.example/' ), $http->block_request( 'https://api.wordpress.org/x' ), $http->block_request( 'https://cdn.allowed.example/' ), $http->block_request( 'http://example.org/' ), $http->block_request( 'not a url' ) );
