<?php
include("db.php");
$setting = mysqli_query($conn,"SELECT * FROM settings LIMIT 1");
$site = mysqli_fetch_assoc($setting);
$id = $_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM students WHERE id='$id'");

$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Student ID Card</title>

<style>

body{
font-family:Arial,sans-serif;
background:#F1F5F9;
}

.id-card{
width:380px;
margin:40px auto;
background:white;
border-radius:20px;
overflow:hidden;
box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

.header{
background:#2563EB;
color:white;
text-align:center;
padding:15px;
}

.header h2{
margin:0;
}

.photo{
text-align:center;
padding:20px;
}

.photo img{
width:120px;
height:120px;
border-radius:50%;
object-fit:cover;
border:4px solid #2563EB;
}

.details{
padding:20px;
}

.details p{
margin:10px 0;
font-size:16px;
}

.print-btn{
text-align:center;
padding:20px;
}

.print-btn button{
background:#2563EB;
color:white;
border:none;
padding:12px 25px;
border-radius:8px;
cursor:pointer;
font-weight:bold;
}

@media print{
.print-btn{
display:none;
}
}

.signature{
    display:flex;
    justify-content:space-between;
    padding:20px;
}

.qr-section{
    text-align:center;
    margin:20px auto;
}

.qr-section img{
    width:120px;
    height:120px;
    display:block;
    margin:0 auto;
    border:none;
    border-radius:0;
}

.qr-section p{
    margin-top:8px;
    font-weight:bold;
}

</style>

</head>
<body>

<div class="id-card">


<div class="header">


<img src="images/<?php echo $site['logo']; ?>" width="70">

<h2>Unique Training Institution</h2>

<p>Official Student ID Card</p>

</div>

<div class="photo">
<img src="uploads/<?php echo $row['picture']; ?>">
</div>

<div class="details">

<p><b>Student ID:</b>
UTI-<?php echo str_pad($row['id'],4,"0",STR_PAD_LEFT); ?></p>

<p><b>Name:</b>
<?php echo $row['student_name']; ?></p>

<p><b>Father Name:</b>
<?php echo $row['father_name']; ?></p>

<p><b>Class:</b>
<?php echo $row['class_name']; ?></p>

<p><b>Course:</b>
<?php echo $row['course']; ?></p>

<p><b>Email:</b>
<?php echo $row['email']; ?></p>

<p><b>Phone:</b>
<?php echo $row['phone']; ?></p>

<p><b>Issue Date:</b>
<?php echo date("d-m-Y"); ?></p>

</div>

<div class="signature">

<div>
_________________<br>
Student
</div>

<div>
_________________<br>
Principal
</div>

</div>

<div class="qr-section">

<img src="https://api.qrserver.com/v1/create-qr-code/?size=140x140&data=http://localhost/unique_training_institution/verify_student.php?id=<?php echo $row['id']; ?>">

<p>Scan to Verify</p>

</div>


<div class="print-btn">
<button onclick="window.print()">
Print ID Card
</button>
</div>

<div style="
text-align:center;
padding:10px;
background:#2563EB;
color:white;
font-size:12px;
">

Canal Road, Near Jag House, Haroonabad<br>

0301-0000000 | 0371-000000

</div>

</div>

</body>
</html>