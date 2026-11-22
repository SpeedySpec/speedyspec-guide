<?php
// Moves old top-level typography supports in block metadata (fontSize, lineHeight and the __experimental font ones) under supports.typography, with a notice.
return wp_migrate_old_typography_shape( array( 'supports' => array( 'fontSize' => true, 'color' => true ) ) )['supports'];
