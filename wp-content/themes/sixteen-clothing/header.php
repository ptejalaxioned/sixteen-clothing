<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="shortcut icon" href="favicon.ico" />
  <?php wp_head(); ?>
</head>

<body>
  <!--container start-->
  <div class="container">
    <!--header section start-->
<<<<<<< HEAD
    <header>
      <div>
        <nav>
          <?php wp_nav_menu(array("theme_location" => "primary-menu", "menu_class" => "nav-list flex justify-between font-bold",))
          ?>
        </nav>
=======
    <header class="absolute z-20 w-full text-white font-bold top-0 bg-black">
      <div class="wrapper flex">
        <div class="header-content flex justify-between items-center w-full">
          <?php $title = get_field('title_link', 'options');
          $title_split = explode(" ", $title['title']);
          $first_half = "";
          $second_half = "";
          $half_count = count($title_split) / 2;
          for ($i = 0, $j = count($title_split) - 1; $i < $half_count && $j >= $half_count; $i++, $j--) {
            $first_half .= $title_split[$i] . " ";
            $second_half .= $title_split[$j] . " ";
          }
          ?>
          <h1>
            <?php echo linkAttributes($title, 'uppercase flex gap-1 font-bold text-md', '<span
                class="first-half-heading">' . $first_half . '</span><span
                class="second-half-heading text-orangered">' . $second_half . '</span>'); ?>
          </h1>
          <nav>
            <?php wp_nav_menu(array("theme_location" => "primary-menu", "menu_class" => "nav-list",))
            ?>
          </nav>
        </div>
        <div class="hamburger">
          <span class="line line1">line1</span>
          <span class="line line2">line2</span>
          <span class="line line3">line3</span>
        </div>
>>>>>>> tp/sixteen-clothing-theme
      </div>
    </header>
    <!--header section end-->
    <!--main section start-->
    <main>