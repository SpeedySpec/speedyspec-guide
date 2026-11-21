<?php
// On WordPress, setting callbacks after reading them replaces them: the hook has none left.
add_filter( 'guide_set', 'trim' );
$hook = $GLOBALS['wp_filter']['guide_set'];
$hook->callbacks;
$hook->callbacks = array();

return has_filter( 'guide_set' );
