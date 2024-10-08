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
    <header>
      <div>
        <nav>
          <?php wp_nav_menu(array("theme_location" => "primary-menu", "menu_class" => "nav-list flex justify-between font-bold",))
          ?>
        </nav>
      </div>
    </header>
    <!--header section end-->
    <!--main section start-->
    <main>