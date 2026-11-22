<?php
// WordPress's version, read from version.php, unaffected by changes to $wp_version.
require ABSPATH . WPINC . '/version.php';
return wp_get_wp_version() === $wp_version;
