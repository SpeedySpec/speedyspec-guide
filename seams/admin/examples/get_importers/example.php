<?php
// The registered importers, by ID, sorted by name.
function guide_tea_importer(): void
{
	echo '<p>Import teas.</p>';
}
register_importer( 'guide-tea', 'Tea list', 'Imports a list of teas.', 'guide_tea_importer' );
return array_keys( get_importers() );
