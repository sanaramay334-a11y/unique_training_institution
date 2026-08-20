<?php
include("db.php");

$query = "SELECT * FROM courses";
$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>

<title>View Courses</title>

<style>

body{
background:#F8FAFC;
font-family:Arial,sans-serif;
margin:0;
padding:20px;
}

h2{
text-align:center;
color:#0F172A;
margin-bottom:25px;
}

table{
width:95%;
margin:auto;
border-collapse:collapse;
background:white;
box-shadow:0 5px 20px rgba(0,0,0,.15);
}

th{
background:#2563EB;
color:white;
padding:15px;
}

td{
padding:12px;
text-align:center;
border-bottom:1px solid #ddd;
}

tr:hover{
background:#F1F5F9;
}

img{
border-radius:8px;
object-fit:cover;
}

.edit-btn{
background:#2563EB;
color:white;
padding:8px 15px;
text-decoration:none;
border-radius:6px;
}

.delete-btn{
background:#DC2626;
color:white;
padding:8px 15px;
text-decoration:none;
border-radius:6px;
}

.edit-btn:hover{
background:#1D4ED8;
}

.delete-btn:hover{
background:#B91C1C;
}

</style>

</head>

<body>

<h2>📚 Courses List</h2>

<table>

<tr>

<th>ID</th>

<th>Image</th>

<th>Course Name</th>

<th>Duration</th>

<th>Fee</th>

<th>Description</th>

<th>Actions</th>

</tr>

<?php
while($row=mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>

<img
src="course_images/<?php echo $row['course_image']; ?>"
width="100"
height="70">

</td>

<td><?php echo $row['course_name']; ?></td>

<td><?php echo $row['duration']; ?></td>

<td><?php echo $row['fee']; ?></td>

<td><?php echo $row['description']; ?></td>

<td>

<a
class="edit-btn"
href="edit_course.php?id=<?php echo $row['id']; ?>">
Edit
</a>

<br><br>

<a
class="delete-btn"
href="delete_course.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this course?')">
Delete
</a>

</td>

</tr>

<?php
}
?>

</table>

</body>
</html>