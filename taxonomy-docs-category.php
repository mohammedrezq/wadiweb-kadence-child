<?php
/**
 * Docs Cateory Template
 *
 * @package kadence
 */

 
namespace Kadence;



get_header();
?>
<div class="wadi_taxonomies_docs_container">

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

<?php get_footer();

