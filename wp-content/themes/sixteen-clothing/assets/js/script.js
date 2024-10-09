(function ($, w, d) {
  $(d).ready(function () {
<<<<<<< HEAD
=======
    console.log("Hi")
    $(document).on("click", ".categories-list li", function () {
      console.log("Hi")
      var className = this.children[0].className.split(" ")[1];
      var data = `${className}`;
      //ajax request for filter
      createAjaxRequest(data, "filter_posts_by_category");
    });
    let search_name = document.querySelector(".search-name");
    let search_content = "";
    $("input").keyup(function () {
      search_content = search_name.value.toLowerCase();
      var data = search_content;
      createAjaxRequest(data, "search_posts_by_title");
    });

    //create list
    function createListStructure(response) {
      console.log(response)
      response.forEach(function (product) {
          var $li = $('<li class="product w-cardwidth flex flex-col"></li>');
          var $divUp = $('<div class="product-info flex flex-col gap-2 py-5 px-4"></div>');
          var $divInfoUp = $('<div class="product-info-up flex justify-between"></div>');
          var $figure = $('<figure class="h-full object-cover"></figure>');
          
          // Add product image
          if (product.thumbnail) {
              var $link = $("<a></a>").attr("href", product.permalink);
              var $img = $("<img>").attr("src", product.thumbnail).attr("alt", product.title);
              $link.append($img);
              $figure.append($link);
          }
          
          // Add product title
          var $title = $('<h4 class="single-letter-caps text-skyblue text-sm font-bold"></h4>').text(product.title);
          $divInfoUp.append($title);
      
          // Add product price
          if (product.product_price) {
              var $price = $('<span class="price font-bold text-sm"></span>').text(product.product_price);
              $divInfoUp.append($price);
          }
      
          // Add product excerpt
          var $excerpt = $('<p class="single-letter-caps text-xs leading-normal text-grey-100 pb-1"></p>').text(product.content);
          
          // Add product rating stars
          var $divInfoDown = $('<div class="product-info-down flex justify-between text-orangered"></div>');
          if (product.product_rating) {
              var $ulStars = $('<ul class="stars"></ul>');
              for (var i = 0; i < product.product_rating; i++) {
                  $ulStars.append('<li>star</li>');
              }
              $divInfoDown.append($ulStars);
          }
      
          // Add number of reviews
          if (product.number_of_reviews) {
              var $reviews = $('<span class="capitalize text-xs font-bold">Reviews(<span class="count"></span>)</span>');
              $reviews.find('.count').text(product.number_of_reviews);
              $divInfoDown.append($reviews);
          }
      
          // Append everything to list item
          $divUp.append($divInfoUp, $excerpt, $divInfoDown);
          $li.append($figure, $divUp);
          $(".product-list").append($li);   
      });
    }

    //ajax request Function
    function createAjaxRequest(data, action) {
      var ajaxurl = ajax_object.ajaxurl;
      $.ajax({
        url: ajaxurl,
        type: "POST",
        dataType: "json",
        data: {
          action: action,
          data: data,
        },
        success: function (response) {
          $(".product-list").empty(100);
          if(response.length>0)
          {
           createListStructure(response);
           $(".msg-block").hide(100)
           $(".product-list").show(100)
          }
          else{
            $(".pagination").hide(100)
            $(".msg-block").show(100)
          }
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error:", error);
          console.log(xhr.responseText);
        },
      });
    }
>>>>>>> tp/sixteen-clothing-theme
  });
  $(w).on("load", function () {
    console.log("Page fully loaded");
  });
<<<<<<< HEAD
})(jQuery, window, document);
 
=======
})(jQuery, window, document);
>>>>>>> tp/sixteen-clothing-theme
