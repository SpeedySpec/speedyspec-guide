<?php
// A request on another form of the home host, such as www., redirects to the home URL's.
guide_permalinks( '/%postname%/' );
return array( redirect_canonical( 'http://www.example.org/hello/', false ), redirect_canonical( 'http://example.org/hello/?utm=1', false ) );
