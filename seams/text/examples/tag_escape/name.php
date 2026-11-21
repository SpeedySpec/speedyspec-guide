<?php
// Keeps letters, digits, - _ and :, and lowercases; tag_escape gets the result and the original.
add_filter( 'tag_escape', fn( $safe, $name ) => "$safe/$name", 10, 2 );
return tag_escape( 'My-Tag<script>' );
