<?php
// On pre_oembed_result: a URL of this site is embedded from its own data, without a request; other URLs go on to oEmbed. The data is rich through get_oembed_response_data_rich(), which default-filters.php attaches.
add_filter( 'random_password', fn() => 'SECRET' );
add_filter( 'oembed_response_data', 'get_oembed_response_data_rich', 10, 4 );
$post = guide_post();
$html = wp_filter_pre_oembed_result( null, get_permalink( $post ), array( 'width' => 400 ) );
return array( substr( (string) $html, 0, 80 ), wp_filter_pre_oembed_result( null, 'https://elsewhere.example/', array() ) );
