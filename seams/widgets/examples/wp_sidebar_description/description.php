<?php
// A sidebar's description, with only the tags sidebar descriptions allow, or null.
register_sidebar( array( 'id' => 'side', 'description' => 'Shown <strong>beside</strong> posts <script>x</script>' ) );
return array( wp_sidebar_description( 'side' ), wp_sidebar_description( 'none' ) );
