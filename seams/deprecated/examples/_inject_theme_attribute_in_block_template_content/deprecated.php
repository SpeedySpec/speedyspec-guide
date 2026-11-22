<?php
// Deprecated in 6.4.0; use traverse_and_serialize_blocks( parse_blocks( $template_content ), "_inject_theme_attribute_in_template_part_block" ). Parses wp_template content and injects the active theme's stylesheet as a theme attribute into each wp_template_part. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( '_inject_theme_attribute_in_block_template_content', '<!-- wp:template-part {"slug":"header"} /-->' );
