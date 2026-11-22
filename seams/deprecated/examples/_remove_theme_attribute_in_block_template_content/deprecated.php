<?php
// Deprecated in 6.4.0; use traverse_and_serialize_blocks( parse_blocks( $template_content ), "_remove_theme_attribute_from_template_part_block" ). Parses a block template and removes the theme attribute from each template part. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
return guide_deprecated( '_remove_theme_attribute_in_block_template_content', '<!-- wp:template-part {"slug":"header"} /-->' );
