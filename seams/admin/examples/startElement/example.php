<?php
// The XML parser's start handler in link-parse-opml.php: collects each outline's title, URL, target, description and feed when importing links from OPML.
$GLOBALS['opml'] = '<?xml version="1.0"?><opml version="1.0"><body><outline text="Example" htmlUrl="https://example.org/" xmlUrl="https://example.org/feed/" /></body></opml>';
include ABSPATH . 'wp-admin/link-parse-opml.php';
return array( $GLOBALS['names'], $GLOBALS['urls'], $GLOBALS['feeds'] );
