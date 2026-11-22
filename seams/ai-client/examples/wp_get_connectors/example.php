<?php
// The registered connectors (AI providers, spam filtering and others), by ID, each with its name, type, plugin and authentication.
$connectors = wp_get_connectors();
return array_keys( $connectors );
