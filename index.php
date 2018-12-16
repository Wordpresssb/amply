<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package amply
 */

get_header(); ?>

<div id="content" class="site-content">

	<?php do_action( 'amply_before_main' ); ?>

	<main id="main" class="site-main">

		<?php do_action( 'amply_content_loop' ); ?>

					<?php
					/**
					 * Tests
					 */
					if ( is_front_page() ) :
						?>
						<div id="primary-dark" style="height:100px;"></div>
						<div id="primary" style="height:2000px;text-align:right;padding:100px;">
							<span id="btn" style="font-size: 30px;padding: 15px 20px;border-style: solid;border-width: 3px;;border-radius: 50px;">+</span>
						</div>
						<div id="primary-light" style="height:100px;"></div>
					<?php endif ?>

	</main><!-- #main -->

	<?php do_action( 'amply_after_main' ); ?>

</div><!-- #content -->

<?php
get_footer();
