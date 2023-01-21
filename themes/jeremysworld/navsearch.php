<?php
/**
 * The navsearch containing the nav menu and the search bar
 *
 * @package WordPress
 * @subpackage Jeremys_World
 * @since Jeremy's World 1.0
 */
if ( is_active_sidebar( 'search-box' ) ) : ?>
    <div id="widget-area" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'search-box' ); ?>
    </div><!-- .widget-area -->
<?php endif; ?>

<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
    <?php if ( has_nav_menu( 'primary' ) ) : ?>
        <nav id="site-navigation" class="main-navigation">
            <?php
                // Primary navigation menu.
                wp_nav_menu(
                    array(
                        'menu_class'     => 'nav-menu',
                        'theme_location' => 'primary',
                    )
                );
            ?>
        </nav><!-- .main-navigation -->
    <?php endif; ?>

    <?php if ( has_nav_menu( 'social' ) ) : ?>
        <nav id="social-navigation" class="social-navigation">
            <?php
                // Social links navigation menu.
                wp_nav_menu(
                    array(
                        'theme_location' => 'social',
                        'depth'          => 1,
                        'link_before'    => '<span class="screen-reader-text">',
                        'link_after'     => '</span>',
                    )
                );
            ?>
        </nav><!-- .social-navigation -->
    <?php endif; ?>

<?php endif; ?>
