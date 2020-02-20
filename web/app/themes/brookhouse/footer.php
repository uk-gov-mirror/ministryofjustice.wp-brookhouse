<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package brookhouse
 */
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <?php wp_nav_menu( array( 'theme_location' => 'languages-menu' ) ); ?>
    <div id="footer-nav">
        <?php wp_nav_menu(array('theme_location' => 'footer')); ?>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
    $(document).bind('touchend', function(e) {
        $(e.target).trigger('click');
    });
</script>

</body>
</html>
