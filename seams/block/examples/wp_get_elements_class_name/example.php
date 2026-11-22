<?php
// A unique wp-elements-... class name, for scoping a block's element styles.
return (bool) preg_match( '/^wp-elements-[0-9a-f]+$/', wp_get_elements_class_name() );
