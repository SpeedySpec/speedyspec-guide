<?php
// Answers /favicon.ico: fires do_faviconico, then redirects to the site icon (or WordPress's logo) and ends the request.
add_action( 'do_faviconico', function () { throw new RuntimeException( 'do_faviconico fired' ); } );
try { do_favicon(); } catch ( RuntimeException $e ) { return $e->getMessage(); }
