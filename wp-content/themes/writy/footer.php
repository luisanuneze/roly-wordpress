<!-- Start Footer -->
<footer class="writy_footer">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h3>
                <?php if( get_theme_mod( 'footer_text_block') != "" ): 
                echo esc_html(get_theme_mod( 'footer_text_block'));
               endif;
                ?>
                </h3>

                <?php
                if ( has_nav_menu( 'footer_menu' ) ) {
                wp_nav_menu(array(
                    'theme_location' => 'footer_menu',
                    'menu_id' => 'footer_menu',
                    'menu_class' => 'list-style-none d-inline-flex pl-0'
                ));
                }
                ?>

            </div>
        </div>
    </div>
</footer>
<!-- footer -->
<?php wp_footer(); ?>


</body>

</html>