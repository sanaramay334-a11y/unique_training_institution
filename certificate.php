<?php
include("db.php");

$id = $_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM students WHERE id='$id'");

$row = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
<title>Certificate</title>

<style>

body{
font-family:Times New Roman;
padding:50px;
}

.certificate{
border:10px solid #2563EB;
padding:50px;
text-align:center;
}

h1{
font-size:50px;
color:#2563EB;
}

.name{
font-size:40px;
font-weight:bold;
margin:20px 0;
}

.course{
font-size:28px;
}

.signature{
margin-top:80px;
display:flex;
justify-content:space-between;
}
@media print{

button{
display:none;
}

body{
margin:0;
padding:0;
}

}

</style>

</head>
<body>

<div class="certificate">

<h1>CERTIFICATE</h1>

<p>This is to certify that</p>

<div class="name">
<?php echo $row['student_name']; ?>
</div>

<p>has successfully completed</p>

<div class="course">
<?php echo $row['course']; ?>
</div>

<p>at Unique Training Institution</p>

<div class="signature">

<div>
________________<br>
Director
</div>

<div>
________________<br>
Principal
</div>

</div>

</div>

</body>

<div style="text-align:center;margin-bottom:20px;">

<button onclick="window.print()"
style="
background:#2563EB;
color:white;
border:none;
padding:12px 25px;
border-radius:8px;
font-size:16px;
cursor:pointer;
font-weight:bold;
">
Print Certificate
</button>

</div>
</html>