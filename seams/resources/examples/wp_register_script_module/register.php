<?php
// Registers a script module by ID with its source, dependencies (static, or dynamic for lazy imports), version and arguments; enqueued, it prints as a module script, and its dependencies go in the import map.
wp_register_script_module( '@guide/lazy', 'https://cdn.example/lazy.js', array(), '1.0' );
wp_register_script_module( '@guide/app', 'https://cdn.example/app.js', array( array( 'id' => '@guide/lazy', 'import' => 'dynamic' ) ), '1.0' );
wp_enqueue_script_module( '@guide/app' );
$modules = guide_render( array( wp_script_modules(), 'print_enqueued_script_modules' ) );
$map = guide_render( array( wp_script_modules(), 'print_import_map' ) );
return array( $modules, $map );
