<?php
include("db.php");

$id = $_GET['id'];

$query = "SELECT * FROM courses WHERE id='$id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $course_name = $_POST['course_name'];
    $duration = $_POST['duration'];
    $fee = $_POST['fee'];
    $description = $_POST['description'];

    $course_image = $row['course_image'];

    if($_FILES['course_image']['name']!="")
    {
        $course_image = $_FILES['course_image']['name'];

        move_uploaded_file(
        $_FILES['course_image']['tmp_name'],
        "course_images/".$course_image
        );
    }

    $update = "UPDATE courses SET

    course_name='$course_name',
    duration='$duration',
    fee='$fee',
    description='$description',
    course_image='$course_image'

    WHERE id='$id'";

    if(mysqli_query($conn,$update))
    {
        header("Location: view_courses.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Course</title>

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
.form-container input[type=number],
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
background:#2563EB;
color:white;
border:none;
padding:14px;
border-radius:10px;
font-size:16px;
font-weight:bold;
cursor:pointer;

}

.form-container input[type=submit]:hover{
background:#1D4ED8;
}

.current-img{

width:180px;
height:120px;
object-fit:cover;
border-radius:10px;
margin-bottom:15px;

}

</style>

</head>

<body>

<div class="form-container">

<h2>📚 Edit Course</h2>

<form method="POST" enctype="multipart/form-data">

<label>Course Name</label>

<input
type="text"
name="course_name"
value="<?php echo $row['course_name']; ?>"
required>

<label>Duration</label>

<input
type="text"
name="duration"
value="<?php echo $row['duration']; ?>"
required>

<label>Course Fee</label>

<input
type="number"
name="fee"
value="<?php echo $row['fee']; ?>"
required>

<label>Description</label>

<textarea
name="description"
required><?php echo $row['description']; ?></textarea>

<label>Current Image</label>

<img
src="course_images/<?php echo $row['course_image']; ?>"
class="current-img">

<label>Change Image</label>

<input
type="file"
name="course_image">

<input
type="submit"
name="update"
value="Update Course">

</form>

</div>

</body>
</html>