<?php
// On SpeedySpec, the copy read first is written back over the new value: the callback is still there.
add_filter( 'guide_set', 'trim' );
$hook = $GLOBALS['wp_filter']['guide_set'];
$hook->callbacks;
$hook->callbacks = array();

return has_filter( 'guide_set' );
