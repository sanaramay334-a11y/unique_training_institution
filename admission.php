<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db.php");

$setting = mysqli_query($conn, "SELECT * FROM settings LIMIT 1");
$site = mysqli_fetch_assoc($setting);

$message = "";

if(isset($_POST['apply']))
{

$student_name = mysqli_real_escape_string($conn,$_POST['student_name']);
$father_name = mysqli_real_escape_string($conn,$_POST['father_name']);
$dob = mysqli_real_escape_string($conn,$_POST['dob']);
$cnic = mysqli_real_escape_string($conn,$_POST['cnic']);
$gender = mysqli_real_escape_string($conn,$_POST['gender']);
$marital_status = mysqli_real_escape_string($conn,$_POST['marital_status']);
$phone = mysqli_real_escape_string($conn,$_POST['phone']);
$whatsapp = mysqli_real_escape_string($conn,$_POST['whatsapp']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$address = mysqli_real_escape_string($conn,$_POST['address']);
$city = mysqli_real_escape_string($conn,$_POST['city']);

$qualification = mysqli_real_escape_string($conn,$_POST['qualification']);
$board = mysqli_real_escape_string($conn,$_POST['board']);
$passing_year = mysqli_real_escape_string($conn,$_POST['passing_year']);
$total_marks = mysqli_real_escape_string($conn,$_POST['total_marks']);
$obtained_marks = mysqli_real_escape_string($conn,$_POST['obtained_marks']);
$percentage = mysqli_real_escape_string($conn,$_POST['percentage']);

$source = mysqli_real_escape_string($conn,$_POST['source']);
$reason = mysqli_real_escape_string($conn,$_POST['reason']);

$course = "";

if(isset($_POST['course']))
{
    $course = implode(", ", $_POST['course']);
}

$applicant_photo = "";

if(!empty($_FILES['applicant_photo']['name']))
{
    $applicant_photo = time()."_".$_FILES['applicant_photo']['name'];

    move_uploaded_file(
        $_FILES['applicant_photo']['tmp_name'],
        "uploads/".$applicant_photo
    );
}

$cnic_copy = "";

if(!empty($_FILES['cnic_copy']['name']))
{
    $cnic_copy = time()."_".$_FILES['cnic_copy']['name'];

    move_uploaded_file(
        $_FILES['cnic_copy']['tmp_name'],
        "uploads/".$cnic_copy
    );
}

$query = "INSERT INTO admissions
(
student_name,
father_name,
dob,
cnic,
gender,
marital_status,
phone,
whatsapp,
email,
address,
city,
course,
qualification,
board,
passing_year,
total_marks,
obtained_marks,
percentage,
source,
reason,
applicant_photo,
cnic_copy,
status
)
VALUES
(
'$student_name',
'$father_name',
'$dob',
'$cnic',
'$gender',
'$marital_status',
'$phone',
'$whatsapp',
'$email',
'$address',
'$city',
'$course',
'$qualification',
'$board',
'$passing_year',
'$total_marks',
'$obtained_marks',
'$percentage',
'$source',
'$reason',
'$applicant_photo',
'$cnic_copy',
'Pending'
)";

if(mysqli_query($conn,$query))
{
    $message = "<div class='success'>Admission Form Submitted Successfully.</div>";
}
else
{
    $message = "<div class='error'>Error: ".mysqli_error($conn)."</div>";
}

}
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Online Admission | <?php echo $site['institute_name']; ?></title>

<link rel="stylesheet" href="website.css?v=<?php echo time();?>">

</head>

<body>


<div class="navbar">

<div class="logo">

<img src="images/<?php echo $site['logo']; ?>">

<span><?php echo $site['institute_name']; ?></span>

</div>

<div class="menu">

<a href="index.php">Home</a>

<a href="index.php#about">About</a>

<a href="index.php#courses">Courses</a>

<a href="index.php#contact">Contact</a>

<a href="login.php">Admin Login</a>

</div>

</div>


<div class="admission-container">

<div class="form-header">

<img src="images/<?php echo $site['logo']; ?>" class="form-logo">

<h1><?php echo $site['institute_name']; ?></h1>

<h2>ONLINE ADMISSION FORM</h2>

<p>Professional Skills • Modern Education • Career Growth</p>
<p><strong>Phone:</strong> 03214128191</p>

<p><strong>Address:</strong> Green Town, Lahore</p>
</div>

<form method="POST" enctype="multipart/form-data">

<div class="form-section">

<h3>Select Course</h3>

<div class="course-list">

<label><input type="checkbox" name="course[]" value="Office Management"> Office Management</label>

<label><input type="checkbox" name="course[]" value="Digital Marketing"> Digital Marketing</label>

<label><input type="checkbox" name="course[]" value="Graphic Designing"> Graphic Designing</label>

<label><input type="checkbox" name="course[]" value="Web Development"> Web Development</label>

<label><input type="checkbox" name="course[]" value="Python"> Python</label>

<label><input type="checkbox" name="course[]" value="Flutter"> Flutter</label>

<label><input type="checkbox" name="course[]" value="Cyber Security"> Cyber Security</label>

<label><input type="checkbox" name="course[]" value="Artificial Intelligence"> Artificial Intelligence</label>

</div>

</div>

<div class="form-section">

<h3>Personal Information</h3>

<div class="form-grid">

<div>

<label>Full Name</label>

<input type="text" name="student_name" required>

</div>

<div>

<label>Father Name</label>

<input type="text" name="father_name" required>

</div>

<div>

<label>Date of Birth</label>

<input type="date" name="dob">

</div>

<div>

<label>CNIC / B-Form</label>

<input type="text" name="cnic">

</div>

<div>

<label>Gender</label>

<select name="gender">

<option value="">Select</option>

<option>Male</option>

<option>Female</option>

</select>

</div>

<div>

<label>Marital Status</label>

<select name="marital_status">

<option value="">Select</option>

<option>Single</option>

<option>Married</option>

</select>

</div>

<div>

<label>Phone Number</label>

<input type="text" name="phone">

</div>

<div>

<label>WhatsApp</label>

<input type="text" name="whatsapp">

</div>

<div>

<label>Email</label>

<input type="email" name="email">

</div>

<div>

<label>City</label>

<input type="text" name="city">

</div>

<div style="grid-column:1/3;">

<label>Address</label>

<textarea name="address"></textarea>

</div>

</div>

</div>

<div class="form-section">

<h3>Academic Qualification</h3>

<table class="qualification-table">

<tr>

<th>Qualification</th>

<th>Board</th>

<th>Passing Year</th>

<th>Total Marks</th>

<th>Obtained Marks</th>

<th>Percentage</th>

</tr>

<tr>

<td><input type="text" name="qualification"></td>

<td><input type="text" name="board"></td>

<td><input type="text" name="passing_year"></td>

<td><input type="text" name="total_marks"></td>

<td><input type="text" name="obtained_marks"></td>

<td><input type="text" name="percentage"></td>

</tr>

</table>

</div>

<div class="form-section">

<h3>Institute Information</h3>

<label>How did you hear about us?</label>

<select name="source">

<option value="">Select</option>

<option>Facebook</option>

<option>Google</option>

<option>WhatsApp</option>

<option>Friend</option>

<option>Advertisement</option>

<option>Other</option>

</select>

<label>Why do you want to join this course?</label>

<textarea name="reason"></textarea>

</div>
<div class="form-section">

<h3>Upload Documents</h3>

<div class="form-grid">

<div>

<label>Passport Size Photo</label>

<input type="file" name="applicant_photo" accept="image/*">

</div>

<div>

<label>CNIC / B-Form Copy</label>

<input type="file" name="cnic_copy" accept="image/*,.pdf">

</div>

</div>

</div>

<div class="form-section">

<h3>Declaration</h3>

<label>

<input type="checkbox" required>

I hereby declare that all the information provided above is true and correct. I agree to follow all the rules and regulations of the institute.

</label>

</div>

<div class="form-section">

<div class="form-grid">

<div>

<label>Applicant Signature</label>

<input type="text" name="signature" placeholder="Type Your Name">
<div class="form-section">

<h3>FOR OFFICE USE ONLY</h3>

<div class="form-grid">

<div>
<label>Registration No.</label>
<input type="text" readonly placeholder="Auto Generated">
</div>

<div>
<label>Admission Date</label>
<input type="date" readonly>
</div>

<div>
<label>Admission Status</label>
<input type="text" readonly placeholder="Pending">
</div>

<div>
<label>Remarks</label>
<input type="text" readonly>
</div>

</div>

</div>

</div>

<div>

<label>Date</label>

<input type="date" name="apply_date">

</div>

</div>

</div>

<!-- ========================= -->

<div style="text-align:center;margin:35px;">

<button
type="submit"
name="apply"
class="submit-btn">

Submit Application

</button>

</div>

</form>

<?php

if($message!="")
{

echo "<div class='success'>$message</div>";

}

?>

</div>

<footer class="footer">

<h3><?php echo $site['institute_name']; ?></h3>

<p><?php echo $site['address']; ?></p>

<p><?php echo $site['phone']; ?></p>

<p><?php echo $site['footer']; ?></p>

</footer>

</body>

</html>