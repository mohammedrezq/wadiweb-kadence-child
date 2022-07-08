<?php
/**
 * Template Name: Docs Page
 *
 * @package kadence
 */

namespace Kadence;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Get All Docs Categories
$args = array(
	'taxonomy' => 'docs-category',
	'orderby' => 'name',
	'order'   => 'ASC',
	'hide_empty' => false,
);

$cats = get_terms($args);

echo '<div class="wadi_docs_container">';


foreach ($cats as $cat) : ?>


	<div class="wadi_doc_box_container">
		<a href="<?php echo get_category_link($cat->term_id) ?>">
		<?php echo $cat->name; ?>
		</a>
	</div>


<?php
endforeach;

echo '</div>';
	


get_footer();
