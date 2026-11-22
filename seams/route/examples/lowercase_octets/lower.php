<?php
// The callback redirect_canonical() uses to lowercase percent-encoded octets, so %C3%A9 and %c3%a9 compare equal. It is declared the first time redirect_canonical() needs it.
guide_permalinks( '/%postname%/' );
redirect_canonical( 'http://example.org/caf%C3%A9', false );
return lowercase_octets( array( '%C3%A9' ) );
