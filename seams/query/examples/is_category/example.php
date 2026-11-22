<?php
// Whether the main query is for a category archive, optionally of given categories by ID, name or slug.
guide_go( '/?cat=1' );
return array( is_category(), is_category( 'uncategorized' ), is_category( 'news' ) );
