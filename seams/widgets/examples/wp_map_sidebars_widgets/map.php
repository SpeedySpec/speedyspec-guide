<?php
// Maps widgets to the registered sidebars: same IDs kept, a single old and new sidebar paired, common names (sidebar/primary/main/right, second/left, sidebar-2/footer/bottom, header/top) matched, the rest made inactive.
register_sidebar( array( 'id' => 'primary-sidebar' ) );
register_sidebar( array( 'id' => 'footer-area' ) );
return wp_map_sidebars_widgets( array( 'sidebar-1' => array( 'a-2' ), 'bottom' => array( 'b-2' ), 'weird' => array( 'c-2' ), 'orphaned_widgets_1' => array( 'd-2' ) ) );
