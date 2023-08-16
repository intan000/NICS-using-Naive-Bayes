<?php

include('server/connection.php');


if(isset($_POST['createPayment'])){

//  $product_name = $_POST['name'];
$purchase_id = $_SESSION['purchase_id'];
 $payment_price = $_POST['payment_price'];
 $payment_details = $_POST['payment_details'];


 //this is the file itself (image)
 $image =$_FILES['image']['tmp_name'];

 //image names
 $image_name = $payment_price."1.jpeg"; //white shoes1.jpeg

 //upload images
 move_uploaded_file($image,"assets/imgs/".$image_name);

  //create a new user
  $stmt = $conn->prepare("INSERT INTO payments (purchase_id,payment_price,payment_details,payment_receipt)
                                                VALUES (?,?,?,?)");
                                                    


   $stmt->bind_param('iiss',$purchase_id,$payment_price,$payment_details,$image_name);

    if($stmt->execute()){
        header('location: account.php?product_created=Product has been created successfully');
    }else{
        header('location: account.php?product_failed=Error occured, try again');
    }


}

 ?>