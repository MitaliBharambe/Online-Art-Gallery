<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "microproject");
$tot=0;
if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}else{
			echo '<script>alert("Item Already Added")</script>';}
	}else{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],

			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;}}

if(isset($_GET["action"]))
{if($_GET["action"] == "delete")	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{if($values["item_id"] == $_GET["id"])
			{

				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				//echo '<script>window.location="cart.php"</script>';
			}}	}}
if(isset($_POST["submit"]))
{
	header("Location:bill.php");	
}
?>
<html>

<head> </head>

<body>
    <h2>Welcome, <?=$_SESSION['sess_user'];?>! <a href="logout.php">Logout</a></h2>
    <br /><br /><br /><br />
    <h3 align="center">
        <title="Online Art Gallery">Online Art Gallery
    </h3><br /><br /><br />
    <?php
				$query = "SELECT * FROM tbl_product ORDER BY id ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
    <div class="col-md-4">
        <form method="post" action="cart.php?action=add&id=<?php echo $row["id"];?>">
            <div style="border:1px solid #555; background-color:#f2f2f2; border-radius:5px; padding:16px;"
                align="center">
                <img src="images/<?php echo $row["image"]; ?>" class="img-responsive" width="200" height="200" /><br />
                <h4><?php echo $row["name"]; ?></h4>
                <h4><?php echo $row["price"]; ?></h4>
                <input type="text" name="quantity" value="1" class="form-control" />
                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>"><input type="submit"
                    name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
            </div>
        </form>
    </div><?php		}}
			?>
    <div style="clear:both"></div> <br />
    <h3>Order Details</h3>
    <div class="table-responsive">
        <div style="border:1px solid #555; background-color:#f2f2f2; border-radius:5px; padding:16px;" align="center">
            <table class="table table-bordered">

                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                <?php
					if(!empty($_SESSION["shopping_cart"]))
					{

						$total = 0;
				foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
                <tr>
                    <td><?php echo $values["item_name"]; ?></td>
                    <td><?php echo $values["item_quantity"]; ?></td>
                    <td><?php echo $values["item_price"]; ?></td>
                    <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                    <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span
                                class="text-danger">Remove</span></a></td>
                </tr>
                <?php
$total = $total + ($values["item_quantity"] * $values["item_price"]);
							$_SESSION["tot"]=$total;
						}
					?>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right"> <?php echo number_format($total, 2); ?></td>
                </tr>
                <?php
					}?>
            </table>
            <form method="post"><input type="submit" value="Proceed to Checkout" name="submit"></form>
        </div>
    </div>
    </div>
</body>
</html>
