<?php
// The callback for one attribute: it reads the base from the $_links_add_base global.
$GLOBALS['_links_add_base'] = 'http://example.org/';
return _links_add_base( array( 'href="x"', 'href', '"', 'x' ) );
