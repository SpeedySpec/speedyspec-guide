<?php
// The styles and scripts the iframed editor loads, as markup, gathered by printing the block assets.
$assets = _wp_get_iframed_editor_assets();
return array_keys( $assets );
