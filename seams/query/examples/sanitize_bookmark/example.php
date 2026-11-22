<?php
// Sanitizes every field of a link for a context.
$bookmark = sanitize_bookmark( array( 'link_id' => '3', 'link_name' => '<b>Bold</b>', 'link_url' => 'javascript:alert(1)', 'link_rating' => '15' ), 'db' );
return array( $bookmark['link_id'], $bookmark['link_url'], $bookmark['link_rating'] );
