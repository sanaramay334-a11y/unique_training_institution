<?php
include("db.php");

$data = null;
$message = "";

if(isset($_POST['check']))
{
    $phone = $_POST['phone'];

    $stmt = mysqli_prepare(
        $conn,
        "SELECT * FROM admissions WHERE phone=?"
    );

    mysqli_stmt_bind_param($stmt, "s", $phone);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0)
    {
        $data = mysqli_fetch_assoc($result);
    }
    else
    {
        $message = "No Admission Record Found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Check Admission Status</title>

<style>

body{
    margin:0;
    font-family:Arial,sans-serif;
    background:#F1F5F9;
}

.box{
    width:550px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.15);
}

h2{
    text-align:center;
    color:#0F172A;
}

input[type=text]{
    width:100%;
    padding:12px;
    margin:15px 0;
    border:1px solid #ccc;
    border-radius:8px;
    box-sizing:border-box;
}

input[type=submit]{
    width:100%;
    padding:12px;
    background:#2563EB;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
}

input[type=submit]:hover{
    background:#1D4ED8;
}

.result{
    margin-top:25px;
    background:#F8FAFC;
    padding:20px;
    border-radius:10px;
}

.result p{
    margin:8px 0;
    font-size:17px;
}

.error{
    color:red;
    text-align:center;
    font-weight:bold;
}

</style>

</head>
<body>

<div class="box">

<h2>Check Admission Status</h2>

<form method="POST">

<input
type="text"
name="phone"
placeholder="Enter Phone Number"
required>

<input
type="submit"
name="check"
value="Check Status">

</form>

<?php
if($message != "")
{
    echo "<p class='error'>$message</p>";
}

if($data)
{
?>

<div class="result">

<p><b>Student Name:</b> <?php echo $data['student_name']; ?></p>

<p><b>Phone:</b> <?php echo $data['phone']; ?></p>

<p><b>Email:</b> <?php echo $data['email']; ?></p>

<p><b>Course:</b> <?php echo $data['course']; ?></p>

<p><b>Status:</b> <?php echo $data['status']; ?></p>
<?php
if($data['status']=="Approved")
{
?>
<br><br>

<a
href="admission_slip.php?id=<?php echo $data['id']; ?>"
style="
background:#2563EB;
color:white;
padding:12px 20px;
text-decoration:none;
border-radius:8px;
">
Print Admission Slip
</a>

<?php
}
?>

</div>

<?php
}
?>

</div>

</body>
</html>
