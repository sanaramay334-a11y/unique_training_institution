<?php
include("db.php");

$data = null;

if(isset($_POST['verify']))
{
    $certificate_id = $_POST['certificate_id'];

    $query = mysqli_query($conn,
    "SELECT * FROM students
    WHERE certificate_id='$certificate_id'");

    if(mysqli_num_rows($query) > 0)
    {
        $data = mysqli_fetch_assoc($query);
    }
}
?>

<!DOCTYPE html>

<html>
<head>
<title>Certificate Verification</title>
<style>

body{
    margin:0;
    font-family:Arial,sans-serif;
    background:#F1F5F9;
}

.verify-container{
    width:600px;
    margin:40px auto;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

.verify-container h2{
    text-align:center;
    color:#0F172A;
    margin-bottom:25px;
}

.verify-container input[type="text"]{
    width:100%;
    padding:12px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #CBD5E1;
    border-radius:8px;
    box-sizing:border-box;
}

.verify-container input[type="submit"]{
    width:100%;
    background:#2563EB;
    color:white;
    border:none;
    padding:14px;
    border-radius:10px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

.verify-container input[type="submit"]:hover{
    background:#1D4ED8;
}

.result-box{
    margin-top:25px;
    padding:20px;
    background:#EEF2FF;
    border-left:5px solid #2563EB;
    border-radius:10px;
}

.result-box h3{
    color:green;
    margin-top:0;
}

.result-box p{
    margin:8px 0;
    font-size:16px;
}

</style>
</head>
<div class="verify-container">

<h2>Certificate Verification</h2>

<form method="POST">

<input type="text"
name="certificate_id"
placeholder="Enter Certificate ID"
required>

<input type="submit"
name="verify"
value="Verify Certificate">

</form>

<?php
if($data)
{
?>
<div class="result-box">

<h3>Certificate Verified ✓</h3>

<p><b>Name:</b>
<?php echo $data['student_name']; ?></p>

<p><b>Course:</b>
<?php echo $data['course']; ?></p>

<p><b>Certificate ID:</b>
<?php echo $data['certificate_id']; ?></p>

</div>
<?php
}
?>
</body>
</html>
</div>
