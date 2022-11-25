<?php  
	session_start(); //CREATES A SESSION (to resume the current process)
		 if (isset($_POST['checkout'])){ 
		 		if(!empty($_SESSION['arrCart'])){
					header('location: clear.php');
		 		}
		 }
		 	$sum = 0;
		 	$total = 0;

		 if (isset($_POST['update'])) {
		 	$arrCart = $_SESSION['arrCart'];
		 	$d = 0;
		 	foreach ($arrCart as $key => $value) {
		 		++$d;
		 		if ($arrCart[$key]['quantity'] != $_POST['qty'.$d]) {
		 			$arrCart[$key]['quantity'] = $_POST['qty'.$d];
		 			$_SESSION['arrCart'] = $arrCart;
		 		}
		 	}
		 	header('location: cart.php');
		 }
  ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/shopping-grid-style.css">
<link rel="stylesheet" href="css/cart.css">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn IT Easy Online Shop | Cart</title>
</head>
<body>
<form method="post">
	<div class="container">
		<h3 class="h3 text-left"><i class="fas fa-store"></i> LEARN IT EASY ACUBI ONLINE SHOP
		    <a href="cart.php" class="btn btn-primary float-right text-white">
		    	<i class="fas fa-shopping-cart"></i> Cart <span class="badge badge-light">


		    		<?php if (empty($_SESSION['totalQty'])) {
		    			echo 0;
		    		    }	
		    			else{
		    					echo $_SESSION['totalQty'];
		    			}?>
		    		</span>
			</a>
		</h3>
	<table id="cart" class="table table-hover table-condensed table">
		<thead>
			<tr>
                
			    <th style="width:40%">Product</th>
				<th style="width:5%" class="space">Size</th>
                <th style="width:15%" class="space">Quantity</th>
				<th style="width:15%" class="space">Price</th>
				<th style="width:15%" class="space">Total</th>
				<th style="width:5%"></th>
			</tr>
		</thead>
			<tbody>
				<?php 
                    $i=0;
					if (empty($_SESSION['arrCart'])) {
				?>
				<tr>
					<td colspan="12">Cart is still Empty.</td>
				</tr>
			</tbody>
                <table>
                    <td>
                        <a href="index.php" class="btn btn-danger"><i class="fa-solid fa-bag-shopping"></i> Continue Shopping</a>
                    </td>
                </table>
            <?php 
                }else{
                    $arrCart = $_SESSION['arrCart'];
                    foreach ($arrCart as $key => $value):
            ?>
            <?php 
                ++$i;
            ?>	
            <tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs"><img src="img/<?php echo $value['photo'];?>" alt="..." style="width:60%" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin"><?php echo $value['name'];?></h4>
                        </div>
                    </div>
                </td>

                <!-- SIZE -> CART -->
                <td data-th="size" class="space"><?php echo $value['size']; ?></td>
                
                <!-- QTY CHECKOUT -->
                <td data-th="Quantity">
                    <input type="number" name = "<?php echo'qty'.$i;?>" class="form-control text-center" min="1" max="100" value="<?php echo $value['quantity']?>">
                </td>

                
                <td data-th="Price" class="space">₱ <?php echo number_format($value['price'], 2) ;?></td>

                <!-- TOTAL-->
                <td data-th="Subtotal" class="text-center">₱ <?php echo number_format($value['quantity'] * $value['price'], 2);?></td>

                <!-- DELETE -->
                <td class="actions" data-th="">   
                    <a type="submit" href="remove-confirm.php?deleteID=<?php echo $key?>" class="btn btn-danger btn-sm text-white"><i class="fa-solid fa-trash"></i></a>								
                </td>
            </tr>

            <?php 
                $sum += $value['quantity'];

                $total += $value['quantity'] * $value['price'];

                $_SESSION['totalQty'] = $sum;
            ?>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    
                    <th style="width:40%"></th>
                    <th style="width:5%" class="space">Total: </th>
                    <th style="width:10% center" class="space"><?php echo $sum;?></th>
                    <th style="width:10% center" class="space">----</th>
                    <th style="width:15%" class="space">₱ <?php echo number_format($total, 2);?></th>
                    <th style="width:10% center" class="space">----</th>
                    
                </tr>
                <table>
                <tr>
                    <td>
                        <table style="width:200px">
                            <td>
                                <tr>
                                <!--CART CHECKOUT BUTTONS -->
                                    <a href="index.php" class="btn btn-danger button1"><i class="fa-solid fa-bag-shopping"></i> Continue Shopping</a> 
                                    <button type="submit" name="update" class="btn btn-success button1"><i class="fa-solid fa-pen-to-square"></i> Update Cart</button>
                                    <button type="submit" name="checkout" class="btn btn-primary button1"> <i class="fa-sharp fa-solid fa-check-to-slot"></i> Checkout</button>
                                </tr>
                                </td>
                        </table>
                    </td>
                </tr>
                </table>
                
                
                
                
            </tfoot>
            
        <?php } ?>
    </table>
    </div>
</form>

    

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>