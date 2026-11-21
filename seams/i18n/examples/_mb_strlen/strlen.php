<?php
// The length in characters for UTF-8, in bytes otherwise; an invalid byte counts as one character. mb_strlen() uses it when mbstring is missing.
return array( _mb_strlen( 'café' ), _mb_strlen( 'café', 'latin1' ), _mb_strlen( "a\xFFb" ), mb_strlen( 'café' ) );
