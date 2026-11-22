<?php
// Removes a registered block style variation.
register_block_style( 'core/quote', array( 'name' => 'fancy', 'label' => 'Fancy' ) );
return array( unregister_block_style( 'core/quote', 'fancy' ), unregister_block_style( 'core/quote', 'fancy' ) );
