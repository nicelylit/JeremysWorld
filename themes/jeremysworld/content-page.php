<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Jeremys_World
 * @since Jeremy's World 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		jeremysworld_post_thumbnail();
	?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<nav class="entry-nav">
		<?php jeremysworld_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'jeremysworld' ), '<span class="edit-link">', '</span>' ); ?>
	</nav><!-- .entry-nav -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'jeremysworld' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'jeremysworld' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				)
			);
			?>
		<?php if ( get_the_ID() === 947 && function_exists('simpleYearlyArchive') ) :
			simpleYearlyArchive();
		endif; ?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
