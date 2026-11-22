<?php
// Checks a file path: 0 when fine, 1 for ../ traversal, 2 for a Windows drive path, 3 when not in the allowed list.
return array( validate_file( 'theme/style.css' ), validate_file( '../wp-config.php' ), validate_file( 'C:/x.php' ), validate_file( 'b.php', array( 'a.php' ) ) );
