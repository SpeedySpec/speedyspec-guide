<?php
// A legacy DOCTYPE puts the document in quirks mode.
$info = WP_HTML_Doctype_Info::from_doctype_token( '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">' );
return array( $info->name, $info->public_identifier, $info->indicated_compatibility_mode );
