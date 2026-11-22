<?php
// Gives a rich or video embed's iframe a title attribute: its own, else the oEmbed title; oembed_iframe_title_attribute filters it.
$data = (object) array( 'type' => 'video', 'title' => 'My clip' );
return array( wp_filter_oembed_iframe_title_attribute( '<iframe src="https://v.example/1"></iframe>', $data, 'https://v.example' ), wp_filter_oembed_iframe_title_attribute( '<iframe TITLE="Own" src="x"></iframe>', $data, 'u' ), wp_filter_oembed_iframe_title_attribute( '<img src="x">', (object) array( 'type' => 'photo' ), 'u' ) );
