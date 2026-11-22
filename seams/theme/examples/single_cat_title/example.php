<?php
// The title of the category archive queried; single_term_title() for it.
guide_go( '/?cat=1' );
return single_cat_title( 'In: ', false );
