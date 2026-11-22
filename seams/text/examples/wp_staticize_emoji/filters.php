<?php
// emoji_url and emoji_ext pick the images; ASCII text is returned at once.
add_filter( 'emoji_url', fn() => 'https://example.com/e/' );
add_filter( 'emoji_ext', fn() => '.gif' );
return array( wp_staticize_emoji( 'plain' ), wp_staticize_emoji( '🙂' ) );
