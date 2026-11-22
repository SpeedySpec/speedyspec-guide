<?php
// Asks the WordPress.org Plugins API for a plugin's information, a search or the popular tags; plugins_api_args, plugins_api and plugins_api_result filter it.
guide_queue_http( array( array( 'name' => 'Hello Dolly', 'slug' => 'hello-dolly', 'version' => '1.7.2' ) ) );
$info = plugins_api( 'plugin_information', array( 'slug' => 'hello-dolly' ) );
return array( $info->name, $info->version );
