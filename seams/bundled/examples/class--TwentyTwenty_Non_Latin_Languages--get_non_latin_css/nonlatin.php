<?php
// The font-family CSS for the site's language and a context (front-end, block-editor, classic-editor), for languages that need other fonts; nothing otherwise. Both lists are filtered.
guide_theme( 'twentytwenty' );
$english = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'front-end' );
add_filter( 'locale', fn() => 'he_IL' );
return array( $english, substr( TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'front-end' ), -60 ) );
