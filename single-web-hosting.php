<?php
/**
 * The main single item template file.
 *
 * @package kadence
 */

namespace Kadence;
get_header();

?>
<div id="web-hosting-primary" class="wadi-web-hosting-content-area">
	<div class="web-hosting-content-container web-hosting-site-container">
		<main id="main" class="site-main" role="main">
			<?php
			/**
			 * Hook for anything before main content
			 */
			do_action( 'kadence_before_main_content' );
			?>
			<div class="content-wrap">
				<?php
				if ( is_404() ) {
					do_action( 'kadence_404_content' );
				} elseif ( have_posts() ) {
					while ( have_posts() ) {
						the_post();

						do_action( 'kadence_single_content' );

					}
				} else {
					get_template_part( 'template-parts/content/error' );
				}
				?>
			</div>
			<?php			
			/**
			 * Hook for anything after main content
			 */
			do_action( 'kadence_after_main_content' );
			?>
		</main><!-- #main -->
	</div>
</div><!-- #primary -->

<?php
get_footer();
?>