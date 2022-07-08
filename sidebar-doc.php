<div class="wadi_sidebar_doc">

<?php



$args = array(
	'taxonomy' => 'docs-category',
	'orderby' => 'name',
	'order'   => 'ASC',
	'hide_empty' => false,
);

$cats = get_terms($args);

echo "<div class='wadi_doc_categories_heading_text'><h2>Docs Categories</h2></div>";

echo "<ul>";
foreach ($cats as $cat) :


?>

        <li class="doc_category_link">
            <a href="<?php echo get_category_link($cat->term_id) ?>">
            <?php echo $cat->name; ?>
            <span> (<?php echo $cat->count; ?>)</span>
            </a>
        </li>



<?php
endforeach;

echo "</ul>";
	
?>
</div>