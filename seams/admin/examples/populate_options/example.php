<?php
// Adds the default options of a new site, such as siteurl, blogname and the date formats, over the values given; skips existing ones.
populate_options( array( 'blogdescription' => 'A tea journal' ) );
return array( get_option( 'blogdescription' ), get_option( 'date_format' ) );
