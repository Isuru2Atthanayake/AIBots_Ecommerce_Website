
<?php

$host = "localhost";
$user = "aibots_dell";
$password ="_Wz263po";
$database = "aibots_dell";

$id = "";
$name = "";
$code = "";
$image = "";
$price = "";


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
    $posts[0] = $_POST['id'];
    $posts[1] = $_POST['name'];                          //id,name,code,image,price
    $posts[2] = $_POST['code'];
    $posts[3] = $_POST['image'];
	$posts[4] = $_POST['price'];
	
    return $posts;
}

// Search

if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM tblproduct WHERE id = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $id = $row['id'];
                $name = $row['name'];
                $code = $row['code'];
                $image = $row['image'];
				 $price = $row['price'];
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
    $insert_Query = "INSERT INTO `tblproduct`(`name`, `code`,`image`,`price`) VALUES ('$data[1]','$data[2]','$data[3]','$data[4]')";
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
    $delete_Query = "DELETE FROM `tblproduct` WHERE `id` = $data[0]";
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
    $update_Query = "UPDATE `tblproduct` SET `name`='$data[1]',`code`='$data[2]',`image`='$data[3]',`price`='$data[4]' WHERE `id` = $data[0]";
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
        <title>Admin pannel</title>
		<link rel="stylesheet" type="text/css" href="mystyle.css">
    </head>																																
    <body>
	<div class="header">
		<h2>Admin Controls</h2>
	</div>
        <form action="admincon2.php" method="post" class="content">
		
		<div class="input-group">
			<label>Product ID</label>
            <input type="number" name="id" placeholder="Id" value="<?php echo $id;?>"><br><br>
		</div>
		
		<div class="input-group">
			<label>Name</label>
            <input type="text" name="name" placeholder="Name" value="<?php echo $name;?>"><br><br>
		</div>	
		
		<div class="input-group">
			<label>Code</label>
			<input type="text" name="code" placeholder="Code" value="<?php echo $code;?>"><br><br>
		</div>	
		
		<div class="input-group">
			<label>Image</label>
			  <input type="text" name="image" placeholder="image"  value="<?php echo $image; ?>"><br><br>
			 </div> 
			 
		<div class="input-group">
			<label>Price</label>	 
            <input type="text" name="price" placeholder="Price" value="<?php echo $price;?>"><br><br>
         </div>  
	     
            <div class="input-group">
                <!-- Input For Add Values To Database-->
                <input type="submit" class="btn" name="insert" value="Add"><br><br>
                
                <!-- Input For Edit Values -->
                <input type="submit" class="btn" name="update" value="Update"><br><br>
                
                <!-- Input For Clear Values -->
                <input type="submit" class="btn" name="delete" value="Delete"><br><br>
                
                <!-- Input For Find Values With The given ID -->
                <input type="submit" class="btn" name="search" value="Find available Products"><br><br>
            </div>
			
				<!--<div class="input-group">
				<button type="reset"  class="btn" name="Reset">Clear</button>
				</div>-->
		
				<div class="input-group">
			
				<a href="\cart.php" class="btn">View Cart</a>
				<a href="checkorders.php" class="btn">Check Orders</a>
					
				</div>
        </form>
    </body>
</html>