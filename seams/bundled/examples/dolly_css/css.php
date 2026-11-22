<?php
// Prints the style that places the lyric at the top of the admin, on the right (on the left for right-to-left languages).
guide_hello_dolly();
return array( str_contains( guide_render( 'dolly_css' ), '#dolly' ), has_action( 'admin_head', 'dolly_css' ) );
