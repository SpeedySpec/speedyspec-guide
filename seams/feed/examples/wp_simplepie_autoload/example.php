<?php
// Loaded SimplePie's classes before WordPress used SimplePie's own autoloader. Deprecated in 6.7.0; does nothing.
require_once ABSPATH . WPINC . '/class-simplepie.php';
return wp_simplepie_autoload( 'SimplePie' );
