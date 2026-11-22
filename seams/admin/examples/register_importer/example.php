<?php
// Registers an importer for Tools → Import, with its name, description and callback.
function guide_tea_importer(): void
{
	echo '<p>Import teas.</p>';
}
register_importer( 'guide-tea', 'Tea list', 'Imports a list of teas.', 'guide_tea_importer' );
return get_importers()['guide-tea'][0];
