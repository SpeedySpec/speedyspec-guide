<?php
// TinyMCE's interface strings in the site's language, as JSON or as the tinymce.addI18n() call; strings the same as TinyMCE's own English are left out, so in English only WordPress's differing labels remain. wp_mce_translation filters them.
function guide_add_mce_string( $strings, $locale ) {
	return $strings + array( 'Guide' => 'Guide label' );
}
add_filter( 'wp_mce_translation', 'guide_add_mce_string', 10, 2 );
$json = json_decode( _WP_Editors::wp_mce_translation( 'en', true ), true );
return array( count( $json ), $json['Guide'], substr( _WP_Editors::wp_mce_translation( 'en' ), 0, 22 ) );
