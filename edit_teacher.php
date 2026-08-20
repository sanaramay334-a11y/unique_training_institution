<?php
include("db.php");

$id = $_GET['id'];

$query = "SELECT * FROM teachers WHERE id='$id'";
$result = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $teacher_name = $_POST['teacher_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $specialization = $_POST['specialization'];

    $update = "UPDATE teachers SET
    teacher_name='$teacher_name',
    email='$email',
    phone='$phone',
    specialization='$specialization'
    WHERE id='$id'";

    if(mysqli_query($conn,$update))
    {
        header("Location: view_teachers.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Teacher</title>
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
.form-container input[type="email"]{
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
</style>

</head>
<body>

\<div class="form-container">

<h2>👨‍🏫 Edit Teacher</h2>

<form method="POST">


    <label>Name</label><br>
    <input type="text" name="teacher_name"
    value="<?php echo $row['teacher_name']; ?>" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email"
    value="<?php echo $row['email']; ?>"><br><br>

    <label>Phone</label><br>
    <input type="text" name="phone"
    value="<?php echo $row['phone']; ?>"><br><br>

    <label>Specialization</label><br>
    <input type="text" name="specialization"
    value="<?php echo $row['specialization']; ?>"><br><br>

    <input type="submit" name="update" value="Update Teacher">

</form>
</div>

</body>
</html>