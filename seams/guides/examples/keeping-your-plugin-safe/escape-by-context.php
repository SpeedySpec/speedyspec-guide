<?php
// The same untrusted string, escaped for each place it can be printed.
$untrusted = '"><img src=x onerror=alert(1)> Tom & Jerry';
return array(
	'html text'      => esc_html( $untrusted ),
	'html attribute' => esc_attr( $untrusted ),
	'url'            => esc_url( 'https://example.org/?q=' . rawurlencode( 'Tom & Jerry' ) ),
	'allowed tags'   => wp_kses_post( '<p>Fine <strong>bold</strong> text</p><script>alert(1)</script>' ),
);
