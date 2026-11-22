<?php
// The title of the term archive queried, filtered by single_cat_title, single_tag_title or single_term_title.
guide_go( '/?cat=1' );
return single_term_title( '', false );
