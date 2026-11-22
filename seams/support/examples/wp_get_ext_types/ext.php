<?php
// The file extensions of each kind (image, audio, video, document, spreadsheet, interactive, text, archive, code); ext2type filters them.
$types = wp_get_ext_types();
return array( array_keys( $types ), array_slice( $types['image'], 0, 5 ) );
