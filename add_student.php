<?php
include("db.php");

if(isset($_POST['save']))
{
    $student_name = $_POST['student_name'];
    $father_name = $_POST['father_name'];
$class_name = $_POST['class_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $username = $_POST['username'];

$password = password_hash(
    $_POST['password'],
    PASSWORD_DEFAULT
);
 $picture = $_FILES['picture']['name'];
$tmp_name = $_FILES['picture']['tmp_name'];
$allowed = ["jpg","jpeg","png"];

$extension = strtolower(
pathinfo($picture, PATHINFO_EXTENSION)
);

if(!in_array($extension, $allowed))
{
die("Only JPG, JPEG and PNG files are allowed.");
}

if($_FILES['picture']['size'] > 2097152)
{
die("File size must be less than 2MB.");
}


if(!file_exists("uploads"))
{
    mkdir("uploads", 0777, true);
}

$upload_path = __DIR__ . "/uploads/" . $picture;

$query = "INSERT INTO students
(student_name,father_name,class_name,email,phone,course,username,password,picture)
VALUES
('$student_name','$father_name','$class_name','$email','$phone','$course','$username','$password','$picture')";

   if(mysqli_query($conn,$query))
{
    $audit = "INSERT INTO audit_logs
    (action,user_name)
    VALUES
    ('Student Added','Admin')";

    mysqli_query($conn,$audit);

    $message = "Student Added Successfully";
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
<h2>Add Student</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Student Name</label><br>
    <input type="text" name="student_name" required><br><br>
    <label>Father Name</label><br>
<input type="text" name="father_name" required><br><br>

<label>Class</label><br>
<input type="text" name="class_name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Phone</label><br>
    <input type="text" name="phone"><br><br>

    <label>Course</label><br>
    <input type="text" name="course"><br><br>
    <label>Username</label><br>
<input type="text" name="username" required><br><br>

<label>Password</label><br>
<input type="password" name="password" required><br><br>

    <label>Student Picture</label><br>
<input type="file" name="picture"><br><br>

    <input type="submit" name="save" value="Add Student">
    <style>
        .form-container{
    width:600px;
    margin:40px auto;
    background:#ffffff;
    padding:35px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

.form-container h2{
    text-align:center;
    color:#0F172A;
    margin-bottom:25px;
    font-size:32px;
}

.form-container label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
    color:#334155;
}

.form-container input[type="text"],
.form-container input[type="email"]{
    width:100%;
    padding:12px;
    border:1px solid #CBD5E1;
    border-radius:8px;
    box-sizing:border-box;
    margin-bottom:15px;
}

.form-container input[type="file"]{
    width:100%;
    padding:10px;
    border:1px solid #CBD5E1;
    border-radius:8px;
    background:#F8FAFC;
    margin-bottom:20px;
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
</form>
</div>

<?php
if(isset($message))
{
    echo "<h3>$message</h3>";
}
?>

</body>
</html>