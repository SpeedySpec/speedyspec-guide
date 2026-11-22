<?php
// The handle WordPress gives a block's asset: core blocks wp-block-{name}, others {namespace}-{name}-{field}, numbered after the first.
return array( generate_block_asset_handle( 'core/paragraph', 'style' ), generate_block_asset_handle( 'guide/notice', 'editorScript' ), generate_block_asset_handle( 'guide/notice', 'viewScript', 1 ) );
