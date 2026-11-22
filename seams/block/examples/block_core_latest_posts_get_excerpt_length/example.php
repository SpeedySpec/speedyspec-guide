<?php
// Hooked to excerpt_length while the Latest Posts block renders: its chosen excerpt length.
$GLOBALS['block_core_latest_posts_excerpt_length'] = 20;
return block_core_latest_posts_get_excerpt_length();
