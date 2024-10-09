<?php
function my_acf_init()
{
  register_acf_blocks('banner', 'banner', 'A custom banner block', '/inc/blocks/content-banner.php', 'admin-page');
  register_acf_blocks('products', 'products', 'A custom products block', '/inc/blocks/content-products.php', 'admin-page');
}

function register_acf_blocks($slug, $title, $description, $template_loc, $icon)
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => $slug,
      'title'             => __($title),
      'description'       => __($description),
      'render_callback'   => 'my_acf_block_render_callback',
      'render_template'   => get_theme_file_path() . $template_loc,
      'category'          => 'formatting',
      'icon'              => $icon,
      'keywords'          => array($slug),
    ));
  }
}

function my_acf_block_render_callback($block)
{
  // convert name ("acf/testimonial") into path friendly slug ("testimonial")
  $slug = str_replace('acf/', '', $block['name']);
  // include a template part from within the "template-parts/block" folder
  if (file_exists(get_theme_file_path("/inc/blocks/content-{$slug}.php"))) {
    include(get_theme_file_path("/inc/blocks/content-{$slug}.php"));
  }
}
add_action('acf/init', 'my_acf_init');
