<?php
add_action('after_setup_theme', 'theme_setup');
function theme_setup()
{
  load_theme_textdomain('gadget-site');
  /* Add menu support */
  add_theme_support('menus');
  /* Add excerpt for pages */
  add_post_type_support('page', 'excerpt');
  add_theme_support('title-tag');
  /* Enable support for Post Thumbnails on posts and pages. */
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array('search-form'));
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');
function my_theme_enqueue_scripts()
{
  // Enqueue custom styling
  wp_enqueue_style('custom-styling', get_template_directory_uri() . '/assets/css/my-style.css', array(), '1.0', 'all');

  // Enqueue output.css styling
  wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/src/output.css' , array(), '1.0', 'all');

  // Enqueue custom script
  wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'));

  // Enqueue Font Awesome script
  wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/5edb8394fa.js', array(), null);

  // Localize script for AJAX
  wp_localize_script('custom-script', 'ajax_object', array(
    'ajaxurl' => admin_url('admin-ajax.php')
  ));
}

//register nav menus
register_nav_menus(
  array("primary-menu" => "Top Menu")
);

//remove post option
function remove_posts_menu() {
  remove_menu_page( 'edit.php' ); // This is the menu slug for Posts
}
add_action( 'admin_menu', 'remove_posts_menu' );

//condition for option pages
if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title'    => 'Theme General Settings',
    'menu_title'    => 'Theme Settings',
    'menu_slug'     => 'theme-general-settings',
    'capability'    => 'edit_posts',
    'redirect'      => false
  ));
  acf_add_options_sub_page(array(
    'page_title'  => 'Header Settings',
    'menu_title'  => 'Header',
    'parent_slug' => 'theme-general-settings',
  ));
  acf_add_options_sub_page(array(
    'page_title'  => 'Footer Settings',
    'menu_title'  => 'Footer',
    'parent_slug' => 'theme-general-settings',
  ));
}

require_once 'functions/func-acf-block-register.php';

//Custom Post Type Products
function create_custom_post_type_products() {
  $labels = array(
      'name'               => __( 'Products' ),
      'singular_name'      => __( 'Product' ),
      'menu_name'          => __( 'Products' ),
      'name_admin_bar'     => __( 'Product' ),
      'add_new'            => __( 'Add New' ),
      'add_new_item'       => __( 'Add New Product' ),
      'new_item'           => __( 'New Product' ),
      'edit_item'          => __( 'Edit Product' ),
      'view_item'          => __( 'View Product' ),
      'all_items'          => __( 'All Products' ),
      'search_items'       => __( 'Search Products' ),
      'not_found'          => __( 'No Products found.' ),
      'not_found_in_trash' => __( 'No Products found in Trash.' ),
  );

  $args = array(
      'labels'             => $labels,
      'public'             => true,
      'has_archive'        => true,
      'rewrite'            => array( 'slug' => 'products' ),
      'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
      'show_in_rest'       => true, // Enables Gutenberg editor
      'menu_position'      => 5,
      'menu_icon'          => 'dashicons-cart', 
  );

  register_post_type( 'products', $args );
}
add_action( 'init', 'create_custom_post_type_products' );

//Custom Texonomy 
function create_custom_taxonomy_category() {
  $labels = array(
      'name'              => __( 'Categories' ),
      'singular_name'     => __( 'Category' ),
      'search_items'      => __( 'Search Categories' ),
      'all_items'         => __( 'All Categories' ),
      'parent_item'       => __( 'Parent Category' ),
      'parent_item_colon' => __( 'Parent Category:' ),
      'edit_item'         => __( 'Edit Category' ),
      'update_item'       => __( 'Update Category' ),
      'add_new_item'      => __( 'Add New Category' ),
      'new_item_name'     => __( 'New Category Name' ),
      'menu_name'         => __( 'Categories' ),
  );

  $args = array(
      'labels'            => $labels,
      'hierarchical'      => true, // Set to true for hierarchical taxonomy (like categories)
      'public'            => true,
      'show_admin_column' => true,
      'show_in_rest'      => true, // Enables Gutenberg editor
      'rewrite'           => array( 'slug' => 'category' ),
  );

  register_taxonomy( 'category', array( 'products' ), $args );
}
add_action( 'init', 'create_custom_taxonomy_category' );

