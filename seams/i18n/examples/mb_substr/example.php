<?php
// mbstring's mb_substr(), which WordPress defines with _mb_substr() when PHP lacks it.
return mb_substr( 'naïve', 1, 3 );
