<?php
// The code point of a string's first character; an empty string, invalid UTF-8 or another encoding gives false. mb_ord() uses it when mbstring is missing.
return array( _mb_ord( 'A' ), _mb_ord( 'é' ), _mb_ord( '🙂x' ), _mb_ord( "\xFF" ), _mb_ord( '' ), mb_ord( '☺' ) );
