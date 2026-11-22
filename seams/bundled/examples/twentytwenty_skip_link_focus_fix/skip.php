<?php
// Prints the script that fixes focus on skip links in Internet Explorer 11.
guide_theme( 'twentytwenty' );
return str_contains( guide_render( 'twentytwenty_skip_link_focus_fix' ), 'trident|msie' );
