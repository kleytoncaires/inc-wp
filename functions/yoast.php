<?php


// ----------- 
// MOVE YOAST TO THE BOTTOM IN ADMIN
// -----------
function yoasttobottom()
{
    return 'low';
}
add_filter('wpseo_metabox_prio', 'yoasttobottom');

// ----------- 
// YOAST SOCIAL LINKS
// -----------

/**
 * Social Links
 * Uses Social URLs specified in Yoast SEO. See SEO > Social
 *
 */
function ea_social_links()
{

    $options = array(

        // FONT AWESOME
        // 'linkedin'         => array(
        //     'key'         => 'linkedin_url',
        //     'icon'         => '<i class="fab fa-linkedin-in"></i>',
        // ),
        // 'youtube'         => array(
        //     'key'         => 'youtube_url',
        //     'icon'         => '<i class="fab fa-youtube"></i>',
        // ),
        // 'instagram'     => array(
        //     'key'         => 'instagram_url',
        //     'icon'         => '<i class="fab fa-instagram"></i>',
        // ),
        // 'facebook'         => array(
        //     'key'         => 'facebook_site',
        //     'icon'         => '<i class="fab fa-facebook-f"></i>',
        // ),
        // 'twitter'         => array(
        //     'key'         => 'twitter_site',
        //     'prepend'     => 'https://twitter.com/',
        //     'icon'         => '<i class="fab fa-twitter"></i>',
        // ),
        // 'pinterest'     => array(
        //     'key'         => 'pinterest_url',
        //     'icon'         => '<i class="fab fa-pinterest-p"></i>',
        // ),

        // DASHICONS
        'facebook'         => array(
            'key'         => 'facebook_site',
            'icon'         => '<i class="dashicons-facebook"></i>',
        ),
        'twitter'         => array(
            'key'         => 'twitter_site',
            'prepend'     => 'https://twitter.com/',
            'icon'         => '<i class="dashicons-twitter"></i>',
        ),
        'instagram'     => array(
            'key'         => 'instagram_url',
            'icon'         => '<i class="dashicons-instagram"></i>',
        ),
        'linkedin'         => array(
            'key'         => 'linkedin_url',
            'icon'         => '<i class="dashicons-linkedin"></i>',
        ),
        'pinterest'     => array(
            'key'         => 'pinterest_url',
            'icon'         => '<i class="dashicons-pinterest"></i>',
        ),
        'youtube'         => array(
            'key'         => 'youtube_url',
            'icon'         => '<i class="dashicons-youtube"></i>',
        ),
    );

    $options = apply_filters('ea_social_link_options', $options);

    $output = array();

    $seo_data = get_option('wpseo_social');
    foreach ($options as $social => $settings) {

        $url = !empty($seo_data[$settings['key']]) ? $seo_data[$settings['key']] : false;
        if (!empty($url) && !empty($settings['prepend']))
            $url = $settings['prepend'] . $url;

        if ($url && !empty($settings['icon']))
            $output[] = '<a href="' . esc_url_raw($url) . '" target="_blank" rel="noopener">' . $settings['icon'] . '<span class="sr-only sr-only-focusable">' . $social . '</span></a>';
    }

    if (!empty($output))
        // return '<div class="social-links">' . join(' ', $output) . '</div>';
        return '<span class="footer-follow">' . __('Siga nas redes', 'YSSY') . '</span><div class="social-links">' . join(' ', $output) . '</div>';
}
add_shortcode('social_links', 'ea_social_links');
