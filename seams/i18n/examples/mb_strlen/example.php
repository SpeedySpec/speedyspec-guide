<?php
// mbstring's mb_strlen(), which WordPress defines with _mb_strlen() when PHP lacks it.
return array( mb_strlen( 'naïve' ), strlen( 'naïve' ) );
