<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("db.php");

$setting = mysqli_query($conn,"SELECT * FROM settings LIMIT 1");
$site = mysqli_fetch_assoc($setting);

$student_count = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM students")
);

$teacher_count = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM teachers")
);

$course_count = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM courses")
);

$attendance_count = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM attendance")
);

$fee_count = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM fees")
);

$latest_notices = mysqli_query($conn,"
SELECT * FROM notices
ORDER BY id DESC
LIMIT 5
");

$recent_students = mysqli_query($conn,"
SELECT * FROM students
ORDER BY id DESC
LIMIT 5
");

$recent_teachers = mysqli_query($conn,"
SELECT * FROM teachers
ORDER BY id DESC
LIMIT 5
");
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<title>Dashboard - <?php echo htmlspecialchars($site['institute_name']); ?></title>

<link rel="stylesheet" href="style.css">

<style>

/* =========================================
   MOBILE DASHBOARD FIX
   Desktop design remains unchanged
========================================= */

.mobile-dashboard-header{
    display:none;
}


/* Table wrapper */

.mobile-table-wrapper{
    width:100%;
    overflow-x:auto;
    -webkit-overflow-scrolling:touch;
}


/* =========================================
   MOBILE
========================================= */

@media (max-width:768px){

    html,
    body{
        width:100%;
        max-width:100%;
        overflow-x:hidden !important;
    }


    /* -----------------------------
       MOBILE TOP BAR
    ----------------------------- */

    .mobile-dashboard-header{

        display:flex;

        align-items:center;

        justify-content:space-between;

        width:100%;

        height:65px;

        padding:8px 12px;

        background:#0F172A;

        color:white;

        position:sticky;

        top:0;

        z-index:9999;

        box-shadow:0 3px 12px rgba(0,0,0,.2);

    }


    .mobile-dashboard-title{

        display:flex;

        align-items:center;

        gap:8px;

        min-width:0;

    }


    .mobile-dashboard-title img{

        width:42px;

        height:42px;

        object-fit:contain;

        flex-shrink:0;

    }


    .mobile-dashboard-title span{

        font-size:15px;

        font-weight:bold;

        white-space:nowrap;

        overflow:hidden;

        text-overflow:ellipsis;

    }


    /* Hamburger */

    .dashboard-menu-btn{

        width:44px;

        height:44px;

        border:none;

        border-radius:9px;

        background:#2563EB;

        display:flex;

        flex-direction:column;

        justify-content:center;

        align-items:center;

        cursor:pointer;

        flex-shrink:0;

    }


    .dashboard-menu-btn span{

        width:25px;

        height:3px;

        background:white;

        border-radius:5px;

        margin:3px 0;

        transition:.3s ease;

    }


    /* Hamburger to X */

    .dashboard-menu-btn.active span:nth-child(1){

        transform:translateY(9px) rotate(45deg);

    }

    .dashboard-menu-btn.active span:nth-child(2){

        opacity:0;

    }

    .dashboard-menu-btn.active span:nth-child(3){

        transform:translateY(-9px) rotate(-45deg);

    }


    /* -----------------------------
       SIDEBAR
    ----------------------------- */

    .sidebar{

        position:fixed !important;

        top:0 !important;

        left:-280px !important;

        width:260px !important;

        height:100vh !important;

        z-index:10000 !important;

        overflow-y:auto !important;

        transition:left .3s ease !important;

        box-shadow:5px 0 25px rgba(0,0,0,.3);

    }


    .sidebar.mobile-sidebar-open{

        left:0 !important;

    }


    /* Sidebar overlay */

    .dashboard-overlay{

        display:none;

        position:fixed;

        inset:0;

        background:rgba(0,0,0,.45);

        z-index:9998;

    }


    .dashboard-overlay.active{

        display:block;

    }


    /* -----------------------------
       MAIN CONTENT
    ----------------------------- */

    .main-content{

        margin-left:0 !important;

        width:100% !important;

        max-width:100% !important;

        padding:12px !important;

        overflow-x:hidden !important;

    }


    /* -----------------------------
       MAIN HEADING
    ----------------------------- */

    .main-content > h1{

        font-size:27px !important;

        line-height:1.25 !important;

        margin:10px 0 15px !important;

        word-break:break-word;

    }


    /* -----------------------------
       WELCOME BANNER
    ----------------------------- */

    .welcome-banner{

        width:100% !important;

        height:260px !important;

        margin:0 0 18px 0 !important;

        border-radius:16px !important;

        background-size:cover !important;

        background-position:center !important;

    }


    .welcome-overlay{

        width:100% !important;

        height:100% !important;

        padding:20px !important;

        background:rgba(255,255,255,.82) !important;

        box-sizing:border-box !important;

    }


    .welcome-overlay h2{

        font-size:28px !important;

        line-height:1.25 !important;

        margin:0 0 10px !important;

    }


    .welcome-overlay p{

        font-size:15px !important;

        line-height:1.5 !important;

        margin:0 !important;

    }


    /* -----------------------------
       STAT CARDS
    ----------------------------- */

    .cards-container{

        display:flex !important;

        flex-direction:column !important;

        width:100% !important;

        max-width:100% !important;

        gap:15px !important;

    }


    .stat-card{

        width:100% !important;

        min-width:0 !important;

        max-width:100% !important;

        flex:none !important;

        padding:20px !important;

        margin:0 !important;

    }


    .stat-card .icon{

        font-size:38px !important;

    }


    .stat-card h3{

        font-size:17px !important;

    }


    .stat-card h1{

        font-size:36px !important;

        margin:8px 0 !important;

    }


    /* -----------------------------
       DASHBOARD ROW
    ----------------------------- */

    .dashboard-row{

        display:flex !important;

        flex-direction:column !important;

        width:100% !important;

        gap:15px !important;

        margin-top:15px !important;

    }


    .dashboard-row .card{

        width:100% !important;

        min-width:0 !important;

        flex:none !important;

    }


    .card{

        width:100% !important;

        max-width:100% !important;

        min-width:0 !important;

        padding:18px !important;

        margin:0 !important;

        overflow:hidden;

    }


    .card h3{

        font-size:19px;

    }


    /* -----------------------------
       TABLES
    ----------------------------- */

    .card table{

        width:650px !important;

        max-width:none !important;

        margin:0;

    }


    .mobile-table-wrapper{

        width:100%;

        overflow-x:auto;

    }


    table th,
    table td{

        white-space:nowrap;

        padding:10px;

    }


    /* -----------------------------
       FLOATING BUTTONS
    ----------------------------- */

    .whatsapp-btn,
    .ai-btn{

        width:52px !important;

        height:52px !important;

        right:12px !important;

    }


    .whatsapp-btn{

        bottom:15px !important;

    }


    .ai-btn{

        bottom:78px !important;

        font-size:25px !important;

    }


    .whatsapp-btn img{

        width:28px !important;

        height:28px !important;

    }

}

</style>

</head>

<body>

<!-- =========================================
     MOBILE TOP BAR
========================================= -->

<div class="mobile-dashboard-header">
<div class="mobile-dashboard-title">

    <img
    src="images/<?php echo $site['logo']; ?>?v=<?php echo time(); ?>"
    alt="Logo">

    <span>
        <?php echo htmlspecialchars($site['institute_name']); ?>
    </span>

</div>


<button
type="button"
class="dashboard-menu-btn"
id="dashboardMenuBtn"
aria-label="Open Menu">

    <span></span>
    <span></span>
    <span></span>

</button>

</div>

<!-- MOBILE OVERLAY -->

<div
class="dashboard-overlay"
id="dashboardOverlay">
</div>

<!-- =========================================
     SIDEBAR
========================================= -->

<div class="sidebar" id="dashboardSidebar">

<div class="logo-section">
<img
src="images/<?php echo $site['logo']; ?>?v=<?php echo time(); ?>"
style="width:70px;height:70px;object-fit:contain;">

<h2>
    <?php echo htmlspecialchars($site['institute_name']); ?>
</h2>

</div>

<a href="dashboard.php">📊 Dashboard</a>

<hr>

<h4>STUDENTS</h4>

<a href="add_student.php">👨‍🎓 Add Student</a>

<a href="view_students.php">📋 View Students</a>

<a href="student_report.php">📄 Student Report</a>

<a href="student_dashboard.php">🎓 Student Dashboard</a>

<hr>

<h4>TEACHERS</h4>

<a href="add_teacher.php">👨‍🏫 Add Teacher</a>

<a href="view_teachers.php">📋 View Teachers</a>

<hr>

<h4>COURSES</h4>

<a href="add_course.php">📚 Add Course</a>

<a href="view_courses.php">📚 View Courses</a>

<hr>

<h4>ADMISSIONS</h4>

<a href="view_admissions.php">📄 Admissions</a>

<hr>

<h4>ATTENDANCE</h4>

<a href="attendance.php">📅 Attendance</a>

<a href="attendance_report.php">📄 Attendance Report</a>

<hr>

<h4>FEES</h4>

<a href="add_fee.php">💰 Add Fee</a>

<a href="view_fees.php">💵 View Fees</a>

<a href="pending_fees.php">⚠ Pending Fees</a>

<a href="fee_report.php">📑 Fee Report</a>

<hr>

<h4>RESULTS</h4>

<a href="add_result.php">📝 Add Result</a>

<a href="view_results.php">📋 View Results</a>

<hr>

<h4>SYSTEM</h4>

<a href="add_notice.php">📢 Add Notice</a>

<a href="change_password.php">Change Password</a>

<a href="settings.php">Website Settings</a>

<a href="view_audit_logs.php">📜 Audit Logs</a>

<a href="ai_assistant.php">🤖 AI Assistant</a>

<a href="logout.php">🚪 Logout</a>

</div>

<!-- =========================================
     MAIN CONTENT
========================================= -->

<div class="main-content">

<h1>
    Unique Training Institution
</h1>

<!-- WELCOME -->

<div class="welcome-banner">
<div class="welcome-overlay">

    <h2>
        Welcome to Unique Training Institution
    </h2>

    <p>
        Manage Students, Teachers, Courses,
        Attendance, Fees and Results from one place.
    </p>

</div>

</div>

<!-- =========================================
     STATISTICS
========================================= -->

<div class="cards-container">

<div class="stat-card">

<div class="icon">👨‍🎓</div>

<h3>Total Students</h3>

<h1>
    <?php echo $student_count; ?>
</h1>

<a href="view_students.php">
    View All Students
</a>

</div>

<div class="stat-card">

<div class="icon">👨‍🏫</div>

<h3>Total Teachers</h3>

<h1>
    <?php echo $teacher_count; ?>
</h1>

<a href="view_teachers.php">
    View All Teachers
</a>


</div>

<div class="stat-card">
<div class="icon">📚</div>

<h3>Total Courses</h3>

<h1>
    <?php echo $course_count; ?>
</h1>

<a href="view_courses.php">
    View All Courses
</a>

</div>

<div class="stat-card">
<div class="icon">📅</div>

<h3>Total Attendance</h3>

<h1>
    <?php echo $attendance_count; ?>
</h1>

<a href="attendance_report.php">
    View Attendance
</a>

</div>

<div class="stat-card">
<div class="icon">💰</div>

<h3>Total Fees</h3>

<h1>
    <?php echo $fee_count; ?>
</h1>

<a href="fee_report.php">
    View Fee Records
</a>


</div>

</div>

<!-- =========================================
     RECENT STUDENTS
========================================= -->

<div class="dashboard-row">

<div class="card">

<h3>Recent Students</h3>

<div class="mobile-table-wrapper">

<table>

<tr>

<th>ID</th>

<th>Name</th>

<th>Father Name</th>

<th>Course</th>

<th>Phone</th>

</tr>

<?php

while($student = mysqli_fetch_assoc($recent_students))
{

?>

<tr>

<td>
<?php echo htmlspecialchars($student['id']); ?>
</td>

<td>
<?php echo htmlspecialchars($student['student_name']); ?>
</td>

<td>
<?php echo htmlspecialchars($student['father_name']); ?>
</td>

<td>
<?php echo htmlspecialchars($student['course']); ?>
</td>

<td>
<?php echo htmlspecialchars($student['phone']); ?>
</td>

</tr>

<?php

}

?>

</table>

</div>

<br>

<a
class="edit-btn"
href="view_students.php">

View All Students

</a>

</div>

<!-- =========================================
     RECENT TEACHERS
========================================= -->

<div class="card">

<h3>Recent Teachers</h3>

<div class="mobile-table-wrapper">

<table>

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Phone</th>

<th>Specialization</th>

</tr>

<?php

while($teacher = mysqli_fetch_assoc($recent_teachers))
{

?>

<tr>

<td>
<?php echo htmlspecialchars($teacher['id']); ?>
</td>

<td>
<?php echo htmlspecialchars($teacher['teacher_name']); ?>
</td>

<td>
<?php echo htmlspecialchars($teacher['email']); ?>
</td>

<td>
<?php echo htmlspecialchars($teacher['phone']); ?>
</td>

<td>
<?php echo htmlspecialchars($teacher['specialization']); ?>
</td>

</tr>

<?php

}

?>

</table>

</div>

<br>

<a
class="edit-btn"
href="view_teachers.php">

View All Teachers

</a>

</div>

<!-- =========================================
     LATEST NOTICES
========================================= -->

<div class="card">

<h3>Latest Notices</h3>

<?php

while($notice = mysqli_fetch_assoc($latest_notices))
{

?>

<p>

<strong>
<?php echo htmlspecialchars($notice['title']); ?>
</strong>

<br>

<?php echo htmlspecialchars($notice['description']); ?>

</p>

<hr>

<?php

}

?>

</div>

</div>

<!-- AI BUTTON -->

<a
href="ai_assistant.php"
class="ai-btn">

🤖

</a>

</div>

<!-- WHATSAPP -->

<a
href="https://wa.me/923214128191"
class="whatsapp-btn"
target="_blank">

<img
src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
width="35"
alt="WhatsApp">

</a>

<!-- =========================================
     MOBILE MENU JAVASCRIPT
========================================= -->

<script>

const dashboardMenuBtn =
document.getElementById("dashboardMenuBtn");

const dashboardSidebar =
document.getElementById("dashboardSidebar");

const dashboardOverlay =
document.getElementById("dashboardOverlay");


function openDashboardMenu(){

    dashboardSidebar.classList.add(
        "mobile-sidebar-open"
    );

    dashboardOverlay.classList.add(
        "active"
    );

    dashboardMenuBtn.classList.add(
        "active"
    );

}


function closeDashboardMenu(){

    dashboardSidebar.classList.remove(
        "mobile-sidebar-open"
    );

    dashboardOverlay.classList.remove(
        "active"
    );

    dashboardMenuBtn.classList.remove(
        "active"
    );

}


dashboardMenuBtn.addEventListener(
    "click",
    function(){

        if(
            dashboardSidebar.classList.contains(
                "mobile-sidebar-open"
            )
        ){

            closeDashboardMenu();

        }else{

            openDashboardMenu();

        }

    }
);


dashboardOverlay.addEventListener(
    "click",
    function(){

        closeDashboardMenu();

    }
);


/* Close menu after clicking a link */

const dashboardLinks =
dashboardSidebar.querySelectorAll("a");

dashboardLinks.forEach(function(link){

    link.addEventListener(
        "click",
        function(){

            closeDashboardMenu();

        }
    );

});

</script>

</body>

</html>
