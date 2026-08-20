<?php
include("db.php");

$id = $_GET['id'];

$query = "SELECT * FROM students WHERE id='$id'";
$result = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $student_name = $_POST['student_name'];
    $father_name = $_POST['father_name'];
    $class_name = $_POST['class_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    if($_FILES['picture']['name'] != "")
    {
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


        move_uploaded_file(
            $tmp_name,
            "uploads/" . $picture
        );

        $update = "UPDATE students SET
        student_name='$student_name',
        father_name='$father_name',
        class_name='$class_name',
        email='$email',
        phone='$phone',
        course='$course',
        picture='$picture'
        WHERE id='$id'";
    }
    else
    {
        $update = "UPDATE students SET
        student_name='$student_name',
        father_name='$father_name',
        class_name='$class_name',
        email='$email',
        phone='$phone',
        course='$course'
        WHERE id='$id'";
    }

    if(mysqli_query($conn,$update))
    {
        header("Location: view_students.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
    <style>

body{
    background:#F1F5F9;
    font-family:Arial, sans-serif;
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
.form-container input[type="file"]{
    width:100%;
    padding:12px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #CBD5E1;
    border-radius:8px;
    box-sizing:border-box;
}

.form-container img{
    border-radius:10px;
    border:2px solid #CBD5E1;
    margin-bottom:15px;
}

.form-container input[type="submit"]{
    width:100%;
    background:#2563EB;
    color:white;
    border:none;
    padding:14px;
    border-radius:10px;
    font-size:16px;
    cursor:pointer;
    font-weight:bold;
}

</style>
</head>
<body>

<body>

<div class="form-container">

<h2>Edit Student</h2>

<form method="POST" enctype="multipart/form-data">
<label>Student Name</label><br>
<input type="text" name="student_name"
value="<?php echo $row['student_name']; ?>" required><br><br>

<label>Father Name</label><br>
<input type="text" name="father_name"
value="<?php echo $row['father_name']; ?>" required><br><br>

<label>Class</label><br>
<input type="text" name="class_name"
value="<?php echo $row['class_name']; ?>" required><br><br>

<label>Email</label><br>
<input type="email" name="email"
value="<?php echo $row['email']; ?>"><br><br>

<label>Phone</label><br>
<input type="text" name="phone"
value="<?php echo $row['phone']; ?>"><br><br>

<label>Course</label><br>
<input type="text" name="course"
value="<?php echo $row['course']; ?>"><br><br>

<label>Current Picture</label><br>

<img src="uploads/<?php echo $row['picture']; ?>"
width="120"
height="120"
style="border-radius:10px;"><br><br>

<label>New Picture</label><br>
<input type="file" name="picture"><br><br>

<input type="submit"
name="update"
value="Update Student">

</form>
</div>