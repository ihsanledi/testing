<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animated Login & Registration Form | Codehal</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="wrapper">
    <div class="form-wrapper sign-in">
      <form action="">
        <h2>Login</h2>
        <div class="input-group">
        <input type="text" name="username" class="form-control" autocomplete="off" autofocus placeholder="Enter your username...">
          <label for="">Username</label>
        </div>
        <div class="input-group">
        <input type="text" name="password" class="form-control" autocomplete="off" autofocus placeholder="Enter your password..">
          <label for="">Password</label>
        </div>
        <div class="remember">
          <label><input type="checkbox"> Remember me</label>
        </div>
        <button type="submit">Login</button>
        <div class="signUp-link">
          <p>Don't have an account? <a href="#" class="signUpBtn-link">Sign Up</a></p>
        </div>
      </form>
    </div>
    <div class="form-wrapper sign-up">
      <form action="">
        <h2>Sign Up</h2>
        <div class="input-group">
          <input type="text" required>
          <label for="">Username</label>
        </div>
        <div class="input-group">
          <input type="text" name="email" class="form-control" autocomplete="off" autofocus placeholder="enter your email..">
          <label for="">Email</label>
        </div>
        <div class="input-group">
          <input type="password" required>
          <label for="">Password</label>
        </div>
        <div class="remember">
          <label><input type="checkbox"> I agree to the terms & conditions</label>
        </div>
        <button type="submit">Sign Up</button>
        <div class="signUp-link">
          <p>Already have an account? <a href="#" class="signInBtn-link">Sign In</a></p>
        </div>
      </form>
    </div>
  </div>
  <script src="script.js"></script>


  <div class="container" style="margin-top: 150px;">
    <!-- row -->
    <div class="row">
      <!--col  -->
      <div class="col-md-4 col-md-offset-4">
        <!-- panel default -->
        <div class="panel panel-default">
          <!-- panel body -->
          <div class="panel-body">

            <?php if(isset($error) ) : ?>
              <p style="color: red";>Username / Password salah</p>
            <?php endif; ?>
            <form action="" method="post">
              <!-- form group -->
              <div class="form-group">
                <input type="text" name="username" class="form-control" autocomplete="off" autofocus placeholder="Enter Username...">
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Enter Passw...">
              </div>
              <div class="form-group">
                <input type="submit" name="login" class="btn btn-primary btn-lg btn-block" value="Login">
              </div>
              <div class="form-group">
                <a href="daftar_form.php"> <button type="button" class="btn btn-primary">Buat Akun</button></a>
              </div>
            </form>
          </div>
          <!-- gambar kunci -->
          <div class="lock"><i class="fa fa-user fa-3x"></i></div>
          <!-- label login form -->
          <div class="label">Customer Login</div> 
          <div class="label2">Customer Login</div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>