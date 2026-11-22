<?php
// The registries, abilities and categories refuse to be serialized or unserialized.
try { serialize( WP_Abilities_Registry::get_instance() ); } catch ( LogicException $e ) { echo $e->getMessage(), "\n"; }
try { unserialize( 'O:21:"WP_Abilities_Registry":0:{}' ); } catch ( LogicException $e ) { echo $e->getMessage(), "\n"; }
return null;
