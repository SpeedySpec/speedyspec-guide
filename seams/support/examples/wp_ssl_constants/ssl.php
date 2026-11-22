<?php
// Defines FORCE_SSL_ADMIN (false unless set) and tells force_ssl_admin() about it.
wp_ssl_constants();
return array( FORCE_SSL_ADMIN, force_ssl_admin() );
