<?php
// The slug of the pattern a template is made of, when its content is a single Pattern block; null otherwise.
guide_theme( 'ipsum' );
require_once get_template_directory() . '/inc/abilities.php';
return array( ipsum_get_design_guide_pattern_slug( '<!-- wp:pattern {"slug":"ipsum/footer"} /-->' ), ipsum_get_design_guide_pattern_slug( '<!-- wp:paragraph --><p>x</p><!-- /wp:paragraph -->' ) );
