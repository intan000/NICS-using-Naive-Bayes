<?php include('layouts/headerCust.php'); ?>


<?php


include('server/connection.php');



//if user has already registered, then take user to account page            
if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}



if(isset($_POST['register'])){

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  //if passwords dont match
  if($password !== $confirmPassword){
    header('location: register.php?error=passwords dont match');
  

  //if passwod is less than 6 char
  }else if(strlen($password) < 6){
    header('location: register.php?error=password must be at least 6 charachters');
  

  //if there is no error
  }else{
                //check whether there is a user with this email or not
                $stmt1= $conn->prepare("SELECT count(*) FROM customer where cust_email=?");
                $stmt1->bind_param('s',$email);
                $stmt1->execute();
                $stmt1->bind_result($num_rows);
                $stmt1->store_result();
                $stmt1->fetch();

                //if there is a user already registered with this email
                if($num_rows != 0){
                  header('location: register.php?error=Customer with this eamil already exists');
                  

                  //if no user registed with this email before
                }else{
                        //create a new user
                        $stmt = $conn->prepare("INSERT INTO customer (cust_name,cust_email,cust_password) 
                        VALUES (?,?,?)");

                        $stmt->bind_param('sss',$name,$email,md5($password));

                  

                        //if account was created successfully
                        if($stmt->execute()){
                              $cust_id = $stmt->insert_id;
                              $_SESSION['cust_id'] = $cust_id;
                              $_SESSION['cust_email'] = $email;
                              $_SESSION['cust_name'] = $name;
                              $_SESSION['logged_in'] = true;
                              header('location: account.php?register_success=You registered successfully');

                          //account could not be created
                        }else{

                             header('location: register.php?error=could not create an account at the moment');

                        }



                }

              }







}





?>





      <!--Resgister-->
      <section class="my-5 py-5">
          <div class="container text-center mt-3 pt-5">
              <h2 class="form-weight-bold">Register</h2>
              <hr class="mx-auto">
          </div>
          <div class="mx-auto container">
              <form id="register-form" method="POST"  action="register.php">
                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required/>
                </div>
                  <div class="form-group">
                      <label>Email</label>
                      <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required/>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required/>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Register"/>
                </div>
                <div class="form-group">
                    <a id="login-url" href="login.php" class="btn">Do you have an account? Login</a>
                </div>
              </form>
          </div>
      </section>






      <?php include('layouts/footer.php'); ?>