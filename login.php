<html>

<head>
    <title>Login</title>
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

    h3 {
        color: indigo;
        font-family: verdana;
        font-size: 100%;
    }
    </style>
</head>

<body>
    <center>
        <h1>WELCOME TO ONLINE ART GALLERY</h1>
    </center>
    <p><a href="register.php">Register</a> | <a href="login.php">Login</a></p>
    <center>
        <h3>Login Form</h3>
    </center>
    <form action="" method="POST">
        <legend>
            <fieldset>
                <center>
                    Username: <input type="text" name="user"><br><br>
                    Password: <input type="password" name="pass"><br><br>
                    <input type="submit" value="Login" name="submit" onclick="cart.php"
                        style="background-color: lightblue; color: darkblue">
                </center>
            </fieldset>
        </legend>
    </form>
    <?php  
if(isset($_POST["submit"])){  
if(!empty($_POST['user']) && !empty($_POST['pass'])) {  
    $user=$_POST['user'];  
    $pass=$_POST['pass'];  
  $con=mysqli_connect('localhost','root','','microproject') or die(mysql_error());  
  //mysqli_select_db('product2',$con) or die("cannot select DB");  
    $query=mysqli_query($con,"SELECT * FROM user WHERE name='".$user."' AND password='".$pass."'");  

    $numrows=mysqli_num_rows($query);  
    if($numrows!=0)  
    {  
    while($row=mysqli_fetch_assoc($query))  
    {  
    $dbusername=$row['name'];  
    $dbpassword=$row['password'];  
    }  
  
    if($user == $dbusername && $pass == $dbpassword)  
    {  
    session_start();  
    $_SESSION['sess_user']=$user;  
  
    /* Redirect browser */  
    header("Location: cart.php");  
    }  
    } else {  
    echo "Invalid username or password!";  
    }  } else {  
    echo "All fields are required!"; }  
}  ?>
</body>

</html>