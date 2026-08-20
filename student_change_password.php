<?php
session_start();
include("db.php");

if(!isset($_SESSION['student_id']))
{
    header("Location: student_login.php");
    exit();
}

$message="";

if(isset($_POST['change']))
{
    $id=$_SESSION['student_id'];

    $old=$_POST['old_password'];
    $new=$_POST['new_password'];
    $confirm=$_POST['confirm_password'];

    $stmt=mysqli_prepare(
    $conn,
    "SELECT password FROM students WHERE id=?"
    );

    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);

    $result=mysqli_stmt_get_result($stmt);
    $student=mysqli_fetch_assoc($result);

    if(password_verify($old,$student['password']))
    {
        if($new==$confirm)
        {
            $hash=password_hash($new,PASSWORD_DEFAULT);

            $stmt=mysqli_prepare(
            $conn,
            "UPDATE students SET password=? WHERE id=?"
            );

            mysqli_stmt_bind_param(
            $stmt,
            "si",
            $hash,
            $id
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
<title>Student Change Password</title>
<style>

body{
    margin:0;
    font-family:Arial,sans-serif;
    background:linear-gradient(135deg,#0F172A,#2563EB);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.box{
    width:420px;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 5px 25px rgba(0,0,0,0.25);
    text-align:center;
}

.box h2{
    color:#0F172A;
    margin-bottom:25px;
}

.box input[type="password"]{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #CBD5E1;
    border-radius:10px;
    box-sizing:border-box;
    font-size:15px;
}

.box input[type="submit"]{
    width:100%;
    background:#2563EB;
    color:white;
    border:none;
    padding:14px;
    border-radius:10px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

.box input[type="submit"]:hover{
    background:#1D4ED8;
}

.message{
    margin-top:15px;
    font-weight:bold;
    color:green;
}

.error{
    margin-top:15px;
    font-weight:bold;
    color:red;
}

</style>

</head>

<body>

<div class="box">

<h2>Student Change Password</h2>

<form method="POST">

<input type="password"
name="old_password"
placeholder="Old Password"
required>

<input type="password"
name="new_password"
placeholder="New Password"
required>

<input type="password"
name="confirm_password"
placeholder="Confirm Password"
required>

<input type="submit"
name="change"
value="Change Password">

</form>

<?php
if($message!="")
{
    echo "<p class='message'>$message</p>";
}
?>

</div>

</body>