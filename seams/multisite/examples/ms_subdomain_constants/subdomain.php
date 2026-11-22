<?php
// Defines SUBDOMAIN_INSTALL from the old VHOST constant, warning when it is used or when they disagree.
ms_subdomain_constants();
return array( SUBDOMAIN_INSTALL, defined( 'VHOST' ) ? VHOST : null );
