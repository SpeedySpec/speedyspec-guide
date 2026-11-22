<?php
// Whether the site can become a subdomain network: it isn't on localhost or an IP address, and its URL has no path.
require_once ABSPATH . 'wp-admin/includes/network.php';
return allow_subdomain_install();
