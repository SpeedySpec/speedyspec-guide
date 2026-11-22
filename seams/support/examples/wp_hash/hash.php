<?php
// An HMAC of data with a scheme's salt, MD5 by default.
return array( wp_hash( 'data' ), strlen( wp_hash( 'data', 'auth', 'sha256' ) ) );
