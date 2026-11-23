<?php
// Kept category and tag slugs in step with global terms on old networks. Deprecated in 6.1.0.
$term = get_term( 1 );
return guide_deprecated( 'sync_category_tag_slugs', $term, 'category' )[0]->slug;
