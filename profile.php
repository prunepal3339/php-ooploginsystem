<?php
require_once "core/init.php";
require_once "core/restrict_access.php";
$user = new User();
$display_cont = $user->getYourPosts();
?>
<div class="wrapper">
<div class="post-form">
  <div class="form">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
      <textarea name="post_text" id="post_text" required ></textarea><br>
      <input type="submit" class="btn btn-primary" name="make_post" value="POST" />
    </form>
  </div>
</div>
<div class="post-display">
  <?php
  if(is_array($display_cont)){
      foreach($display_cont as $disp){
        echo "<div class='username' >".$disp['user']."</div>"."<div class='make_post_date'>".$disp['post_created_date']."</div><br/>";
        echo "<div class='post_content'>".$disp['post_text']."</div>";
        echo "<div class='post_image'>".$disp['post_image']."</div>";
      }
   }
   else{
     echo $display_cont="No post created yet, Need help?";
   }
 ?>
</div>
</body>
</html>
