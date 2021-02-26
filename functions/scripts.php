<?php

// ----------- 
// DISABLE BLOCK LIBRARY
// -----------
function wpassist_remove_block_library_css()
{
    wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'wpassist_remove_block_library_css');

// ----------- 
// LOAD DASHICONS
// -----------
function ww_load_dashicons()
{
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'ww_load_dashicons');

// ----------- 
// REMOVE DASHICONS
// -----------
// function wpdocs_dequeue_dashicon()
// {
//     if (current_user_can('update_core')) {
//         return;
//     }
//     wp_deregister_style('dashicons');
// }
// add_action('wp_enqueue_scripts', 'wpdocs_dequeue_dashicon');

// ----------- 
// REMOVE JQUERY MIGRATE
// -----------
function remove_jquery_migrate($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];

        if ($script->deps) { // Check whether the script has any dependencies
            $script->deps = array_diff($script->deps, array(
                'jquery-migrate'
            ));
        }
    }
}

add_action('wp_default_scripts', 'remove_jquery_migrate');

// ----------- 
// REPLACE JQUERY VERSION
// -----------
function replace_core_jquery_version()
{
    wp_deregister_script('jquery');
    // Change the URL if you want to load a local copy of jQuery from your own server.
    wp_register_script('jquery', "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js", array(), '3.5.1');
}
add_action('wp_enqueue_scripts', 'replace_core_jquery_version');

// ----------- 
// REMOVE WP EMOJI
// -----------
function disable_wp_emojicons()
{
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
    add_filter('emoji_svg_url', '__return_false');
}
add_action('init', 'disable_wp_emojicons');

function disable_emojicons_tinymce($plugins)
{
    return is_array($plugins) ? array_diff($plugins, array('wpemoji')) : array();
}

// ----------- 
// ENQUEUE SCRIPTS
// -----------
function WP_scripts()
{
    wp_enqueue_script('jQuery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), '1.0.0', false);
    wp_enqueue_script('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js', array(), '1.0.0', false);
    wp_enqueue_script('jQueryMask', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js', array(), '1.0.0', false);
    wp_enqueue_script('fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array(), '1.0.0', false);
    wp_enqueue_script('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '1.0.0', false);
    wp_enqueue_script('output', get_template_directory_uri() . '/assets/js/plugins/output.min.js', array(), filemtime(get_template_directory() . '/assets/js/plugins/output.min.js'), false);
    wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', array(), filemtime(get_template_directory() . '/assets/js/custom.js'), false);
}
add_action('wp_enqueue_scripts', 'WP_scripts');