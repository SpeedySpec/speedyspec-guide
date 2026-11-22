<?php
// A fast hash for high-entropy secrets like keys and tokens: BLAKE2b, prefixed $generic$; not for passwords.
return wp_fast_hash( 'random-token' );
