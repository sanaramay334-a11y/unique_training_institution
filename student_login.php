<?php
session_start();
include("db.php");

$message = "";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare(
        $conn,
        "SELECT * FROM students WHERE username=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $username
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) == 1)
    {
        $student = mysqli_fetch_assoc($result);

        if(password_verify($password, $student['password']))
        {
            $_SESSION['student_id'] = $student['id'];

            header("Location: student_dashboard.php");
            exit();
        }
        else
        {
            $message = "Invalid Login";
        }
    }
    else
    {
        $message = "Invalid Login";
    }
}
?>


<!DOCTYPE html>

<html>
<head>
<title>Student Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-box">

<div class="login-icon">🎓</div>

<h2>Student Login</h2>

<form method="POST">

<input type="text"
name="username"
placeholder="Enter Username"
required>

<input type="password"
name="password"
placeholder="Enter Password"
required>

<input type="submit"
name="login"
value="Login">

</form>
<?php
if($message != "")
{
    echo "<p style='color:red;
    font-weight:bold;
    margin-top:15px;'>
    $message
    </p>";
}
?>
</div>
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

.login-box{
    width:400px;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 5px 25px rgba(0,0,0,0.25);
    text-align:center;
}

.login-box h2{
    color:#0F172A;
    margin-bottom:25px;
}

.login-icon{
    font-size:60px;
    margin-bottom:15px;
}

.login-box input[type="text"],
.login-box input[type="password"]{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #CBD5E1;
    border-radius:10px;
    box-sizing:border-box;
}

.login-box input[type="submit"]{
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

.login-box input[type="submit"]:hover{
    background:#1D4ED8;
}
</style>
</html>
