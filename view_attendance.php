<?php
include("db.php");

$query = "
SELECT attendance.*, students.student_name
FROM attendance
INNER JOIN students
ON attendance.student_id = students.id
ORDER BY attendance.id DESC
";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Records</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Attendance Records</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Student Name</th>
    <th>Date</th>
    <th>Status</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['student_name']; ?></td>
    <td><?php echo $row['attendance_date']; ?></td>
    <td><?php echo $row['status']; ?></td>
</tr>

<?php
}
?>

</table>

</body>
</html>