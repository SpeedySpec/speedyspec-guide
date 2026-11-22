<?php
// An empty widget list for each registered sidebar.
register_sidebar( array( 'id' => 'side', 'name' => 'Side' ) );
register_sidebar( array( 'id' => 'footer' ) );
return wp_get_widget_defaults();
