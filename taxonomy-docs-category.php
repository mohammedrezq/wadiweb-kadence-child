<?php
/**
 * Docs Cateory Template
 *
 * @package kadence
 */

 
namespace Kadence;



get_header();
$pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-doc.php'
));

$doc_page = '';
foreach($pages as $page){
    
    $doc_page .= get_permalink($page->ID);
}

?>
<div class="wadi_taxonomies_docs_container">

<div class="go_back_to_main_page_button">
		<a href="<?php
        echo wp_kses_post($doc_page);
        ?>">
			&larr; Go Back to <?php echo wp_kses_post($page->post_title); ?>
		</a>
	</div>
	<div class="wadi_docs_categories_heading">
		<h1><?php 
        $term = get_queried_object();
        echo wp_kses_post($term->name); ?></h1>
	</div>

    <div class="wadi_taxonomies_docs_container_category_docs">
<?php
// Check if current page is a docs category page
if (is_tax('docs-category')) {
    
    // Get current category
    $current_cat = get_queried_object();
        
    // Get all docs posts for current category
    $args = array(
        'post_type' => 'doc',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'docs-category',
                'field' => 'slug',
                'terms' => $current_cat->slug,
            ),
        ),
    );
    
    $docs = get_posts($args);
    
    
    echo '<div class="wadi_docs_container">';
    
    
    foreach ($docs as $doc) : ?>
    
    
        <div class="wadi_doc_box_container">
            <a href="<?php echo get_permalink($doc->ID) ?>">
            <?php echo $doc->post_title; ?>
            </a>
        </div>
    
    
    <?php
    endforeach;
}

 echo "</div>";
get_sidebar('doc'); ?>
</div>
</div>

<?php get_footer();

