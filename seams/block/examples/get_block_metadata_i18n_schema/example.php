<?php
// Which block.json fields are translated and with what context, read once from block-i18n.json.
$schema = get_block_metadata_i18n_schema();
return array( $schema->title, $schema->keywords );
