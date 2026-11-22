<?php
// Redirects a 404 on the main site to NOBLOGREDIRECT, when it is set; nothing otherwise.
maybe_redirect_404();
return defined( 'NOBLOGREDIRECT' );
