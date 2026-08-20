<?php
session_start();
include("db.php");

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

$message="";

if(isset($_POST['change']))
{
    $email=$_SESSION['admin'];

    $old=$_POST['old_password'];
    $new=$_POST['new_password'];
    $confirm=$_POST['confirm_password'];

    $stmt=mysqli_prepare(
    $conn,
    "SELECT password FROM users WHERE email=?"
    );

    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);

    $result=mysqli_stmt_get_result($stmt);
    $user=mysqli_fetch_assoc($result);

    if(password_verify($old,$user['password']))
    {
        if($new==$confirm)
        {
            $hash=password_hash($new,PASSWORD_DEFAULT);

            $stmt=mysqli_prepare(
            $conn,
            "UPDATE users SET password=? WHERE email=?"
            );

            mysqli_stmt_bind_param(
            $stmt,
            "ss",
            $hash,
            $email
            );

            mysqli_stmt_execute($stmt);

            $message="Password Changed Successfully";
        }
        else
        {
            $message="New Passwords Do Not Match";
        }
    }
    else
    {
        $message="Old Password Incorrect";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>

<style>

body{
font-family:Arial;
background:#F1F5F9;
}

.box{
width:450px;
margin:50px auto;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,.15);
}

input{
width:100%;
padding:12px;
margin:10px 0;
}

button{
width:100%;
padding:12px;
background:#2563EB;
color:white;
border:none;
cursor:pointer;
}

</style>

</head>

<body>

<div class="box">

<h2>Change Password</h2>

<form method="POST">

<input
type="password"
name="old_password"
placeholder="Old Password"
required>

<input
type="password"
name="new_password"
placeholder="New Password"
required>

<input
type="password"
name="confirm_password"
placeholder="Confirm Password"
required>

<button
name="change">
Change Password
</button>

</form>

<p style="color:green;">
<?php echo $message; ?>
</p>

</div>

</body>

</html>