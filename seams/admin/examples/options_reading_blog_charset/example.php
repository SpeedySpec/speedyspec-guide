<?php
// Prints the Encoding for pages and feeds field of Reading Settings, for sites that still have it set.
return str_contains( guide_render( 'options_reading_blog_charset' ), 'blog_charset' );
