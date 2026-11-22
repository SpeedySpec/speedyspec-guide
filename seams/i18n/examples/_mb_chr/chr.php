<?php
// The UTF-8 character of a code point; surrogates, values past U+10FFFF, other encodings and non-integers give false. mb_chr() uses it when mbstring is missing.
return array( _mb_chr( 65 ), bin2hex( _mb_chr( 0xE9 ) ), bin2hex( _mb_chr( 0x1F642 ) ), _mb_chr( 0xD800 ), _mb_chr( 65, 'ISO-8859-1' ), mb_chr( 0x263A ) );
