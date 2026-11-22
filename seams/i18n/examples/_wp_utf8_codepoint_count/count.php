<?php
// Code points in a string or a byte range of it, an invalid span counting as one; negative offsets give 0.
return array( _wp_utf8_codepoint_count( 'café' ), _wp_utf8_codepoint_count( "test\x90wp\xE2\x80\xC0test" ), _wp_utf8_codepoint_count( 'café', 2 ), _wp_utf8_codepoint_count( 'café', -1 ) );
