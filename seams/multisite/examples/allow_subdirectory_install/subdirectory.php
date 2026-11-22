<?php
// Whether the site can become a subdirectory network: always when WP_ALLOW_MULTISITE says so or the site is new (under a month old, no published posts).
require_once ABSPATH . 'wp-admin/includes/network.php';
return allow_subdirectory_install();
