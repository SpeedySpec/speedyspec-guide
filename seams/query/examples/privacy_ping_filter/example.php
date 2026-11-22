<?php
// Hooked to option_ping_sites: no update services while the site isn't public.
update_option( 'blog_public', 0 );
$private = privacy_ping_filter( 'http://rpc.example.test/' );
update_option( 'blog_public', 1 );
return array( $private, privacy_ping_filter( 'http://rpc.example.test/' ) );
