<?php
// A block asset path without its file: prefix; the path as given when it has none.
return array( remove_block_asset_path_prefix( 'file:./index.js' ), remove_block_asset_path_prefix( 'wp-blocks' ) );
