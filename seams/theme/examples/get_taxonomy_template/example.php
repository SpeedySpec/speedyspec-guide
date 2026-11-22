<?php
// The path of a taxonomy archive's template: taxonomy-{taxonomy}-{term}.php, taxonomy-{taxonomy}.php, taxonomy.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
return get_taxonomy_template();
