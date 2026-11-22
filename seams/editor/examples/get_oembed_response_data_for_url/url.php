<?php
// The oEmbed data for one of this site's URLs, as an object, or false for a URL that isn't a post; oembed_request_post_id can change the post found.
$post = guide_post();
$data = get_oembed_response_data_for_url( get_permalink( $post ), array( 'width' => 300 ) );
return array( get_class( $data ), $data->title, get_oembed_response_data_for_url( 'http://example.org/?p=999', array() ) );
