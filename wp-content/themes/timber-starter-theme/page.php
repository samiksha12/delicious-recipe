<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/templates/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();

$timber_post     = Timber::get_post();
$context['post'] = $timber_post;
$context['logo']= Timber::get_posts(['post_type'=>'post','category_name'=>'logo']);
$context['featured'] = Timber::get_posts(['post_type'=>'post','category_name'=>'featured','recipe-post','posts_per_page'=>'3']);
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
Timber::render( array( 'page-' . $timber_post->post_name . '.twig', 'page.twig' ), $context );
