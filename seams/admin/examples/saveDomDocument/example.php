<?php
// Writes a DOMDocument to a file, formatted, for the web.config helpers.
$file = get_temp_dir() . 'guide-doc.xml';
$doc = new DOMDocument();
$doc->loadXML( '<configuration><system.webServer/></configuration>' );
saveDomDocument( $doc, $file );
$contents = file_get_contents( $file );
unlink( $file );
return str_contains( $contents, '<system.webServer/>' );
