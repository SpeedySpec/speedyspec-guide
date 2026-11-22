<?php
// The site's oEmbed endpoint, with the URL to embed and a format other than JSON; oembed_endpoint_url filters it.
return array( get_oembed_endpoint_url(), get_oembed_endpoint_url( 'http://example.org/?p=1', 'xml' ) );
