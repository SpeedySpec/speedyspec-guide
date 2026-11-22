<?php
// Numbered page links with previous and next, ellipses beyond mid_size, as a string, list or array; filtered by paginate_links and paginate_links_output.
return array( paginate_links( array( 'base' => '/page/%#%/', 'format' => '', 'current' => 5, 'total' => 9, 'mid_size' => 1, 'prev_next' => false ) ), count( paginate_links( array( 'base' => '/?paged=%#%', 'current' => 1, 'total' => 3, 'type' => 'array' ) ) ) );
