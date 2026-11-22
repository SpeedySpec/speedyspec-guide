<?php
// basename() that keeps multibyte names and treats both slashes as separators.
return array( wp_basename( '/dir/日本.txt' ), wp_basename( 'C:\\\\dir\\\\file.php', '.php' ) );
