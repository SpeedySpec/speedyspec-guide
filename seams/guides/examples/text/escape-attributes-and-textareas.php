<?php
// The same stored value, printed into three places, each with the escaping function made for it.
function my_plugin_render_bio_field( $bio ) {
	return '<label for="my-plugin-bio">' . esc_html__( 'About you', 'my-plugin' ) . '</label>'
		. '<input type="hidden" name="my_plugin_bio_preview" value="' . esc_attr( $bio ) . '" />'
		. '<textarea id="my-plugin-bio" name="my_plugin_bio">' . esc_textarea( $bio ) . '</textarea>';
}
return my_plugin_render_bio_field( "Fan of \"Dune\" & <b>sci-fi</b>.\nSee &amp; read." );
