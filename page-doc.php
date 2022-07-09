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


?>
<div class="wadi_docs_container">
	<div class="go_back_to_main_page_button">
		<a href="<?php echo get_home_url() ?>">
			&larr; Go Back to Main Page
		</a>
	</div>
	<div class="wadi_docs_categories_heading">
		<h1><?php echo wp_kses_post(get_the_title()); ?></h1>
	</div>
	<div class="wadi_docs_categories">
<?php


foreach ($cats as $cat) : ?>


	<div class="wadi_doc_box_container">
		<a href="<?php echo get_category_link($cat->term_id) ?>">
		<?php echo $cat->name; ?>
		</a>
	</div>


<?php
endforeach;

?>
	</div>
</div>
<?php
	


get_footer();
