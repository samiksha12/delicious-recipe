<?php
/* Template Name: Recipe Template */
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
if (isset($_GET['term'])) {
    $slug = $_GET['term'];
    
    $category = get_category_by_slug($slug);

    if ($category) {
        // Category found, exclude it from $context['allrecipe']
        $context['term'] = $category->name;
        $context['allrecipe'] = Timber::get_posts(['post_type' => 'post', 'category_name' => 'recipe-post', 'category__not_in' => [$category->term_id]]);
    } else {
        // Category not found, handle accordingly
        $context['term'] = $slug;
        $context['allrecipe'] = Timber::get_posts(['post_type' => 'post', 'category_name' => 'recipe-post']);
    }

    $context['recipe'] = Timber::get_posts(['post_type' => 'post', 'category_name' => $slug, 'recipe-post']);
} else {
    $context['recipe'] = Timber::get_posts(['post_type' => 'post', 'category_name' => 'recipe-post']);
}
Timber::render('recipe.twig',$context);
