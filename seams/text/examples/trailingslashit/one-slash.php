<?php
// Ends a string with exactly one slash.
return array( trailingslashit( '/path' ), trailingslashit( '/path//' ), untrailingslashit( '/path\\/' ) );
