<?php
// Prints the RSS widget's form fields: URL, title, item count (1 to 20, 10 by default) and display options; fields can be hidden or left out.
return substr( guide_render( fn() => wp_widget_rss_form( array( 'number' => 2, 'url' => 'https://feed.example/', 'items' => 50 ), array( 'show_author' => false, 'show_date' => 'hidden' ) ) ), 0, 900 );
