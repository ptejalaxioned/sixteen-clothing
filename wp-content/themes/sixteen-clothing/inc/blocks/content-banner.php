<?php
$slider_images = get_field('slider_images');
$banner_heading = get_field('banner_heading');
$banner_text = get_field('banner_text');
$true_false = get_field('show_slider');
echo $true_false;
if ($slider_images || $banner_heading || $banner_text) { ?>
  <!--banner section ends-->
  <section class="banner relative">
    <div class="wrapper w-full">
      <?php if ($slider_images) { ?>
        <ul class="slider flex flex-col w-full overflow-hidden ">
          <?php
          $counter = 0;
          foreach ($slider_images as $image) {
            $images = $image['images'];
            $counter++;
          ?>
            <li>
              <?php if ($true_false == 0) {
                if ($counter > 1) { ?>
                  <figure class="h-full object-cover">
                    <?php
                    echo wp_get_attachment_image($images, [1279, 574], false, array('class' => 'hidden'));
                    ?>
                  </figure>
                <?php
                } else if ($counter == 1) { ?>
                  <figure class="h-full object-cover">
                    <?php
                    echo wp_get_attachment_image($images, [1279, 574], false);
                    ?>
                  </figure>
                <?php }
              } else { ?>
                <figure class="h-full object-cover">
                  <?php
                  echo wp_get_attachment_image($images, [1279, 574], false);
                  ?>
                </figure>
              <?php } ?>
            </li>
          <?php } ?>
        </ul>
      <?php }
      if ($banner_heading || $banner_text) { ?>
        <div class="banner-content absolute z-20 left-1/2 top-1/2 font-black text-center transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center gap-3 ">
          <?php if ($banner_text) { ?>
            <p class="uppercase text-orangered text-sm"><?php echo $banner_text ?></p>
          <?php } ?>
          <?php if ($banner_heading) { ?>
            <h2 class="uppercase text-white text-4xl tracking-widest"><?php echo $banner_heading ?> </h2>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </section>
  <!--banner section ends-->
<?php } ?>