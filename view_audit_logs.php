<?php
include("db.php");

$query = "SELECT * FROM audit_logs ORDER BY id DESC";
$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Audit Logs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Audit Logs</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Action</th>
    <th>User</th>
    <th>Date & Time</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['action']; ?></td>
    <td><?php echo $row['user_name']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
</tr>

<?php
}
?>

</table>

</body>
</html>