<?php
// The URL details controller fetches a URL for the editor's link previews at /wp-block-editor/v1/url-details, giving its title, icon, description and image from the page's head, cached; users need to edit posts.
function guide_answer_page_request( $pre, $args, $url ) {
	if ( 'http://example.org/page' === $url ) {
		return array( 'headers' => array(), 'body' => '<html><head><title>Site &amp; more</title><meta name="description" content="A test site"><meta property="og:image" content="/og.png"><link rel="icon" href="/favicon.ico"></head><body></body></html>', 'response' => array( 'code' => 200, 'message' => 'OK' ), 'cookies' => array(), 'filename' => null );
	}
	return $pre;
}
add_filter( 'pre_http_request', 'guide_answer_page_request', 10, 3 );
return guide_rest( 'GET', '/wp-block-editor/v1/url-details', array( 'url' => 'http://example.org/page' ) )[1];
