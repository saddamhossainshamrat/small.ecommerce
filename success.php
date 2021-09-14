<?php include 'inc/header.php'; ?>
<?php
$login = Session::get("custlogin");
if($login == false) {
   header("Location:login.php");
}
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
       <div class="psuccess">
       <h2>Success</h2>
       <?php 
      $cmrId = Session::get("cmrId");
      $amount = $ct->payableAmount($cmrId);
      if($amount){
          $sum = 0;
          while ($result = $amount->fetch_assoc()){
              $price = $result['price'];
              $sum = $sum+$price;
          }
      }
       ?>
       <p>Total Payable Amount(Including VAT) : $
           <?php 
           $vat = $sum * 0.1;
           $total = $sum+$vat;
           echo $total;
           ?>
       </p>
       <p>Thanks for Purchase. Receive Your Order Successfully. We will contact you ASAP with
           delivery details. Here is your order details...<a href="orderdetails.php">Visit Here...</a></p>
       
 </div>
 		</div>
 	</div>
	</div>
	<?php include 'inc/footer.php'; ?>