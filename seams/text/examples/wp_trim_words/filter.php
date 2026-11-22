<?php
// wp_trim_words gets the trimmed text, the count, the more text and the original.
function guide_join_trimmed_words( $text, $num, $more, $original ) {
	return "$text|$num|$original";
}
add_filter( 'wp_trim_words', 'guide_join_trimmed_words', 10, 4 );
return wp_trim_words( 'a b c', 1, '!' );
