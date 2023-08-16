<?php include('layouts/headerCust.php'); ?>


<?php


   if(isset($_GET['cust_id'])){

    $cust_id = $_GET['cust_id'];
    $stmt = $conn->prepare("SELECT * FROM customer WHERE cust_id=?");
    $stmt->bind_param('i',$cust_id);
    $stmt->execute();

    $products = $stmt->get_result(); //[]

   }else if(isset($_POST['edit_btn'])){

       $cust_id = $_POST['cust_id'];
       $cust_name = $_POST['cust_name'];
       $cust_email = $_POST['cust_email'];
    //    $price = $_POST['price'];
    //    $offer = $_POST['offer'];
    //    $color = $_POST['color'];
    //    $category = $_POST['category'];

        $stmt = $conn->prepare("UPDATE customer SET cust_name=?, cust_email=? WHERE cust_id=?");
        $stmt->bind_param('ssi',$cust_email,$cust_name,$price,$cust_id);

        if($stmt->execute()){
            header('location: account.php?edit_success_message=Product has been updated successfully');
        }else{
             header('location: account.php?edit_failure_message=Error occured, try again');
        }


   
   
  }else{
     header('location: products.php');
     exit;
   }


?>

<div class="container-fluid">
  <div class="row"  style="min-height: 1000px">
   <?php include('sidemenu.php'); ?>

              
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          
          </div>
     
        </div>
      </div>

    

      <h2>Edit Product</h2>
      <div class="table-responsive">
      


          <div class="mx-auto container">
              <form id="edit-form"  method="POST" action="edit_product.php">
                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                <div class="form-group mt-2">

                 <?php foreach($products as $product){ ?>

                   <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>" />

                    <label>Title</label>
                    <input type="text" class="form-control" id="product-name" value="<?php echo $product['product_name']?>" name="title" placeholder="Title" required/>
                </div>
                  <div class="form-group mt-2">
                      <label>Description</label>
                      <input type="text" class="form-control" id="product-desc" value="<?php echo $product['product_description']?>"  name="description" placeholder="Description" required/>
                  </div>
                  <div class="form-group mt-2">
                    <label>Price</label>
                    <input type="text" class="form-control" id="product-price"  value="<?php echo $product['product_price']?>"  name="price" placeholder="Price" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Category</label>
                    <select  class="form-select" required name="category" >
                        <option value="kedah">Kedah</option>
                        <option value="riau">Riau</option>
                        <option value="modern">Modern</option>
                        <option value="kebaya">Kebaya</option>
                    </select>
                </div>
                
                  <div class="form-group mt-2">
                      <label>Color</label>
                      <input type="text" class="form-control" value="<?php  echo $product['product_color']?>"  id="product-color" name="color" placeholder="Color" required/>
                  </div>

              <!-- <div class="form-group mt-2">
                    <label>Special Offer/Sale</label>
                    <input type="number" class="form-control" value="<?php echo $product['product_special_offer']?>"  id="product-offer" name="offer" placeholder="Sale %" required/>
                </div> -->

               

                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" name="edit_btn" value="Edit"/>
                </div>

                <?php } ?>
 
              </form>
          </div>
    




      </div>
    </main>
  </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
