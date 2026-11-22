<?php
// The drop-in files WordPress knows, by name, each with its description and the constant that turns it on, if any.
$dropins = _get_dropins();
return array( count( $dropins ) > 5, $dropins['object-cache.php'] );
