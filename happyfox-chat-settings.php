<div class='hfc-settings'>
    <div class='header'>
        <img class='logo' src="<?php echo WP_PLUGIN_URL . '/happyfox-chat/images/happyfox.png' ?>" alt="HappyFox Chat" />

        <div class='content'>
            <h1>HappyFox Chat settings</h1>
            <p>Congratulations on successfully installing the HappyFox Chat plugin.</p>
            <p>HappyFox Chat is a live chat software. You need to get your API key to set up this plugin.</p>
            <p>Sign in to your HappyFox Chat account, copy your API key from the <a href="https://happyfoxchat.com/a/apps/wordpress/manage/" target="_blank">WordPress App</a> page and paste it here</p>
        </div>
    </div>
    <hr class='line-break'/>
    <form class="hfc-form" name="hfc-form" method="POST" action="">
        <label for="hfc_api_key">Wordpress API key: </label>
        <input type="text" id="hfc_api_key" name="hfc_api_key" value="<?php echo get_option('hfc_api_key') ?>"/>
        <span id="status">
        </span>
        <input type="hidden" name="hfc_api_key_submission" value="1" />

        <button class='btn-submit' type="submit" name="Submit" value="Connect with HappyFox Chat" >
            Connect with HappyFox Chat
        </button>
    </form>
    <div class='footer-text'>
        <p id="homepage_helper" class="<?php if (!get_option('hfc_api_key')) echo 'hide'; ?>">Visit your <a href="<?php echo home_url() ?>" target="_blank">homepage</a> to see HappyFox Chat in action.</p>
        <p>Click <a href="https://happyfoxchat.com/a/apps/wordpress/manage/" target="_blank">here</a> to get your API key. New user? <a href="https://happyfoxchat.com/product-hunt-signup?ref=wordpress-plugin" target="_blank">Sign up</a> here for a free HappyFox Chat account.</p>
        <p>Questions? Come <a href="https://happyfoxchat.com/?ref=wordpress-plugin" target="_blank">chat with us</a> or <a href="mailto:support@happyfoxchat.com">send us an email</a>.
    </div>
    <hr class='line-break'/>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('form').submit(function(e) {
            e.preventDefault();
            form = jQuery(this);
            form_data = form.serialize();
            url = form.attr('action');
            submitButton = form.find('button[type="submit"]')
            submitText = submitButton.text();
            submitButton.text('Connecting with HappyFox Chat');
            jQuery.ajax({
                type: 'POST',
                url: url,
                data: form_data,
                success: function() {
                    jQuery('#status').attr('class', 'success')
                        .text('You\'re all set to chat!');
                    jQuery('#homepage_helper').removeClass('hide');
                },
                error: function() {
                    jQuery('#status').attr('class', 'error')
                        .text('Your API key seems invalid');
                },
                complete: function() {
                    submitButton.text(submitText);
                }
            });
        });
    });
</script>
