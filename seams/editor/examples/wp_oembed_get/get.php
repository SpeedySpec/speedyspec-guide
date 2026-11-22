<?php
// The embed HTML for a URL from its oEmbed provider (sizes from the arguments or the defaults), or false.
guide_queue_http( array( array( 'type' => 'video', 'version' => '1.0', 'title' => 'Clip', 'html' => '<iframe src="https://www.youtube.com/embed/abc"></iframe>' ) ) );
return array( wp_oembed_get( 'https://www.youtube.com/watch?v=abc', array( 'width' => 400 ) ), wp_oembed_get( 'https://unknown.example/page' ) );