//linkAttributes Function
function linkAttributes($link, $class, $content = "")
{
  $link_url = $link['url'];
  if ($link_url == home_url().'/') {
    $link_url =home_url() ;
  }
  $link_target = $link['target'];
  $link_title = $link['title'];

  if ($link_title == "Email" || $link_title == "Phone Number") {
    $content = $link_url;
  }

  if ($content == "") {
    $content = $link_title;
  }

  if ($link_target == "_blank") {
    $rel = "rel='noopener noreferrer'";
    $anchorTag = "<a href=\"$link_url\" 
                     target=\"$link_target\" 
                     class=\"$class\" 
                     title=\"$link_title\" 
                     $rel>
                      $content
                 </a>";
    if ($link_title == "Email") {
      $anchorTag  = substr_replace($anchorTag, "mailto:", 9, 0);
    } else if ($link_title == "Phone Number") {
      $anchorTag  = substr_replace($anchorTag, "tel:", 9, 0);
    }
  } else if ($link_target == "") {
    $link_target = "_self";
    $anchorTag = "<a href=\"$link_url\" 
                     target=\"$link_target\" 
                     class=\"$class\" 
                     title=\"$link_title\">
                     $content
                 </a>";
  }
  return $anchorTag;
}


//category filter
add_action('wp_ajax_filter_posts_by_category', 'ajax_filter_posts_by_category');
add_action('wp_ajax_nopriv_filter_posts_by_category', 'ajax_filter_posts_by_category');
function ajax_filter_posts_by_category()
{
  $data = isset($_POST['data']) ? sanitize_text_field($_POST['data']) : '';

  if ($data != "all") {
    $args = array(
      'post_type' => 'products',
      'posts_per_page' => -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'category',
          'field'    => 'slug',
          'terms'    =>  $data,
          'operator' => 'IN',
        ),
      ),
    );
  } else {
    $args = array(
      'post_type' => 'products',
      'posts_per_page' => -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'category',
          'field'    => 'slug',
          'operator' => 'Exists',
        ),
      ),
    );
  }

  $all_posts = new WP_Query($args);
  $posts_data = array();
  if ($all_posts->have_posts()) {
    while ($all_posts->have_posts()) {
      $all_posts->the_post();
      $post_data = array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'thumbnail' => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : '',
        'content' => get_the_excerpt(),
        'product_price' => get_field('price') ? get_field('product_price') : '',
        'product_rating' => get_field('price') ? get_field('product_rating') : '',
        'number_of_reviews' => get_field('price') ? get_field('number_of_reviews') : '',
      );
      $posts_data[] = $post_data;
    }
    wp_reset_postdata();
  } else {
    $posts_data = array('message' => 'No posts found.');
  }
  wp_send_json($posts_data);
}

// Search Post
function ajax_search_posts_by_title()
{
  $data = isset($_POST['data']) ? sanitize_text_field($_POST['data']) : '';
  $args = array(
    'post_type' => 'products',
    'posts_per_page' => -1,
    's' =>  $data,
  );
  $all_posts = new WP_Query($args);
  if ($all_posts->have_posts()) {
    while ($all_posts->have_posts()) {
      $all_posts->the_post();
      $post_data = array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'thumbnail' => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : '',
        'content' => get_the_excerpt(),
        'product_price' => get_field('price') ? get_field('product_price') : '',
        'product_rating' => get_field('price') ? get_field('product_rating') : '',
        'number_of_reviews' => get_field('price') ? get_field('number_of_reviews') : '',
      );
      $posts_data[] = $post_data;
    }
    wp_reset_postdata();
  } else {
    $posts_data = array('message' => 'No posts found.');
  }
  wp_send_json($posts_data);
}
add_action('wp_ajax_search_posts_by_title', 'ajax_search_posts_by_title');
add_action('wp_ajax_nopriv_search_posts_by_title', 'ajax_search_posts_by_title');
