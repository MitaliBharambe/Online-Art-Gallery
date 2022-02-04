<html>

<head>
    <title>Register</title>
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

    <p><a href="register.php">Register</a> | <a href="login.php">Login</a></p>

    <center>
        <h2>Registration Form</h2>
    </center>
    <form action="" method="POST">

        <legend>
            <fieldset>
                <table border="1px" cellpadding="5px" align="center"
                    style="color: black; text-align: center; background-color: lightgrey"><br />
                    <tr>
                        <td>NAME:</td>
                        <td><input type=text name=user size=30></td>
                    </tr>
                    <tr>
                        <td>CONTACT:</td>
                        <td><input type=text name=contact size=30></td>
                    </tr>
                    <tr>
                        <td>E-MAIL:</td>
                        <td><input type=email name=email size=30></td>
                    </tr>
                    <tr>
                        <td>CITY:</td>
                        <td><input type=text name=city size=30></td>
                    </tr>
                    <tr>
                        <td>PASSWORD:</td>
                        <td><input type=password name=pass size=30></td>
                    </tr>
                    <tr>
                        <td><input type=submit value="REGISTER" name="submit"
                                style="background-color: white; color: darkblue"></td>
                        <td><input type=reset style="background-color : white; color: darkblue"></td>
                    </tr>
                </table>
            </fieldset>
        </legend>
    </form>
    <?php  
if(isset($_POST["submit"])){  
if(!empty($_POST['user']) && !empty($_POST['contact']) && !empty($_POST['email']) && !empty($_POST['city']) && !empty($_POST['pass']) ) {  
    $user=$_POST['user']; 
    $num=$_POST['contact']; 
    $email=$_POST['email'];
    $city=$_POST['city']; 
    $pass=$_POST['pass'];  
    $con=mysqli_connect('localhost','root','','microproject') or die(mysql_error());  
    //mysqli_select_db('user_registration') or die("cannot select DB");  
  
    $query=mysqli_query($con,"SELECT * FROM user WHERE name='".$user."'");  
    $numrows=mysqli_num_rows($query);  
    if($numrows==0)  

    {  

    $sql="INSERT INTO user(name,contact,email,city,password) VALUES('$user','$num','$email','$city','$pass')";  
    $result=mysqli_query($con,$sql);  

        if($result){  
    echo "Account Successfully Created";  
    } else {  
    echo "Failure!";  
    }  
  
    } else {  
    echo "That username already exists! Please try again with another.";  
    }  
  
} else {  
    echo "All fields are required!";  
}  
}  
?>
</body>

</html>