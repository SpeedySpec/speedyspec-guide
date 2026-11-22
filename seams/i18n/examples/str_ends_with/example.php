<?php
// PHP 8's str_ends_with(), which WordPress defines when PHP lacks it; case matters.
return array( str_ends_with( 'file.php', '.php' ), str_ends_with( 'File.PHP', '.php' ), str_ends_with( 'x', '' ) );
