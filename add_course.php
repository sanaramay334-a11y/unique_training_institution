<?php
include("db.php");

if(isset($_POST['save']))
{
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $fee = $_POST['fee'];

    $course_image = "";

    if($_FILES['course_image']['name']!="")
    {
        $course_image = $_FILES['course_image']['name'];

        move_uploaded_file(
        $_FILES['course_image']['tmp_name'],
        "course_images/".$course_image
        );
    }

    $query = "INSERT INTO courses
    (course_name,description,duration,fee,course_image)
    VALUES
    (
    '$course_name',
    '$description',
    '$duration',
    '$fee',
    '$course_image'
    )";

    if(mysqli_query($conn,$query))
    {
        $message="Course Added Successfully";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Course</title>

<style>

body{
background:#F1F5F9;
font-family:Arial,sans-serif;
}

.form-container{
width:650px;
margin:40px auto;
background:white;
padding:35px;
border-radius:20px;
box-shadow:0 5px 20px rgba(0,0,0,.15);
}

.form-container h2{
text-align:center;
margin-bottom:25px;
}

.form-container label{
font-weight:bold;
display:block;
margin-bottom:5px;
}

.form-container input[type=text],
.form-container textarea,
.form-container input[type=file]{
width:100%;
padding:12px;
margin-bottom:15px;
border:1px solid #CBD5E1;
border-radius:8px;
box-sizing:border-box;
}

.form-container textarea{
height:120px;
resize:none;
}

.form-container input[type=submit]{
width:100%;
padding:14px;
background:#2563EB;
color:white;
border:none;
border-radius:10px;
font-size:16px;
font-weight:bold;
cursor:pointer;
}

.form-container input[type=submit]:hover{
background:#1D4ED8;
}

.success{
text-align:center;
color:green;
font-weight:bold;
margin-top:15px;
}

</style>

</head>

<body>

<div class="form-container">

<h2>📚 Add Course</h2>

<form method="POST" enctype="multipart/form-data">

<label>Course Name</label>
<input type="text" name="course_name" required>

<label>Course Description</label>
<textarea name="description" required></textarea>

<label>Duration</label>
<input type="text" name="duration" placeholder="3 Months" required>

<label>Course Fee</label>
<input type="text" name="fee" placeholder="Rs. 8000" required>

<label>Course Image</label>
<input type="file" name="course_image" required>

<input type="submit" name="save" value="Add Course">

</form>

<?php
if(isset($message))
{
echo "<p class='success'>$message</p>";
}
?>

</div>

</body>
</html>