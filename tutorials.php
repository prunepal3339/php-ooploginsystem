<?php
require_once "core/init.php";
 ?>
   <h3>Tutorials Page</h3>
   <p class="help-block">Hello,
    <?php
    $guest = " Guest User!";
   $user = new User();
   echo ($user->isLoggedIn())?( $_SESSION['username']):$guest;
   ?>
 </p>
 </body>
 </html>
