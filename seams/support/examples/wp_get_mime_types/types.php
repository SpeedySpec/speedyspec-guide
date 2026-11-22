<?php
// Every MIME type WordPress knows, by extension pattern (jpg|jpeg|jpe); mime_types filters them.
$types = wp_get_mime_types();
return array( $types['jpg|jpeg|jpe'], $types['pdf'], count( $types ) > 80 );
