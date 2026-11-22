<?php
// Hooked to rest_pre_update_setting: blocks changing page_for_privacy_policy through REST (true, as if updated) for users who can't manage privacy options; other settings pass.
wp_set_current_user( 0 );
return array( rest_restrict_privacy_policy_page_setting_update( false, 'page_for_privacy_policy' ), rest_restrict_privacy_policy_page_setting_update( false, 'blogname' ) );
