<?php
// Prints robots.txt: the admin is disallowed except admin-ajax.php; do_robotstxt fires first and robots_txt filters the text, with whether the site is public.
add_action( 'do_robotstxt', fn() => print( "# do_robotstxt\n" ) );
return guide_render( 'do_robots' );
