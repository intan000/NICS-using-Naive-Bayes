<?php include('layouts/headerCust.php'); ?>


<?php



include('server/connection.php');

if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}

if(isset($_POST['login_btn'])){


  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $conn->prepare("SELECT cust_id,cust_name, cust_email, cust_password FROM customer WHERE cust_email = ? AND cust_password = ? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);

  if($stmt->execute()){
      $stmt->bind_result($cust_id,$cust_name,$cust_email,$cust_password);
      $stmt->store_result();

      if($stmt->num_rows() == 1){
         $stmt->fetch();

        $_SESSION['cust_id'] = $cust_id;
        $_SESSION['cust_name'] = $cust_name;
        $_SESSION['cust_email'] = $cust_email;
        $_SESSION['logged_in'] = true;

        header('location: account.php?login_success=Logged in successfully');

      }else{
        header('location: login.php?error=Could not verify your account');
      }

  }else{
    //error
    header('location: login.php?error=something went wrong');

  }


}






?>



      <!--Login-->
      <section class="my-5 py-5">
          <div class="container text-center mt-3 pt-5">
              <h2 class="form-weight-bold">Login</h2>
              <hr class="mx-auto">
          </div>
          <div class="mx-auto container">
              <form id="login-form" method="POST" action="login.php">
                <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                  <div class="form-group">
                      <label>Email</label>
                      <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required/>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
                </div>
                <div class="form-group">
                    <a id="register-url" href="register.php" class="btn">Don't have account? Register</a>
                </div>
              </form>
          </div>
      </section>
