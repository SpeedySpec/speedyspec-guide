<?php
// Whether a taxonomy is publicly queryable and so has public pages.
register_taxonomy( 'genre', 'post', array( 'label' => 'Genres', 'hierarchical' => true, 'public' => false ) );
return array( is_taxonomy_viewable( 'category' ), is_taxonomy_viewable( get_taxonomy( 'post_tag' ) ), is_taxonomy_viewable( 'genre' ), is_taxonomy_viewable( 'nope' ) );
