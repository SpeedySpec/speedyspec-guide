<?php
// Only a <body> context and UTF-8 are supported; anything else gives null.
return array( get_class( WP_HTML_Processor::create_fragment( '<p>' ) ), WP_HTML_Processor::create_fragment( '<p>', '<div>' ) );
