<?php
// Whether a taxonomy is hierarchical; false for an unregistered one.
return array( is_taxonomy_hierarchical( 'category' ), is_taxonomy_hierarchical( 'post_tag' ), is_taxonomy_hierarchical( 'nope' ) );
