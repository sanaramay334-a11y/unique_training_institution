<?php
include("db.php");

$result_data = null;

if(isset($_POST['search']))
{
    $student_name = $_POST['student_name'];

    $query = mysqli_query($conn,
    "SELECT * FROM results
     WHERE student_name='$student_name'");

    if(mysqli_num_rows($query) > 0)
    {
        $result_data = mysqli_fetch_assoc($query);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Check Result</title>

<style>
body{
font-family:Arial,sans-serif;
background:#F1F5F9;
}

.box{
width:600px;
margin:40px auto;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

input{
width:100%;
padding:12px;
margin-bottom:15px;
}

button{
width:100%;
padding:12px;
background:#2563EB;
color:white;
border:none;
cursor:pointer;
}

.result{
margin-top:20px;
padding:15px;
background:#EEF2FF;
border-radius:10px;
}
</style>

</head>
<body>

<div class="box">

<h2>Online Result Verification</h2>

<form method="POST">

<input type="text"
name="student_name"
placeholder="Enter Student Name"
required>

<button name="search">
Check Result
</button>

</form>

<?php
if($result_data)
{
?>
<div class="result">

<h3><?php echo $result_data['student_name']; ?></h3>

<p>Subject:
<?php echo $result_data['subject']; ?></p>

<p>Marks:
<?php echo $result_data['marks']; ?></p>

<p>Percentage:
<?php echo $result_data['percentage']; ?></p>

<p>Grade:
<?php echo $result_data['grade']; ?></p>

<p>Remarks:
<?php echo $result_data['remarks']; ?></p>

</div>
<?php
}
?>

</div>

</body>
</html>
