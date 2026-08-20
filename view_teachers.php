<?php
include("db.php");

$query = "SELECT * FROM teachers";
$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Teachers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Teachers List</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Specialization</th>
    <th>Actions</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['teacher_name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['specialization']; ?></td>
    <td>
    <a href="edit_teacher.php?id=<?php echo $row['id']; ?>">Edit</a>
    |
    <a href="delete_teacher.php?id=<?php echo $row['id']; ?>"
       onclick="return confirm('Delete this teacher?')">
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