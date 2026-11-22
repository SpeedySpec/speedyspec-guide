<?php
// mbstring's mb_chr(), which WordPress defines with _mb_chr() when PHP lacks it.
return array( mb_chr( 0x263A ), bin2hex( mb_chr( 0xE9 ) ) );
