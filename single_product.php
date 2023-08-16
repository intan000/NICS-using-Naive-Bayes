<?php include('layouts/headerCust.php'); ?>




<?php

include('server/connection.php');

if(isset($_GET['product_id'])){

   $product_id =  $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i",$product_id);

    $stmt->execute();


    $product = $stmt->get_result();//[]




  //no product id was given
}else{

  header('location: index.php');

}



?>

<br>
<br>
      <!--Single product-->
      <section class="container single-product my-5 pt-5">
        <div class="row mt-5">

          <?php  while($row = $product->fetch_assoc()){ ?>

       
          
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-single pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>" id="mainImg"/>
            </div>

           


            <div class="col-lg-6 col-md-12 col-12">
                <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
                <h2> RM <?php echo $row['product_price']; ?></h2>

                <form method="POST" action="cart.php">

                  <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
                  <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>  
                  <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
                  <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>
                  <input type="hidden" name="product_color" value="<?php echo $row['product_color']; ?>"/>
                  
                  <input type="number" name="purchase_quantity" value="1"/>
                  <!-- <input type="number" name="product_quantity" value="1"/> -->
                      <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>            

                  <br>

                  <div class="form-group mt-4"> 
                  <b><label>Size</label>
                    <select name="product_size" class="form-select" required>
                        <option value="S"> S </option>
                        <option value="M"> M </option>
                        <option value="L"> L </option>
                        <option value="XL">XL </option>
                    </select> 
                  </div>

                <!-- <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button> -->

                </form>

                <h4 class="mt-4 mb-2">Product details</h4>
                <span><?php echo $row['product_description']; ?>
                </span>

                <h4 class="mt-4 mb-2">Color</h4>
                <span><?php echo $row['product_color']; ?>
                </span>

            </div>

        

            <?php } ?>

        </div>
      </section>




    

    <script>

     var mainImg = document.getElementById("mainImg");
     var smallImg = document.getElementsByClassName("small-img"); 


     for(let i=0; i<4; i++){
                    smallImg[i].onclick = function(){
                    mainImg.src = smallImg[i].src;
                }

     }

  



    </script>





