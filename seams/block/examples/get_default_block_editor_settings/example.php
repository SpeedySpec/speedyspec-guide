<?php
// The editor's default settings: upload limits, image sizes, alignWide, color and font size defaults, and the rest; filtered by block_editor_settings_all later.
$s = get_default_block_editor_settings();
return array( isset( $s['maxUploadFileSize'] ), $s['alignWide'], array_column( $s['imageSizes'], 'slug' ) );
