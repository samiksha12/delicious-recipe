<?php
/* Template Name: Category Template */
/**
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;
$context['logo']= Timber::get_posts(['post_type'=>'post','category_name'=>'logo']);
$recipe_cat = Timber::get_terms([
    'taxonomy' => 'category',
    'slug' => 'recipe-categories',
]);

// Check if the 'recipe-categories' term exists
if (!empty($recipe_cat)) {
    $recipe_id = $recipe_cat[0]->id;

    $child_category_ids = get_term_children($recipe_id, 'category');

    if (!empty($child_category_ids)) {
        $context['categories'] = $child_category_ids;
    } else {
        // Handle the case where there are no child categories
        $context['categories'] = [];
    }
} else {
    // Handle the case where 'recipe-categories' term is not found
    $context['categories'] = [];
}
Timber::render('category.twig',$context);