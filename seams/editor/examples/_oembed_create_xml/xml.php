<?php
// oEmbed data as XML, nested arrays as child elements and numeric keys as oembed; false for empty data.
return array( _oembed_create_xml( array( 'version' => '1.0', 'title' => 'A & B', 'list' => array( 'x', 'y' ) ) ), _oembed_create_xml( array() ) );
