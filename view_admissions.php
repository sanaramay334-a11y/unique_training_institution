<?php
include("db.php");

if(isset($_GET['approve']))
{
    $id = $_GET['approve'];

    mysqli_query(
        $conn,
        "UPDATE admissions
        SET status='Approved'
        WHERE id='$id'"
    );
}

if(isset($_GET['reject']))
{
    $id = $_GET['reject'];

    mysqli_query(
        $conn,
        "UPDATE admissions
        SET status='Rejected'
        WHERE id='$id'"
    );
}

$result = mysqli_query(
    $conn,
    "SELECT * FROM admissions ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>View Admissions</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Admission Requests</h2>

<table>

<tr>
<th>ID</th>
<th>Student Name</th>
<th>Phone</th>
<th>Email</th>
<th>Course</th>
<th>Message</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['student_name']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['course']; ?></td>
<td><?php echo $row['message']; ?></td>
<td>

<?php
if($row['status']=="Pending")
{
    echo "<span style='color:orange;font-weight:bold;'>Pending</span>";
}
elseif($row['status']=="Approved")
{
    echo "<span style='color:green;font-weight:bold;'>Approved</span>";
}
else
{
    echo "<span style='color:red;font-weight:bold;'>Rejected</span>";
}
?>

</td>

<td>

<a href="view_admissions.php?approve=<?php echo $row['id']; ?>">
Approve
</a>

|

<a href="view_admissions.php?reject=<?php echo $row['id']; ?>">
Reject
</a>

</td>
</tr>
<?php
}
?>

</table>

</body>
</html>

