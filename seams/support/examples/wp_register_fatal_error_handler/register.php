<?php
// Registers the shutdown handler that catches fatal errors (fatal-error-handler.php drop-in or WP_Fatal_Error_Handler), when the handler is enabled.
wp_register_fatal_error_handler();
return wp_is_fatal_error_handler_enabled();
