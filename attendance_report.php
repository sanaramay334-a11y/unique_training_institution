<?php
include("db.php");

$query = "
SELECT
students.student_name,
COUNT(CASE WHEN attendance.status='Present' THEN 1 END) AS present_count,
COUNT(CASE WHEN attendance.status='Absent' THEN 1 END) AS absent_count
FROM attendance
INNER JOIN students
ON attendance.student_id = students.id
GROUP BY attendance.student_id
";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>

<html>
<head>
    <title>Attendance Report</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Attendance Report</h2>

<table>

<tr>
    <th>Student Name</th>
    <th>Present Days</th>
    <th>Absent Days</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>
    <td><?php echo $row['student_name']; ?></td>
    <td><?php echo $row['present_count']; ?></td>
    <td><?php echo $row['absent_count']; ?></td>
</tr>

<?php
}
?>

</table>

</body>
</html>
