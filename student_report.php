<?php
include("db.php");

$query = "SELECT * FROM students";
$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>

<html>
<head>
    <title>Student Report</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Student Report</h2>

<button onclick="window.print()">Print Report</button>

<br><br>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Picture</th>
    <th>Name</th>
    <th>Father Name</th>
    <th>Class</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Course</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td>
<img src="uploads/<?php echo $row['picture']; ?>"
width="60"
height="60"
style="border-radius:50%;">
</td>
    <td><?php echo $row['student_name']; ?></td>
    <td><?php echo $row['father_name']; ?></td>
    <td><?php echo $row['class_name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['course']; ?></td>
</tr>
<?php
}
?>

</table>

</body>
</html>
