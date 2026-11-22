<?php
// The pre_kses filter, run on the content before kses parses it.
function guide_replace_bad_words( $content ) {
	return str_replace( 'bad', 'good', $content );
}
add_filter( 'pre_kses', 'guide_replace_bad_words' );
return wp_kses_hook( 'bad words', array(), array() );
