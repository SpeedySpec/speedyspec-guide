<?php
// Keeps letters, digits, - _ and :, and lowercases; tag_escape gets the result and the original.
function guide_join_tag_names( $safe, $name ) {
	return "$safe/$name";
}
add_filter( 'tag_escape', 'guide_join_tag_names', 10, 2 );
return tag_escape( 'My-Tag<script>' );
