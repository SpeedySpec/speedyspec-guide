<?php
// Prints the script that turns the html element's no-js class into js; on wp_head.
guide_theme( 'twentytwenty' );
return str_contains( guide_render( 'twentytwenty_no_js_class' ), "replace( 'no-js', 'js' )" );
