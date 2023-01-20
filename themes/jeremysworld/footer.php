<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Jeremys_World
 * @since Jeremy's World 1.0
 */
?>

	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<?php
				/**
				 * Fires before the Jeremy's World footer text for footer customization.
				 *
				 * @since Jeremy's World 1.0
				 */
				do_action( 'jeremysworld_credits' );
			?>
			<?php
			if ( function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
			}
			?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'jeremysworld' ) ); ?>" class="imprint">
				<?php
				/* translators: %s: WordPress */
				printf( __( 'Proudly powered by %s', 'jeremysworld' ), 'WordPress' );
				?>
			</a>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
