<?php
require_once "core/init.php";
require_once "core/restrict_login_signup.php";
$user = new User();
$username ="";
$password = "";
$username_err = "";
$password_err = "";
$login_err = "";
if($_SERVER['REQUEST_METHOD']=="POST"){
  $username = $_POST['username'];
    $password = $_POST['password'];
  $check = new CheckValid();
  if($check->emptyCheck($username)){
    $username_err = "Username is required...";
  }
  else if($check->emptyCheck($password)){
      $password_err = "Password is required...";
    }
    else if($check->userSatisfiedF($username)){
      $login_err = "Username must be at least of 4 characters";
    }
    else if($check->passSatisfiedF($password)){
      $login_err = "Password must be at least 8 characters..";
    }
  else {
  $user->userCheck($username,$password);
  if($user->isLoggedIn()){
      Session::set("user",md5(uniqid()));
      if(Session::isset("user")){
        Cookie::set("user_hash",uniqid());
        Redirect::to("discussions");
        }
      }
  else{
        $login_err = "Either username or password is wrong...";
      }
  }
  unset($user->stmt);
  unset($user->conn);
}
 ?>
<div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
          <p class="help-block"><?php echo $login_err; ?></p>
            <label>Username</label>
            <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
      </div>
    </form>
</body>
</html>
