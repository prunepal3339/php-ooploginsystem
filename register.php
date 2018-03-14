<?php
require_once "core/init.php";
require_once "core/restrict_login_signup.php";
$username_err=$password_err=$confirm_password_err="";
if($_SERVER['REQUEST_METHOD']=="POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password=$_POST['confirm_password'];
    $check = new CheckValid();
    if($check->emptyCheck($username)){
      $username_err = "Username is required...";
    }
    else if($check->emptyCheck($password)){
        $password_err = "Password is required...";
      }
      else if($check->emptyCheck($confirm_password)){
        $confirm_password_err ="Password Confirm Field is required";
      }
      else if(!$check->match($password,$confirm_password)){
        $confirm_password_err ="Password fields must match";
      }
      else if($check->userSatisfiedF($username)){
        $username_err = "Username must be at least of 4 characters";
      }
      else if($check->passSatisfiedF($password)){
        $password_err = "Password must be at least 8 characters..";
      }
      else{
      $user = new User();
      $hash = password_hash($password, PASSWORD_DEFAULT);
      if($user->userInsert($username,$hash)){
        if($user->isLoggedIn()){
          Session::set("user",md5(uniqid()));
          if(Session::isset("user")){
            Cookie::set("user_hash",uniqid());
            Redirect::to("profile");
            }
        }
      }
      else{
        $username_err="Username already exists, kindly choose another.";
      }
    }
}
?>
<div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="username"class="form-control">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-success" value="Reset">
        </div>
        <div class="btn-success">If Everything goes as expected, You will be redirected to discussion page</div><br/>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</div>
</body>
</html>
