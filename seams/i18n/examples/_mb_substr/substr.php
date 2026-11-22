<?php
// substr() by characters for UTF-8 (the given encoding or blog_charset), by bytes otherwise; negative start and length count from the end, and null is ''.
return array( _mb_substr( 'naïve café', 2, 4 ), _mb_substr( 'naïve café', -4 ), _mb_substr( 'naïve café', 1, -2 ), _mb_substr( 'naïve', 0, 3, 'latin1' ), _mb_substr( null, 0 ), mb_substr( 'héllo', 1, 2 ) );
