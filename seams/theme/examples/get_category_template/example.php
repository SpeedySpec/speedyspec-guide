<?php
// The path of a category archive's template: category-{slug}.php, category-{id}.php, category.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
guide_go( '/?cat=1' );
return get_category_template();
