<?php
// Whether an ID is valid for the cache helpers: a positive integer or digit string.
return array( _validate_cache_id( 5 ), _validate_cache_id( '7' ), _validate_cache_id( 'x' ) );
