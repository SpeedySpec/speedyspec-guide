<?php
// Whether the request wants XML back: its Accept or Content-Type is an XML type.
$_SERVER['HTTP_ACCEPT'] = 'text/xml';
return wp_is_xml_request();
