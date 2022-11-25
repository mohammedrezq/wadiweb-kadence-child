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

$terms = get_terms('docs-category');

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
						$slides = carbon_get_the_post_meta( 'crb_slides' );
						// $slides = carbon_get_post_meta(get_the_ID(), 'crb_slides');
						echo '<ul>';
						foreach ( $slides as $slide ) {
							echo '<li>';
							echo wp_get_attachment_image( $slide['image'] );
							echo '<h2 style="color: ' . $slide['color'] . '">' . $slide['title'] . '</h2>';
							echo '</li>';
						}
						echo '</ul>';
						/**
						 * Hook in content single entry template.
						 */
						do_action( 'kadence_single_content' );
						if(count($terms) > 0 ) :
							echo '<div>';
							foreach ($terms as $key => $term) {
								echo '<span><a href="'.get_term_link($term->slug, 'docs-category').'">'.$term->name.'</a></span>';
								if ($key === array_key_last($terms)) {
									echo '';
								}else {
									echo ' | ';
								}
							}
							echo '</div>';
						endif;
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