
<?php

$host = "localhost";
$user = "aibots_dell";
$password ="_Wz263po";
$database = "aibots_dell";

//$id = "";
$fullname = "";
$email = "";
$address = "";
$productname = "";
$price = "";
$quantity = "";



mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to mysql database
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    echo 'Error';
}

// get values from the form
function getPosts()
{
    $posts = array();
    //$posts[0] = $_POST['id'];
    $posts[1] = $_POST['fullname'];                          //id,name,code,image,price
    $posts[2] = $_POST['email'];
    $posts[3] = $_POST['address'];
	$posts[4] = $_POST['productname'];
    $posts[5] = $_POST['price'];
	$posts[6] = $_POST['quantity'];
	
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM paydetail WHERE id = '$data[0]'";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))  
            {
                //$id = $row['id'];
                $fullname = $row['fullname'];
                $email = $row['email'];
                $address = $row['address'];
				$productname = $row['productname'];
				$price = $row['price'];
				$quantity = $row['quantity'];
            }
        }else{
            echo 'No Data For This Id';
        }
    }else{
        echo 'Result Error';
    }
}


// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    $insert_Query = "INSERT INTO `paydetail`(`fullname`, `email`,`address`,`productname`,`price`,`quantity`) VALUES ('$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Inserted';
            }else{
                echo 'Data Not Inserted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Insert '.$ex->getMessage();
    }
}

// Delete
if(isset($_POST['delete']))
{
    $data = getPosts();
    $delete_Query = "DELETE FROM `paydetail` WHERE `id` = '$data[0]'";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Deleted';
            }else{
                echo 'Data Not Deleted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

// Edit
if(isset($_POST['update']))                              
{																												 //id,name,code,image,price
    $data = getPosts();
    $update_Query = "UPDATE `paydetail` SET `fullname`='$data[1]',`email`='$data[2]',`address`='$data[3]',`productname`='$data[4]' ,`price`='$data[5]' ,`quantity`='$data[6]' WHERE `id` = '$data[0]'";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)                                                         
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Updated';
            }else{
                echo 'Data Not Updated';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}



?>


<!DOCTYPE Html>
<html>
    <head>
        <title>Confirm order</title>
		<link rel="stylesheet" type="text/css" href="user/mystyle.css">
    </head>																																
    <body>
	<div class="header">
		<h2>Confirm Order </h2>
	</div>
        <form action="userproducts.php" method="post" class="content">
		
		<!--<div class="input-group">
			<label>Product ID</label>
            <input type="number" name="id" placeholder="id" value="<?php echo $id;?>"><br><br>
		</div>-->																																				
		
		<div class="input-group">
			<label>Fullname</label>
            <input type="text" name="fullname" placeholder="Fullname" value="<?php echo $fullname;?>"><br><br>
		</div>	
		
		<div class="input-group">
			<label>Email</label>
			<input type="text" name="email" placeholder="email" value="<?php echo $email;?>"><br><br>
		</div>	
		
		<div class="input-group">
			<label>Address</label>
			  <input type="text" name="address" placeholder="address"  value="<?php echo $address; ?>"><br><br>
			 </div> 
		 
		 	<div class="input-group">
			<label>Productname</label>	 
            <input type="text" name="productname" placeholder="productname" value="<?php echo $productname;?>"><br><br>
         </div>  
		 
		 <div class="input-group">
			<label>Price</label>	 
            <input type="text" name="price" placeholder="price" value="<?php echo $price;?>"><br><br>
         </div>  
		 
		 <div class="input-group">
			<label>Quantity</label>	 
            <input type="text" name="quantity" placeholder="quantity" value="<?php echo $quantity;?>"><br><br>
         </div>  
	     
            <div class="input-group">
                <!-- Input For Add Values To Database-->
                <input type="submit" class="btn" name="insert" value="Add"><br><br>
                
                <!-- Input For Edit Values -->
               <!-- <input type="submit" class="btn" name="update" value="Update"><br><br>-->
                
                <!-- Input For Clear Values -->
              <!--<input type="submit" class="btn" name="delete" value="Delete"><br><br>-->
                
				
				
                <!-- Input For Find Values With The given ID -->
              <!--  <input type="submit" class="btn" name="search" value="Find"><br><br>-->
			  
            </div>
			
				<!--<div class="input-group">
				<button type="reset"  class="btn" name="Reset">Clear</button>
				</div>-->
		
				<div class="input-group">
			
				<!--<a href="/free/pay.php" class="btn">Go to Payment</a>-->
				<!--<a href="/free/cart.php" class="btn">Back to Cart</a>-->
				<a href="/index.php" class="btn">Back to Home</a>
				<a href="cart.php" class="btn">Back to Cart</a>
				<a href="pay.php" class="btn">Go to Payment</a>
				
				</div>
        </form>
    </body>
</html>