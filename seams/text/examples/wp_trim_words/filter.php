<?php
// wp_trim_words gets the trimmed text, the count, the more text and the original.
add_filter( 'wp_trim_words', fn( $text, $num, $more, $original ) => "$text|$num|$original", 10, 4 );
return wp_trim_words( 'a b c', 1, '!' );
