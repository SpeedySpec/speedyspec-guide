<?php
// Hooked to wp_privacy_personal_data_exporters: adds the comments exporter.
return array_keys( wp_register_comment_personal_data_exporter( array() ) );
