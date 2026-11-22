<?php
// Sets error reporting from WP_DEBUG, WP_DEBUG_DISPLAY and WP_DEBUG_LOG: with debugging off only the serious errors are reported; enable_wp_debug_mode_checks can skip it.
$before = error_reporting();
wp_debug_mode();
$after = error_reporting();
error_reporting( $before );
return array( WP_DEBUG, ( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR ) === $after );
