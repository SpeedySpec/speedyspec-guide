<?php
// Reports a deprecated file being included: fires deprecated_file_included, then raises a notice when debugging allows it.
function guide_print_deprecated_file( $file, $replacement, $version ) {
	echo "$file is deprecated since $version for $replacement\n";
}
add_action( 'deprecated_file_included', 'guide_print_deprecated_file', 10, 3 );
_deprecated_file( 'old.php', '5.0.0', 'new.php' );
return 'reported';
