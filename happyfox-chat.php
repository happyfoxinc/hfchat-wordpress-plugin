<?php
/**
 * Plugin Name: HappyFox Chat
 * Plugin URI: https://happyfoxchat.com/wordpress
 * Description: This plugin adds the HappyFox Chat widget to your WordPress blog
 * Version: 1.1.0
 * Author: HappyFox Inc.
 * Author URI: http://happyfoxchat.com
 * License: MIT
 */

add_action('init', 'hfc_setup_widget');
add_action('admin_init', 'hfc_register_settings' );
add_action('admin_menu', 'hfc_admin_menu');
add_action('wp_footer', 'hfc_add_visitor_widget' );

function hfc_register_settings() {
    register_setting('happyfox-chat-settings', 'hfc_api_key');
    register_setting('happyfox-chat-settings', 'hfc_embed_token');
    register_setting('happyfox-chat-settings', 'hfc_access_token');
}

function hfc_admin_menu() {
    add_menu_page('HappyFox Chat Settings', 'HappyFox Chat', 'administrator', 'happyfox-chat-settings', 'happyfox_chat_settings_page', 'dashicons-format-chat');
    wp_enqueue_style('happyfox-chat-settings', WP_PLUGIN_URL . '/happyfox-chat/css/style.css');
}

function happyfox_chat_settings_page() {
   include('happyfox-chat-settings.php');
}

function hfc_setup_widget() {
  if( !session_id() )
    session_start();
  if (isset( $_POST['hfc_api_key_submission'] ) && $_POST['hfc_api_key_submission'] == '1') {
    $url = 'https://www.happyfoxchat.com/api/v1/integrations/wordpress/widget-info?apiKey='. $_POST['hfc_api_key'];
    $result = wp_remote_get($url);
    $authorization_success = False;
    $json = json_decode($result['body']);
    if(isset($json->embedToken)) {
        update_option('hfc_api_key', $_POST['hfc_api_key']);
        update_option('hfc_embed_token', $json->embedToken);
        update_option('hfc_access_token', $json->accessToken);
        $authorization_success = True;
    }
    if(!$authorization_success) {
        status_header(400);
    }
  }
}

function hfc_add_visitor_widget() {
    $embed_token = get_option('hfc_embed_token');
    $access_token = get_option('hfc_access_token');

    if($embed_token && $access_token) {
        echo <<<HTML
<!--Start of HappyFox Live Chat Script-->
<script>
 window.HFCHAT_CONFIG = {
     EMBED_TOKEN: "{$embed_token}",
     ACCESS_TOKEN: "{$access_token}",
     HOST_URL: "https://www.happyfoxchat.com",
     ASSETS_URL: "https://d1l7z5ofrj6ab8.cloudfront.net/visitor"
 };

(function() {
  var scriptTag = document.createElement('script');
  scriptTag.type = 'text/javascript';
  scriptTag.async = true;
  scriptTag.src = window.HFCHAT_CONFIG.ASSETS_URL + '/js/widget-loader.js';

  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(scriptTag, s);
})();
</script>
<!--End of HappyFox Live Chat Script-->

HTML;
    }
}

?>
