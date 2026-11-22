<?php
// Prints robots.txt: the admin is disallowed except admin-ajax.php; do_robotstxt fires first and robots_txt filters the text, with whether the site is public.
function guide_print_robots_comment() {
	echo "# do_robotstxt\n";
}
add_action( 'do_robotstxt', 'guide_print_robots_comment' );
return guide_render( 'do_robots' );
