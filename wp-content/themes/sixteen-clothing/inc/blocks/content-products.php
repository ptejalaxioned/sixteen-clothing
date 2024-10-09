<?php
$tabs = get_field('filter_tabs');
$product_page_heading = get_field('product_page_heading');
$view_more = get_field('view_more');
$search_placeholder = get_field('search_placeholder');
$product_upperside_features = get_field('product_upperside_features');
$product_downside_heading = get_field('product_downside_heading');
$product_downside_paragraph = get_field('product_downside_paragraph');
$purches_now_link = get_field('purches_now_link');
if ($product_upperside_features || $product_downside_heading || $product_downside_paragraph || $purches_now_link) {
?>
  <!--products section start-->
  <section class="products">
    <div class="wrapper pt-16 pb-10">
      <?php if ($product_upperside_features) { ?>
        <?php if ($product_upperside_features == "Heading & View more" || $product_upperside_features == "Heading" || $product_upperside_features == "View more") { ?>
          <?php if ($product_upperside_features == "Heading & View more") { ?>
            <div class="heading-view flex border-bottom product-up justify-between items-center pb-2">
              <h3 class="capitalize font-bold text-lg"><?php echo $product_page_heading ?></h3>
              <span class="uppercase text-xs text-orangered font-bold"><?php echo $view_more ?></span>
            </div>
          <?php } ?>
          <?php if ($product_upperside_features == "Heading") { ?>
            <div class="heading-view flex border-bottom product-up justify-between items-center pb-2">
              <h3 class="capitalize font-bold text-lg"><?php echo $product_page_heading ?></h3>
            </div>
          <?php } ?>
          <?php if ($product_upperside_features == "View more") { ?>
            <div class="heading-view flex border-bottom product-up justify-between items-center pb-2">
              <span class="uppercase text-xs text-orangered font-bold"><?php echo $view_more ?></span>
            </div>
          <?php } ?>
        <?php } ?>
        <?php if ($product_upperside_features == "Filter & Search" || $product_upperside_features == "Filter" || $product_upperside_features == "Search") { ?>
          <?php if ($product_upperside_features == "Filter & Search") { ?>
            <div class="filter-search border-bottom product-up flex justify-between items-center pb-2">
              <?php if ($tabs) { ?>
                <ul class="categories-list flex">
                  <li>
                    <a href="#FIXME" class="uppercase all font-bold text-xs all p-2" target="_self" title="All">all products</a>
                  </li>
                  <?php foreach ($tabs as $tab) {
                    $term = get_term($tab);
                    $term_name = $term->name;
                    $term_slug = $term->slug;
                  ?>
                    <li>
                      <a href="#FIXME" class="uppercase <?php echo $term_slug ?> font-bold text-xs p-2" target="_self" title="<?php echo $term_name ?>"><?php echo $term_name ?></a>
                    </li>
                  <?php } ?>
                </ul>
              <?php } ?>
              <div class="search-div  w-3/12 ">
                <input type="text" class="search-name w-full h-8 p-2 text-sm border border-gray-500 rounded-md" placeholder="<?php echo $search_placeholder; ?>" />
              </div>
            </div>
          <?php } ?>
          <?php if ($product_upperside_features == "Filter") { ?>
            <div class="filter-search border-bottom product-up flex justify-between items-center pb-2">
              <?php if ($tabs) { ?>
                <ul class="categories-list flex">
                  <li>
                    <a href="#FIXME" class="uppercase font-bold text-xs all p-2" target="_self" title="All">all products</a>
                  </li>
                  <?php foreach ($tabs as $tab) {
                    $term = get_term($tab);
                    $term_name = $term->name;
                    $term_slug = $term->slug;
                  ?>
                    <li>
                      <a href="#FIXME" class="<?php echo $term_slug ?>uppercase font-bold text-xs p-2" target="_self" title="<?php echo $term_name ?>"><?php echo $term_name ?></a>
                    </li>
                  <?php } ?>
                </ul>
              <?php } ?>
            </div>
          <?php } ?>
          <?php if ($product_upperside_features == "Search") { ?>
            <div class="filter-search border-bottom product-up flex justify-between items-center pb-2">
              <div class="search-div  w-3/12">
                <input type="text" class="search-name w-full h-8 p-2 text-sm border border-gray-500 rounded-md" placeholder="<?php echo $search_placeholder; ?>" />
              </div>
            </div>
          <?php } ?>
        <?php } ?>
      <?php } ?>
      <ul class="product-list w-full flex gap-3 flex-wrap product-list py-12">
        <?php
        $args = array(
          'post_type' => 'products',
          'posts_per_page' => -1,
        );
        $all_posts = new WP_Query($args);
        if ($all_posts->have_posts()) {
          while ($all_posts->have_posts()) {
            $all_posts->the_post();
        ?>
            <li class="product w-cardwidth flex flex-col">
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
            </li>
          <?php } ?>
        <?php
          wp_reset_postdata();
        } else {
          echo '<p>No posts found.</p>';
        }
        ?>
      </ul>
      <?php if ($product_downside_heading || $product_downside_paragraph || $purches_now_link) { ?>
        <div class="product-down flex justify-between items-center bg-lightgray p-5">
          <?php if ($product_downside_heading || $product_downside_paragraph) { ?>
            <div class="product-down-left flex flex-col gap-3">
              <?php if ($product_downside_heading) { ?>
                <h4 class="capitalize text-skyblue text-sm font-bold"><?php echo $product_downside_heading; ?></h4>
              <?php } ?>
              <?php if ($product_downside_paragraph) { ?>
                <p class="single-letter-caps text-xs"><?php echo $product_downside_paragraph; ?></p>
              <?php } ?>
            </div>
          <?php } ?>
          <?php if ($purches_now_link) { ?>
            <div class="product-down-right">
              <?php echo linkAttributes($purches_now_link, 'capitalize bg-orangered py-2 px-3 rounded-md text-white text-xs'); ?>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </section>
  <!--products section ends-->
<?php } ?>