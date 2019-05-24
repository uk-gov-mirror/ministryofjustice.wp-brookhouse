<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package brookhouse
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>

    <?php if ($_SERVER["SERVER_NAME"] == "brookhouseinvestigations.independent.gov.uk") { ?>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-46373102-1', 'independent.gov.uk');
            ga('send', 'pageview');

        </script>
    <?php } ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <?php do_action('before'); ?>

    <section id="topbar">
        <div class="site-branding flex-grid">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col">
                <a href="/talk-to-us" class="button"><span><?php _e('Talk to us', 'brookhouse') ?></span></a>
            </div>
        </div>
    </section>

    <nav id="site-navigation" class="main-navigation" role="navigation">
        <h1 class="menu-toggle"></h1>
        <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'brookhouse'); ?></a>

        <?php //wp_nav_menu( array( 'theme_location' => 'primary' ) );  ?>
    </nav><!-- #site-navigation -->
    <header id="masthead" class="site-header" role="banner">
        <div class="site-branding flex-grid">
            <div class="col shrink-two">
                <a href="<?= esc_url(home_url('/')); ?>" rel="home"><img
                        src="<?= get_template_directory_uri(); ?>/dist/img/ppo-logo.svg"
                        alt="<?php bloginfo('name'); ?>"></a>
            </div>
            <div class="site-title col grow-five">
                <p><?= get_bloginfo(); ?></p>
            </div>
            <div class="bh-languages col grow-one">
                <ul data-locale="<?= get_locale() ?>">
                    <li data-locale="en_GB"><a href="<?= moj_get_page_uri() ?>/?locale=en_GB">English (UK)</a></li>
                    <li data-locale="es_ES"><a href="<?= moj_get_page_uri() ?>/?locale=es_ES">Español</a></li>
                    <li data-locale="ur"><a href="<?= moj_get_page_uri() ?>/?locale=ur">اردو</a></li>
                    <li data-locale="ro_RO"><a href="<?= moj_get_page_uri() ?>/?locale=ro_RO">Românească</a></li>
                </ul>
            </div>
        </div>
    </header><!-- #masthead -->
    <?php if (is_front_page()) { ?>
        <section id="tagline">
            <div class="site-branding tagline">
                <?php _e('An independent investigation into the potential mistreatment of detainees at Brook House IRC in 2017', 'brookhouse'); ?>
            </div>
        </section>
    <?php } ?>
    <section id="breadcrumbs-wrapper">
        <div id="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">Home</a>
                </li>
                <?php
                if (!is_home()) {
                    foreach (get_post_ancestors($post->ID) as $ancestor_id) {
                        echo "<li class='breadcrumb-child'><a href='" . get_permalink($ancestor_id) . "'>" . get_the_title($ancestor_id) . "</a></li>";
                    }
                    if (is_archive()) {
                        echo "<li class='breadcrumb-child'><a href='" .
                            get_post_type_archive_link(
                                $wp_query->query['post_type']
                            ) . "'>" .
                            post_type_archive_title(
                                '',
                                false
                            ) . "</a></li> ";
                        if (is_post_type_archive('evidence') && get_query_var('witness')) {
                            $witness = get_term_by('slug', get_query_var("witness"), "witness");
                            echo "<li class='breadcrumb-child'><a href='" .
                                get_permalink(
                                    get_page_by_title(
                                        'evidence'
                                    )
                                ) . "?witness=" . get_query_var('witness') . "'> Witness: " . $witness->name . "</a></li>";
                        } elseif (is_post_type_archive('evidence') && get_query_var('hdate')) {
                            echo "<li class='breadcrumb-child'><a href='" .
                                get_permalink(
                                    get_page_by_title(
                                        'evidence'
                                    )
                                ) . "?hdate=" .
                                get_query_var(
                                    'hdate'
                                ) . "'> Date: " .
                                date(
                                    'l j F Y',
                                    strtotime($_GET['hdate'])
                                ) . "</a></li>";
                        }
                    } else {
                        if (is_search()) {
                            echo "<li class='breadcrumb-child'>Search Results for: " . get_search_query() . "</li>";
                        } else {
                            if (is_singular('hearing')) {
                                echo "<li class='breadcrumb-child'><a href='" . get_permalink(get_page_by_title('hearings')) . "'>Hearings</a> </li>";
                            }
                            echo "<li class='breadcrumb-child'><a href='" . get_permalink() . "'>" . get_the_title() . "</a></li>";
                        }
                    }
                }
                ?>
            </ul>
        </div>
    </section>

    <div id="content" class="site-content">
