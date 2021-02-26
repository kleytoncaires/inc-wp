<header class="headerMenu" id="headerMenu">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <a href="<?php echo site_url(); ?>" class="headerMenu-logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png">
            </a>
            <?php
            wp_nav_menu(array(
                'container' => 'nav',
                'theme_location' => 'header-nav'
            ));
            ?>
        </div>
    </div>
</header>