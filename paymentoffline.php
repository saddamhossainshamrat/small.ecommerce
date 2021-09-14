<?php include 'inc/header.php'; ?>
<?php
$login = Session::get("custlogin");
if($login == false) {
   header("Location:login.php");
}
?>
<?php
if(isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $cmrId = Session::get("cmrId");
    $insertOrder = $ct->orderProduct($cmrId);
    $delData = $ct->delCustomerCart();
    header("Location:success.php");
}
?>
<style>

</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
   <div class="division dv">
   <table class="tblone sp">
							<tr>
								<th>No</th>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
							</tr>
							<?php
                             $getPro = $ct->getCartProduct();
							 if($getPro) {
								 $i= 0;
								 $sum = 0;
								 $qty = 0;
								 while ($result = $getPro->fetch_assoc()){
									 $i++;
							
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td>$ <?php echo $result['price']; ?> </td>
								<td><?php echo $result['quantity']; ?> </td>
								<td>$ 
								<?php $total= $result['price'] * $result['quantity']; 
								echo $total;
								?></td>
							</tr>
							<?php 
							$qty = $qty + $result['quantity'];
							$sum = $sum + $total; 
							?>
							<?php } } ?>
						
					   </table>
					
						<table class="tbltwo pd">
							<tr>
								<td>Sub Total</td>
                                <td>:</td>
								<td>$ <?php echo $sum; ?></td>
							</tr>
							<tr>
								<td>VAT</td>
                                <td>:</td>
								<td>10%($<?php echo $vat = $sum * 0.1; ?>)</td>
							</tr>

							<tr>
								<td>Grand Total</td>
                                <td>:</td>
								<td>$<?php 
								$vat = $sum * 0.1;
								$gtotal = $sum + $vat;
								echo $gtotal;
								?></td>
                                </tr>
                                <tr>
								<td>Quantity</td>
                                <td>:</td>
								<td><?php echo $qty; ?></td>
							
							</tr>
					   </table>
					
   </div>
   <div class="division dv">
   <?php 
        $id = Session::get("cmrId");
        $getdata = $cmr->getCustomerData($id); 
        if($getdata){
        while ($result = $getdata->fetch_assoc()){

      
        ?>
			<table class="tblone sp">
         <tr>
            <td colspan="3"><h2>Your Profile Details</h2></td>
            </tr>
            <tr>
            <td width="20%">Name</td>
            <td width="5%">:</td>
            <td><?php echo $result['name']; ?></td>
            </tr>
            <tr>
            <td>Phone</td>
            <td>:</td>
            <td><?php echo $result['phone']; ?></td>
            </tr>
            <tr>
            <td>Email</td>
            <td>:</td>
            <td><?php echo $result['email']; ?></td>
            </tr>
            <tr>
            <td>Address</td>
            <td>:</td>
            <td><?php echo $result['address']; ?></td>
            </tr>
          <tr>	
            <td>City</td>
            <td>:</td>
            <td><?php echo $result['city']; ?></td>
            </tr>
           <tr>
            <td>Zipcode</td>
            <td>:</td>
            <td><?php echo $result['zip']; ?></td>
            </tr>
           <tr>
            <td>Country</td>
            <td>:</td>
            <td><?php echo $result['country']; ?></td>
            </tr>
           <tr>
            <td></td>
            <td></td>
            <td><a href="editprofile.php">Update Details</a></td>
            </tr>
            </table>	
 			<?php } } ?>
   </div>
 		</div>
 	</div>
     <div class="ordernow"><a href="?orderid=order">Order</a></div>
	</div>
	<?php include 'inc/footer.php'; ?>