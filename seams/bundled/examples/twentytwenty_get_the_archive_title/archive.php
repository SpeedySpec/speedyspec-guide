<?php
// Wraps the archive title's prefix, up to the colon, in an accent span; twentytwenty_get_the_archive_title_regex filters the pattern. On get_the_archive_title.
guide_theme( 'twentytwenty' );
return twentytwenty_get_the_archive_title( 'Category: News' );
