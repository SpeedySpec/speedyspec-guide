<?php
// A URL with a nonce for an action added as _wpnonce (or the name given), its ampersands escaped for HTML.
$url = wp_nonce_url( 'http://example.org/wp-admin/post.php?action=trash&post=7', 'trash-post_7' );
return preg_replace( '/_wpnonce=\w+/', '_wpnonce=NONCE', $url );
