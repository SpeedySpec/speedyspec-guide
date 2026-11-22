<?php
// A processor can't be unserialized.
try {
	unserialize( serialize( new WP_HTML_Tag_Processor( '<p>' ) ) );
} catch ( LogicException $e ) {
	return $e->getMessage();
}
