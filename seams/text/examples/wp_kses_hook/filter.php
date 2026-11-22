<?php
// The pre_kses filter, run on the content before kses parses it.
add_filter( 'pre_kses', fn( $content ) => str_replace( 'bad', 'good', $content ) );
return wp_kses_hook( 'bad words', array(), array() );
