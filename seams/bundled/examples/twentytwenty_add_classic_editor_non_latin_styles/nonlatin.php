<?php
// Adds the localized font CSS to the classic editor's content_style, for languages that need other fonts; on tiny_mce_before_init.
guide_theme( 'twentytwenty' );
$english = twentytwenty_add_classic_editor_non_latin_styles( array() );
function guide_japanese_locale( $locale ) {
	return 'ja';
}
add_filter( 'locale', 'guide_japanese_locale' );
return array( $english, isset( twentytwenty_add_classic_editor_non_latin_styles( array() )['content_style'] ) );
