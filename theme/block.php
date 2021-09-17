<?php

/**
 * Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$context = Timber::context();
$startmeup_block = new Startmeup\Block($block);
$context['block'] = $startmeup_block;

switch ($startmeup_block->block['name']) {


  case 'acf/selected-blog-list-block':
    $blog_posts = new Timber\Post($startmeup_block->blog);

    $context['title'] = get_field('header');

    /* featured posts */
    $selected_posts = get_field('blog_posts');

    $blog_obj = new \Packard\PostTypes\Blog();

    foreach ($selected_posts as &$sp) {
      $excerpt = '';
      $post = get_post($sp->ID);
      // Create an experpt
      if (strlen($post->post_content) > 180) {
        $excerpt = $blog_obj::tokenTruncate($post->post_content, 180) . '... ';
      }
      else {
        $excerpt = $post->post_content;
      }
      $sp->excerpt = $excerpt;
      $sp->post_date = $blog_obj::getDateString($post->post_date);

    }

    $context['selected_posts'] = $selected_posts;


    break;

  case 'acf/blog-list-block':

    $word = @$_GET['word'];
    $cat = @$_GET['cat'];

    $args = array(
      'post_type' => 'blog',
      'orderby' => 'meta_value_num',
      'posts_per_page' => -1,
      'order' => 'DESC',
      'post_status' => 'publish',
    );

    if(strlen($word)) {
      $args['search_blog'] = $word;
    }

    if ($cat) {
      $args['tax_query'] = [
        [
          'taxonomy' => 'blog_tags',
          'field' => 'term_id',
          'terms' => $cat,
        ]
      ];
    }

    $posts = \Timber::get_posts($args);
    $blog_obj = new \Packard\PostTypes\Blog();

    foreach ($posts as &$post) {

      // Create an experpt
      if (strlen($post->post_content) > 180) {
        $excerpt = $blog_obj::tokenTruncate($post->post_content, 180) . '... ';
      }
      else {
        $excerpt = $post->post_content;
      }
      $post->excerpt = $excerpt;
      $post->post_date = $blog_obj::getDateString($post->post_date);
    }

    $context['selected_posts'] = $posts;
    $context['tags'] =  \Timber::get_terms('blog_tags');
    $context['word'] = $word;
    $context['category'] = $cat;
    $context['title'] = get_field('header');

    break;


}


$template = str_replace('acf/', '', $block['name']);

Timber::render(["block/$template.twig",], $context );

