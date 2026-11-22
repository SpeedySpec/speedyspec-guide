<?php
// Creates a new site's default content: the Uncategorized category, the first post and comment, the sample page and the privacy policy draft, and the default widgets.
wp_install_defaults( 1 );
return wp_list_pluck( get_posts( array( 'post_type' => array( 'post', 'page' ), 'post_status' => 'any', 'numberposts' => -1, 'orderby' => 'ID', 'order' => 'ASC' ) ), 'post_title' );
