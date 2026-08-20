<?php
session_start();
include("db.php");

$message = null;

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare(
        $conn,
        "SELECT * FROM users WHERE email=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $email
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) == 1)
    {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password']))
        {
            session_regenerate_id(true);

            $_SESSION['admin'] = $email;

            header("Location: dashboard.php");
            exit();
        }
        else
        {
            $message = "Invalid Email or Password";
        }
    }
    else
    {
        $message = "Invalid Email or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
body{
    background:#F1F5F9;
    font-family:Arial,sans-serif;
}

.form-container{
    width:600px;
    margin:40px auto;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

.form-container h2{
    text-align:center;
    color:#0F172A;
    margin-bottom:25px;
}

.form-container label{
    font-weight:bold;
    color:#334155;
}

.form-container input[type="text"],
.form-container input[type="email"],
.form-container input[type="password"]{
    width:100%;
    padding:12px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #CBD5E1;
    border-radius:8px;
    box-sizing:border-box;
}

.form-container input[type="submit"]{
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

.form-container input[type="submit"]:hover{
    background:#1D4ED8;
}

.success{
    text-align:center;
    color:green;
    font-weight:bold;
}
</style>
</head>

<body>
<div class="form-container">
<h2>Admin Login</h2>

<form method="POST">

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required>

    <br><br>

    <input type="checkbox" onclick="showPassword()">
    Show Password

    <br><br>

    <input type="submit" name="login" value="Login">

    <br><br>

 <?php
if($message !== null)
{
    echo "<h3>$message</h3>";
}
?>

</form>
</div>
<script>
function showPassword() {
    var x = document.getElementsByName("password")[0];

    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>

</body>
</html>
