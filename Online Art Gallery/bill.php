<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "microproject");
$query=mysqli_query($connect,"SELECT * FROM user WHERE name='".$_SESSION['sess_user']."'");  
    $numrows=mysqli_num_rows($query);  
    $name=$num=$em=$city=" ";
    if($numrows!=0)  
    {  
		while($row=mysqli_fetch_assoc($query))  		{  
			$name=$row['name'];  
			$num=$row['contact'];
			$em=$row['email'];
			$city=$row['city'];  

		}    } 
    $total=$_SESSION['tot'];
?>
<html>

<head>
    <title>Bill</title>
    <style>
    body {
        margin-top: 100px;
        margin-bottom: 100px;
        margin-right: 150px;
        margin-left: 80px;
        background-color: azure;
        color: palevioletred;
        font-family: verdana;
        font-size: 100%
    }

    h1 {
        color: indigo;

        font-family: verdana;
        font-size: 100%;
    }

    h2 {
        color: indigo;
        font-family: verdana;
        font-size: 100%;
    }
    </style>
</head>

<body>
    <form action="" method="POST">
        <table border="1px" cellpadding="5px" align="center"
            style="color: black; text-align: center; background-color: lightgrey"><br />
            <tr>
                <td>NAME:</td>
                <td><input type=text name=user size=30 value=<?php echo $name;?>></td </tr>
            <tr>
                <td>CONTACT:</td>
                <td><input type=text name=contact size=30 value=<?php echo $num;?>></td>
            </tr>
            <tr>
                <td>E-MAIL:</td>
                <td><input type=email name=email size=30 value=<?php echo $em;?>></td>
            </tr>
            <tr>
                <td>CITY:</td>
                <td><input type=text name=city size=30 value=<?php echo $city;?>></td>
            </tr>
            <tr>
                <td>Total Amount:</td>
                <td><?php echo "Rs.".$_SESSION['tot'];?></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Confirm Order" name="submit"></td>
            </tr>
        </table>
    </form>
</body>

</html>


<?php
if(isset($_POST["submit"]))
{
	$n=$_POST["user"];
	$c=$_POST["contact"];
	$e=$_POST["email"];
	$ci=$_POST["city"];

    $mail_id = "mitalibharambe4434@gmail.com";

	$to = $em;
    $subject = "PHP MAIL";

    $message = "Sample Php Mail";
    $header = "From:".$mail_id."\r\n"; 
    $header .= "CC: ".$mail_id."\r\n"; 
    $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";     
    $subject='Your order has been placed successfully.';
	$message= "
        <html>
            <body>
                <table style='width:600px;'>
                    <tbody>
                        <tr>
                            <td style='width:150px'><strong>Name: </strong></td>
                            <td style='width:400px'>$n</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Email ID: </strong></td>
                            <td style='width:400px'>$e</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Mobile No: </strong></td>
                            <td style='width:400px'>$c</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Address: </strong></td>
                            <td style='width:400px'>$ci</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Total Bill: </strong></td>
                            <td style='width:400px'>$total</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Arrival Date: </strong></td>
                            <td style='width:400px'><strong>It will arrive in 2 to 3 days</strong></td>
                        </tr>
                    </tbody>
                </table>
            </body>

        </html>
        ";
        $retval = mail($to,$subject,$message,$header);
        if( $retval == true ) {
            $connect = mysqli_connect("localhost", "root", "", "microproject");
            $sql = "INSERT INTO order_place(name,contact,email,city,total)VALUES('$n','$c','$e','$ci','$total')";
                $retval = mysqli_query($connect, $sql);
                if($retval ) {
                    //echo "New Record Inserted";
                    echo "Order Successfully Placed";}
                else		
                {echo "Error" .$sql."<br>".mysqli_error($connect);}         
            }
            else 
            {
            echo "Mail could not be sent...";
            }  
         }
?>