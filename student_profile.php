<?php
include("db.php");

$id = $_GET['id'];

$query = "SELECT * FROM students WHERE id='$id'";
$result = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
   <style> 
    <title>Student Profile</title>
    <link rel="stylesheet" href="style.css">
    .edit-btn{
display:inline-block;
margin-top:20px;
padding:12px 25px;
background:#2563EB;
color:white;
text-decoration:none;
border-radius:8px;
font-size:16px;
font-weight:bold;
transition:0.3s;
}

.edit-btn:hover{
background:#1D4ED8;
transform:scale(1.05);
}
</style>
</head>
<body>

<h2>Student Profile</h2>

<div class="card">

<center>

<img src="uploads/<?php echo $row['picture']; ?>"
     width="150"
     height="150">

<h2><?php echo $row['student_name']; ?></h2>

</center>

<p><strong>Father Name:</strong>
<?php echo $row['father_name']; ?></p>

<p><strong>Class:</strong>
<?php echo $row['class_name']; ?></p>

<p><strong>Email:</strong>
<?php echo $row['email']; ?></p>

<p><strong>Phone:</strong>
<?php echo $row['phone']; ?></p>

<p><strong>Course:</strong>
<?php echo $row['course']; ?></p>

</div>


<center>

<a href="edit_profile.php" class="edit-btn">
✏ Edit Profile
</a>

</center>

</body>
</html>