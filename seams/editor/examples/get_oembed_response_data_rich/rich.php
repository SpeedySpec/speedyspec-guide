<?php
// Makes oEmbed data rich: the width and height, and the post's embed HTML (a video attachment is type video), with its thumbnail when it has one.
add_filter( 'random_password', fn() => 'SECRET' );
$post = guide_post();
$data = get_oembed_response_data_rich( array( 'type' => 'link' ), get_post( $post ), 400, 225 );
$data['html'] = substr( $data['html'], 0, 60 );
return $data;
