<<<<<<< HEAD
</main>
<!--main section end-->
<!--footer section start-->
<footer>
  <div class="wrapper">
  </div>
</footer>
<!--footer section end-->
=======
<?php
$copyright_text=get_field('copyright_text','options');
$reference_link=get_field('reference_link','options');
?>
</main>
<!--main section end-->
<?php
if($copyright_text || $reference_link){
  ?>
<!--footer section start-->
<footer>
<div class="wrapper flex justify-center py-11">
        <?php if($copyright_text){?>
          <span
            class="first-caps flex justify-end text-xs text-gray-600 uppercase"
            ><?php echo $copyright_text ?>
            <?php echo linkAttributes($copyright_text , 'text-orangered'); ?>
          </span>
            <?php } ?>
        </div>
</footer>
<!--footer section end-->
<?php } ?>
>>>>>>> tp/sixteen-clothing-theme
</div>
<!--container end-->
<?php wp_footer(); ?>
</body>

</html>