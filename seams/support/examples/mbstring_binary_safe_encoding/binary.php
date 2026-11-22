<?php
// Switches mbstring's internal encoding to ISO-8859-1 while mbstring overloads the string functions (PHP before 8), so strlen() counts bytes; calls nest, and reset_mbstring_encoding() switches back. Without overloading, as here, nothing changes.
mbstring_binary_safe_encoding();
$during = mb_internal_encoding();
reset_mbstring_encoding();
return array( $during, mb_internal_encoding() );
