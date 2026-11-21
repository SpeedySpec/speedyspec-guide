<?php
// A private method: before wp_loaded it rebuilds the rules and hooks flush_rules() to wp_loaded to save them then; after, it saves them at once.
$r = guide_permalinks( '/%postname%/' );
Closure::bind( fn() => $this->refresh_rewrite_rules(), $r, WP_Rewrite::class )();
return has_action( 'wp_loaded', array( $r, 'flush_rules' ) );
