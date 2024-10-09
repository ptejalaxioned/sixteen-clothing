<?php get_header(); ?>
<div class="single-post mt-20 mx-16 w-6/12">
  <?php
  if (have_posts()) {
    while (have_posts()) {
      the_post();
  ?>
        <?php if (has_post_thumbnail()) { ?>
          <figure class="h-full object-cover"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a></figure>
        <?php } ?>
        <div class="product-info flex flex-col gap-2 py-5 px-4">
          <div class="product-info-up flex justify-between">
            <h4 class="single-letter-caps text-skyblue text-sm font-bold"><?php the_title(); ?></h4>
            <?php if (get_field('product_price')) { ?>
              <span class="price font-bold text-sm"><?php the_field('product_price'); ?></span>
            <?php } ?>
          </div>
          <p class="single-letter-caps text-xs leading-normal text-grey-100 pb-1"><?php the_excerpt(); ?></p>
          <div class="product-info-down flex justify-between text-orangered">
            <?php if (get_field('product_rating')) { ?>
              <ul class="stars">
                <?php
                $count = get_field('product_rating');
                for ($i = 0; $i < $count; $i++) { ?>
                  <li>star</li>
                <?php } ?>
              </ul>
            <?php } ?>
            <?php if (get_field('number_of_reviews')) { ?>
              <span class="capitalize text-xs font-bold">Reviews(<span class="count"><?php the_field('number_of_reviews'); ?></span>)</span>
            <?php } ?>
          </div>
        </div>
    <?php } ?>
  <?php

  }
  ?>
  <?php get_footer(); ?>