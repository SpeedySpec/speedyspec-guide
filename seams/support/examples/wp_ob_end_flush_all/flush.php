<?php
// Flushes and ends every output buffer that can be flushed; attached to shutdown.
ob_start();
echo 'buffered';
$level = ob_get_level();
wp_ob_end_flush_all();
return ob_get_level() < $level;
