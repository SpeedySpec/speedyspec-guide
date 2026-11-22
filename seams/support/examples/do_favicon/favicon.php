<?php
// Answers /favicon.ico: fires do_faviconico, then redirects to the site icon (or WordPress's logo) and ends the request.
function guide_stop_at_favicon() {
	throw new RuntimeException( 'do_faviconico fired' );
}
add_action( 'do_faviconico', 'guide_stop_at_favicon' );
try { do_favicon(); } catch ( RuntimeException $e ) { return $e->getMessage(); }
