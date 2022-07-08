<?php
/**
 * The main single item template file.
 *
 * @package kadence
 */

namespace Kadence;

/**
* Hook for Hero Section
*/

get_header();
?>
<div id="primary" class="content-area">
	<div class="content-container site-container wadi_doc_container">
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
						/**
						 * Hook in content single entry template.
						 */
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
		<aside class="wadi_doc_sidebar">
			<div class="wadi_doc_categories_container">
				<?php
				get_sidebar('doc');
				?>
			</div>
		</aside>
	</div>
</div><!-- #primary -->
<?php
get_footer();
?>