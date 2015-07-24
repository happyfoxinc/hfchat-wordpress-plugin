<div class='hfc-settings'>
    <div class='header'>
        <img class='logo' src="<?php echo WP_PLUGIN_URL . '/happyfox-chat/images/happyfox.png' ?>" alt="HappyFox Chat" />

        <div class='content'>
            <h1>HappyFox Chat settings</h1>
            <p>Congratulations on successfully installing the HappyFox Chat plugin.</p>
            <p>HappyFox Chat is a live chat software. You need to get your API key to set up this plugin.</p>
            <p>Sign in to your HappyFox Chat account, copy your API key from the <a href="https://happyfoxchat.com/a/apps/wordpress/manage/" target="_blank">Wordpress App</a> page and paste it here</p>
        </div>
    </div>
    <hr class='line-break'/>
    <form class="hfc-form" name="hfc-form" method="POST" action="">
        <label for="hfc_api_key">Wordpress API key: </label>
        <input type="text" id="hfc_api_key" name="hfc_api_key" value="<?php echo get_option('hfc_api_key') ?>"/>
        <span class='error'>
        <?php
            if(isset($_SESSION['error'])) {
                $error = $_SESSION['error'];
                if($error != "") {
                    echo $error;
                }
                $_SESSION['error'] = "";
            }
        ?>
        </span>
        <input type="hidden" name="hfc_api_key_submission" value="1" />

        <button class='btn-submit' type="submit" name="Submit" value="Connect with HappyFox Chat" >
        Connect with HappyFox Chat
        </button>
    </form>
    <div class='footer-text'>
        <p>Click <a href="https://happyfoxchat.com/a/apps/wordpress/manage/" target="_blank">here</a> to get your API key. New user? <a href="https://happyfoxchat.com/signup?ref=wordpress-plugin" target="_blank">Sign up</a> here for a free HappyFox Chat account.</p>
        <p>Questions? Come <a href="https://happyfoxchat.com/?ref=wordpress-plugin" target="_blank">chat with us</a> or <a href="mailto:support@happyfoxchat.com">send us an email</a>.
    </div>
    <hr class='line-break'/>
</div>
