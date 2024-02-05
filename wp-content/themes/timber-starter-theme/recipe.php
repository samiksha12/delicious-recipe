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
$context['recipe'] = Timber::get_posts(['post_type'=>'post','category_name'=>'recipe-post']);
Timber::render('recipe.twig',$context);