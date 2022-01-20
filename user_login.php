<?php
 session_start();
$con=mysqli_connect("localhost","root","","user_detail");
if(!$con)
die("server could not connected");

if(isset($_POST["login"])){
    $email=$_POST["email"];
    $pass=$_POST["pass"];

    $sql="select * from signup_detail where Email='".$email."'";
    $rs=mysqli_query($con,$sql);
    $val=mysqli_fetch_assoc($rs);
    if($val["Password"]==$pass){
        $_SESSION["Email"]=$email;
        header("location:index.php?");
    }else{
        header("location:index.php?error=404");
    }
}

?>