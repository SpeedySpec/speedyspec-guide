<?php
// Deprecated in 6.3.0; use WP_Duotone::register_duotone_support(). Registers the style and colors block attributes for block types that support it. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_register_duotone_support', WP_Block_Type_Registry::get_instance()->get_registered( 'core/paragraph' ) );
