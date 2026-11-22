<?php
// Reports a deprecated file being included: fires deprecated_file_included, then raises a notice when debugging allows it.
add_action( 'deprecated_file_included', fn( $file, $replacement, $version ) => print( "$file is deprecated since $version for $replacement\n" ), 10, 3 );
_deprecated_file( 'old.php', '5.0.0', 'new.php' );
return 'reported';
