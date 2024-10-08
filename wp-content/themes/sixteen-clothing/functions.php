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

