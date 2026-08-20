<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("db.php");

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

$message="";

$query=mysqli_query($conn,"SELECT * FROM settings LIMIT 1");
$row=mysqli_fetch_assoc($query);

if(isset($_POST['save']))
{
    $institute_name=$_POST['institute_name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $facebook=$_POST['facebook'];
    $whatsapp=$_POST['whatsapp'];
    $footer=$_POST['footer'];

    $logo=$row['logo'];

    if($_FILES['logo']['name']!="")
    {
        $logo=$_FILES['logo']['name'];

        move_uploaded_file(
        $_FILES['logo']['tmp_name'],
        "images/".$logo
        );
    }

    mysqli_query($conn,"
    UPDATE settings SET

    institute_name='$institute_name',
    phone='$phone',
    email='$email',
    address='$address',
    facebook='$facebook',
    whatsapp='$whatsapp',
    footer='$footer',
    logo='$logo'

    WHERE id=1
    ");

    $message="Settings Updated Successfully";

    header("Refresh:1");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Website Settings</title>

<style>

body{
background:#F1F5F9;
font-family:Arial;
}

.box{
width:700px;
margin:30px auto;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,.15);
}

.box h2{
text-align:center;
margin-bottom:25px;
}

.box input,
.box textarea{
width:100%;
padding:12px;
margin-bottom:15px;
box-sizing:border-box;
}

.box input[type=submit]{
background:#2563EB;
color:white;
border:none;
cursor:pointer;
}

.box input[type=submit]:hover{
background:#1D4ED8;
}

.msg{
text-align:center;
color:green;
font-weight:bold;
}

</style>

</head>

<body>

<div class="box">

<h2>Website Settings</h2>

<form method="POST" enctype="multipart/form-data">

<label>Institute Name</label>
<input type="text"
name="institute_name"
value="<?php echo $row['institute_name']; ?>">

<label>Phone</label>
<input type="text"
name="phone"
value="<?php echo $row['phone']; ?>">

<label>Email</label>
<input type="email"
name="email"
value="<?php echo $row['email']; ?>">

<label>Address</label>
<textarea
name="address"><?php echo $row['address']; ?></textarea>

<label>Facebook</label>
<input type="text"
name="facebook"
value="<?php echo $row['facebook']; ?>">

<label>WhatsApp</label>
<input type="text"
name="whatsapp"
value="<?php echo $row['whatsapp']; ?>">

<label>Footer</label>
<textarea
name="footer"><?php echo $row['footer']; ?></textarea>

<label>Current Logo</label><br><br>

<img src="images/<?php echo $row['logo']; ?>"
width="120"><br><br>

<label>Change Logo</label>

<input type="file" name="logo">

<input
type="submit"
name="save"
value="Save Settings">

</form>

<p class="msg">
<?php echo $message; ?>
</p>

</div>

</body>
</html>