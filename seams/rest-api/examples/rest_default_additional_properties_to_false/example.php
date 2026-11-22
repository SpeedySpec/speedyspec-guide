<?php
// Sets additionalProperties to false on a schema's objects that don't say, recursively.
return rest_default_additional_properties_to_false( array( 'type' => 'object', 'properties' => array( 'inner' => array( 'type' => 'object' ) ) ) );
