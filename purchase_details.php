<?php include('layouts/headerCust.php'); ?>


<?php


include('server/connection.php');


if(isset($_POST['purchase_details_btn']) && isset($_POST['purchase_id'])){

    $purchase_id = $_POST['purchase_id'];
    $purchase_status = $_POST['purchase_status'];

    $stmt = $conn->prepare("SELECT * FROM purchase_items WHERE purchase_id = ?");

    $stmt->bind_param('i',$purchase_id);

    $stmt->execute();
   
    $purchase_details = $stmt->get_result();

    $total_order_price = calculateTotalOrderPrice($purchase_details);


}else{
    
   header('location: account.php');
   exit;

}




function calculateTotalOrderPrice($purchase_details){

  $total = 0;

  foreach($purchase_details as $row){  

      $product_price = $row['product_price'];
      $purchase_quantity = $row['purchase_quantity'];

       $total  =  $total  + ($product_price * $purchase_quantity);

  }

  
   return $total;
  

}


?>


<br>
       <!--Order details-->
       <section id="purchase" class="orders container my-5 py-3">
            <div class="container mt-5">
                <h2 class="font-weight-bold text-center">Purchase details</h2>
                <hr class="mx-auto">
            </div>

            <table class="mt-5 pt-5 mx-auto">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
 
                </tr>


               <!-- <?php while ($row=$purchase_details->fetch_assoc()) {  ?>
                  
                          <tr>
                              <td>
                                <div class="product-info">
                                    <img src="assets/imgs/<?php echo $row['product_image'];?>"/>
                                    <div>
                                        <p class="mt-3"><?php echo $row['product_name'];?></p>
                                    </div>
                                </div> 
                                
                              </td>

                              <td>
                                <span> RM <?php echo $row['product_price'];?></span>
                              </td>

                              <td>
                                <span><?php echo $row['purchase_quantity'];?></span>
                              </td>
                          </tr>

                  <?php } ?> -->

                  <?php foreach($purchase_details as $row){  ?>
                  
                  <tr>
                      <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $row['product_image'];?>"/>
                            <div>
                                <p class="mt-3"><?php echo $row['product_name'];?></p>
                            </div>
                        </div> 
                        
                      </td>

                      <td>
                        <span> RM <?php echo $row['product_price'];?></span>
                      </td>

                      <td>
                        <span><?php echo $row['purchase_quantity'];?></span>
                      </td>

                  </tr>



          <?php } ?>


         
            </table>



            <?php if($purchase_status == "not paid"){?>
                    <form style="float: right;" method="POST" action="uploadPayment.php">
                      <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"/>
                      <input type="hidden" name="order_total_price" value="<?php echo $total_order_price;?>"/>
                      <input type="hidden" name="order_status" value="<?php echo $order_status;?>" />
                      <input type="hidden" name="order_status" value="<?php echo $order_status;?>" />
                      <input type="submit" class="btn btn-primary" value="Pay Now"/>
                    </form>

              <?php } ?>

        </section>
