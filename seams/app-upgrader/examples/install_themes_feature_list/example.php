<?php
// Gives the old theme installer's feature list from the Themes API, cached for three hours. Deprecated.
guide_queue_http( array( array( 'Colors' => array( 'black' => 'Black' ) ) ) );
return install_themes_feature_list();
