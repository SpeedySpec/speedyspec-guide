<?php
// A path with forward slashes, repeated slashes collapsed (not in stream wrappers) and a Windows drive letter in upper case.
return array( wp_normalize_path( 'c:\\www\\\\site\\' ), wp_normalize_path( 'php://memory//x' ) );
