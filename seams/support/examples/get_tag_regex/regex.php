<?php
// A regular expression matching an HTML element by tag name, empty or with content.
$re = get_tag_regex( 'b' );
preg_match( "/$re/", 'a <b class="x">bold</b> c', $m );
return $m[0];
