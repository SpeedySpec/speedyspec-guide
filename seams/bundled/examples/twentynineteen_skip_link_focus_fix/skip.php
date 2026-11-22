<?php
// Prints the script that fixes focus on skip links in Internet Explorer 11.
guide_theme( 'twentynineteen' );
return str_contains( guide_render( 'twentynineteen_skip_link_focus_fix' ), 'trident|msie' );
