<?php
session_start();
include("db.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:student_login.php");
    exit();
}

$id=$_SESSION['student_id'];

$query=mysqli_query($conn,
"SELECT * FROM students WHERE id='$id'");

$row=mysqli_fetch_assoc($query);

$message="";

if(isset($_POST['update']))
{
    $student_name=$_POST['student_name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];

    $picture=$row['picture'];

    if($_FILES['picture']['name']!="")
    {
        $picture=$_FILES['picture']['name'];

        move_uploaded_file(
        $_FILES['picture']['tmp_name'],
        "uploads/".$picture
        );
    }

    mysqli_query($conn,
    "UPDATE students SET

    student_name='$student_name',

    email='$email',

    phone='$phone',

    picture='$picture'

    WHERE id='$id'");

    $message="Profile Updated Successfully";

    $query=mysqli_query($conn,
    "SELECT * FROM students WHERE id='$id'");

    $row=mysqli_fetch_assoc($query);
}
?>
<!DOCTYPE html>

<html>

<head>

<title>Edit Profile</title>

<style>

body{
margin:0;
font-family:Arial,sans-serif;
background:#F1F5F9;
}

.box{
width:550px;
margin:40px auto;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,.15);
}

.box h2{
text-align:center;
margin-bottom:25px;
}

label{
font-weight:bold;
display:block;
margin-top:10px;
}

input[type=text],
input[type=email],
input[type=password],
input[type=file]{

width:100%;
padding:12px;
margin-top:5px;
margin-bottom:15px;
box-sizing:border-box;
}

input[type=submit]{

width:100%;
padding:12px;
background:#2563EB;
color:white;
border:none;
cursor:pointer;
font-size:16px;
font-weight:bold;
}

input[type=submit]:hover{

background:#1D4ED8;
}

.profile-img{

display:block;
margin:auto;
width:120px;
height:120px;
border-radius:50%;
object-fit:cover;
border:3px solid #2563EB;
}

.message{

color:green;
font-weight:bold;
text-align:center;
}

.error{

color:red;
font-weight:bold;
text-align:center;
}

hr{

margin:35px 0;
}

</style>

</head>

<body>

<div class="box">

<h2>Edit Profile</h2>

<form method="POST" enctype="multipart/form-data">

<img class="profile-img"
src="uploads/<?php echo $row['picture']; ?>">

<br>

<label>Student Name</label>

<input
type="text"
name="student_name"
value="<?php echo $row['student_name']; ?>"
required>

<label>Email</label>

<input
type="email"
name="email"
value="<?php echo $row['email']; ?>">

<label>Phone</label>

<input
type="text"
name="phone"
value="<?php echo $row['phone']; ?>">

<label>Change Picture</label>

<input
type="file"
name="picture">

<input
type="submit"
name="update"
value="Update Profile">

</form>

<?php
if($message!="")
{
echo "<p class='message'>$message</p>";
}
?>

<hr>
<?php

if(isset($_POST['change_password']))
{
    $old=$_POST['old_password'];
    $new=$_POST['new_password'];
    $confirm=$_POST['confirm_password'];

    $query=mysqli_query($conn,
    "SELECT password FROM students WHERE id='$id'");

    $student=mysqli_fetch_assoc($query);

    if(password_verify($old,$student['password']))
    {
        if($new==$confirm)
        {
            $hash=password_hash($new,PASSWORD_DEFAULT);

            mysqli_query($conn,
            "UPDATE students
            SET password='$hash'
            WHERE id='$id'");

            echo "<p class='message'>
            Password Changed Successfully
            </p>";
        }
        else
        {
            echo "<p class='error'>
            New Passwords Do Not Match
            </p>";
        }
    }
    else
    {
        echo "<p class='error'>
        Old Password Incorrect
        </p>";
    }
}

?>

<h2>Change Password</h2>

<form method="POST">

<label>Old Password</label>

<input
type="password"
name="old_password"
placeholder="Enter Old Password"
required>

<label>New Password</label>

<input
type="password"
name="new_password"
placeholder="Enter New Password"
required>

<label>Confirm Password</label>

<input
type="password"
name="confirm_password"
placeholder="Confirm New Password"
required>

<input
type="submit"
name="change_password"
value="Change Password">

</form>

</div>

</body>

</html>