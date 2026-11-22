<?php
// Deprecated in 6.0.0; use wp_should_skip_block_supports_serialization(). Checks whether serialization of the current block's spacing properties should occur. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( 'wp_skip_spacing_serialization', WP_Block_Type_Registry::get_instance()->get_registered( 'core/paragraph' ) );
