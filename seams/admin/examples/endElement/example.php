<?php
// The XML parser's end handler in link-parse-opml.php; does nothing.
$GLOBALS['opml'] = '<?xml version="1.0"?><opml version="1.0"><body><outline text="Example" htmlUrl="https://example.org/" /></body></opml>';
include_once ABSPATH . 'wp-admin/link-parse-opml.php';
return endElement( null, 'OUTLINE' );
