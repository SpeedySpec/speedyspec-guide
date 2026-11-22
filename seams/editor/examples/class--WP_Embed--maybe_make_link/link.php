<?php
// A URL that couldn't be embedded: a link, the bare URL when linkifunknown is off (as for autoembeds), or false with return_false_on_fail; embed_maybe_make_link filters it.
$embed = new WP_Embed();
$link = $embed->maybe_make_link( 'https://x.example/?a=1&b=2' );
$embed->linkifunknown = false;
$bare = $embed->maybe_make_link( 'https://x.example/' );
$embed->return_false_on_fail = true;
return array( $link, $bare, $embed->maybe_make_link( 'https://x.example/' ) );
