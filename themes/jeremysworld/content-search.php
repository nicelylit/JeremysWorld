<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://developer.wordpress.org/themes/basics/template-hierarchy/}
 *
 * @package WordPress
 * @subpackage Jeremys_World
 * @since Jeremy's World 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php jeremysworld_post_thumbnail(); ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( 'post' === get_post_type() ) : ?>

		<nav class="entry-nav">
			<?php jeremysworld_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'jeremysworld' ), '<span class="edit-link">', '</span>' ); ?>
		</nav><!-- .entry-nav -->

	<?php else : ?>

		<?php edit_post_link( __( 'Edit', 'jeremysworld' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

	<?php endif; ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

</article><!-- #post-<?php the_ID(); ?> -->
