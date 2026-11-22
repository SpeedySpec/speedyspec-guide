<?php
// wp_plugin_dependencies_slug can change each slug, such as mapping a premium plugin to its free one; invalid slugs are dropped.
function guide_free_plugin_slug( $slug ) {
	return 'pro-forms' === $slug ? 'forms' : $slug;
}
add_filter( 'wp_plugin_dependencies_slug', 'guide_free_plugin_slug' );
return guide_call( 'WP_Plugin_Dependencies', 'sanitize_dependency_slugs', ' zeta, pro-forms , Bad_Slug, alpha,zeta,, -x' );
