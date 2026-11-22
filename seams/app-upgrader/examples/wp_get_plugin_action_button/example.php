<?php
// The Install Now, Update Now, Activate or Installed button of a plugin card, from its status, its dependencies and whether it is compatible.
$api = array( 'name' => 'Hello Dolly', 'slug' => 'hello-dolly', 'version' => '1.7.2' );
return wp_get_plugin_action_button( 'Hello Dolly', $api, true, true );
