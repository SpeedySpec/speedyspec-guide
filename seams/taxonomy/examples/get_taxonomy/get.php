<?php
// A registered taxonomy's WP_Taxonomy, or false.
return array( get_class( get_taxonomy( 'post_tag' ) ), get_taxonomy( 'post_tag' )->label, get_taxonomy( 'nope' ) );
