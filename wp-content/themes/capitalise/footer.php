<?php
/**
 * Default Footer Template
 *
 * @package PlugFramework
 * @subpackage Artcore
 */
 ?>
<footer>
    <div class="footer-widgets">
        <div class="container">
            <div class="row">
                <?php if ( is_active_sidebar( 'ptf-footer-area-1' ) ) : ?>
                    <div class="col-md-3 col-sm-6">
                        <?php dynamic_sidebar( 'ptf-footer-area-1' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'ptf-footer-area-2' ) ) : ?>
                    <div class="col-md-3 col-sm-6">
                        <?php dynamic_sidebar( 'ptf-footer-area-2' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'ptf-footer-area-3' ) ) : ?>
                    <div class="col-md-3 col-sm-6">
                        <?php dynamic_sidebar( 'ptf-footer-area-3' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'ptf-footer-area-4' ) ) : ?>
                    <div class="col-md-3 col-sm-6">
                        <?php dynamic_sidebar( 'ptf-footer-area-4' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">                
                 <div class="col-sm-12"></div><p style="float:right;"><a href="http://wardsoft.co.uk/" style="font-weight: bold;">Website Designed by Wardsoft</a></p>
            </div>
        </div>
    </div>
</footer>

<a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>

</div>

</div>
<nav class="sidebar-menu slide-from-left">
    <div class="nano">
        <div class="content">
            <nav class="responsive-menu">
                <?php
                    if ( has_nav_menu( 'header_main_menu' ) ) :
                       $mobile_menu = array(
                                  'container' => 'ul',
                                  'menu_class' => '',
                                  'menu_id' => '',
                                  'depth' => 0,
                                  'theme_location' => 'header_main_menu',
                               );
                       wp_nav_menu( $mobile_menu );
                    endif;
                ?>
            </nav>
        </div>
    </div>
</nav>
</div>
<?php wp_footer(); ?>
</body>
</html>