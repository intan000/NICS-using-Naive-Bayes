


<?php include('layouts/headerCust.php'); ?>



<?php


include('server/connection.php');


if(!isset($_SESSION['logged_in'])){
  header('location: login.php');
  exit;
}


if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['cust_email']);
    unset($_SESSION['cust_name']);
    header('location: login.php');
    exit;
   
  }
} 



if(isset($_POST['change_password'])){

          $password = $_POST['password'];
          $confirmPassword = $_POST['confirmPassword'];
          $cust_email = $_SESSION['cust_email'];

          //if passwords dont match
          if($password !== $confirmPassword){
            header('location: account.php?error=passwords dont match');
          

          //if passwod is less than 6 char
          }else if(strlen($password) < 6){
            header('location: account.php?error=password must be at least 6 charachters');

            //no errors
          }else{
             
            $stmt = $conn->prepare("UPDATE customer SET cust_password=? WHERE cust_email=?");
            $stmt->bind_param('ss',md5($password),$cust_email);

            if($stmt->execute()){
              header('location: account.php?message=password has been updated successfully');
            }else{
              header('location: account.php?error=could not update password');
            }
            
          }

  
}




//get orders
if(isset($_SESSION['logged_in'])){

  $cust_id = $_SESSION['cust_id'];

  $stmt = $conn->prepare("SELECT * FROM purchase WHERE cust_id=? ");

  $stmt->bind_param('i',$cust_id);

  $stmt->execute();

  $purchase = $stmt->get_result();//[]



}





?>




      <!--Account-->
      <section class="my-5 py-5">
         <div class="row container mx-auto">

           <?php if(isset($_GET['payment_message'])){ ?>
                <p class="mt-5 text-center" style="color:green"> <?php echo $_GET['payment_message'];?></p>
            <?php } ?>
          
             <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
             <p class="text-center" style="color:green"><?php if(isset($_GET['register_success'])){ echo $_GET['register_success']; }?></p>
             <p class="text-center" style="color:green"><?php if(isset($_GET['login_success'])){ echo $_GET['login_success']; }?></p>
                 <h3 class="font-weight-bold">Account info</h3>
                 <hr class="mx-auto">
                 <div class="account-info">
                     <p>Name : <span> <?php if(isset($_SESSION['cust_name'])){ echo $_SESSION['cust_name'];} ?></span></p>
                     <p>Email : <span> <?php if(isset($_SESSION['cust_email'])){ echo $_SESSION['cust_email'];} ?></span></p>
                     <p><a href="#orders" id="orders-btn">Your orders</a></p>
                     <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                     <!-- <p><a class="btn btn-primary" href="edit_account.php?cust_id=<?php echo $row['cust_id'];?>">Edit</a></p> -->
                 </div>
             </div>

             <div class="col-lg-6 col-md-12 col-sm-12 ">
                 <form id="account-form" method="POST" action="account.php">
                   <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                   <p class="text-center" style="color:green"><?php if(isset($_GET['message'])){ echo $_GET['message']; }?></p>
                     <h3>Change Password</h3>
                     <hr class="mx-auto">
                     <div class="form-group">
                         <label>Password</label>
                         <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required/>
                     </div>
                     <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Password" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
                    </div>
                 </form>
             </div>
         </div>
      </section>




            <!--Orders-->
            <section id="orders" class="orders container my-5 py-3">
            <div class="container mt-2">
                <h2 class="font-weight-bold text-center">Your Purchases History</h2>
                <hr class="mx-auto">
            </div>

            <table class="mt-5 pt-5">
                <tr>
                    <th>No.</th>
                    <!-- <th>Purchase id</th> -->
                    <th>Purchase cost</th>
                    <th>Purchase status</th>
                    <th>Date</th>
                    <th>Purchase details</th>
                </tr>

                <?php $i = 1; ?>
                <?php  while($row = $purchase->fetch_assoc() ){ ?>

                          <tr>
                             <td><?php echo $i; ?></td>
                              <!-- <td> -->
                              <!-- <div class="product-info">
                                    <img src="assets/imgs/<?php echo $row['product_image'];?>"/>
                                    <div>
                                        <p class="mt-3"><?php echo $row['product_name'];?></p>
                                    </div>
                                </div>  -->
                                <!-- <span><?php echo $row['purchase_id']; ?></span> -->
                              <!-- </td> -->

                              <td>
                                <span><?php echo $row['purchase_cost']; ?></span>
                              </td>

                              <td>
                                <span><?php echo $row['purchase_status']; ?></span>
                              </td>

                              <td>
                                <span><?php echo $row['purchase_date']; ?></span>
                              </td>
                            
                              <td>
                                <form method="POST" action="purchase_details.php">
                                  <input type="hidden" value="<?php echo $row['purchase_status'];?>" name="purchase_status"/>
                                  <input type="hidden" value="<?php echo $row['purchase_id'];?>" name="purchase_id"/>
                                  <input class="btn order-details-btn" name="purchase_details_btn" type="submit" value="details"/>
                                </form>
                              </td>
                            
                          </tr>
                            <?php $i++; ?>
 
                  <?php } ?>        



         
            </table>


          


        </section>