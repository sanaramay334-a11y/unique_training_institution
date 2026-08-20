<!DOCTYPE html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("db.php");
$setting = mysqli_query($conn,"SELECT * FROM settings LIMIT 1");
$site = mysqli_fetch_assoc($setting);
$total_students = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM students"));
$total_teachers = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM teachers"));
$total_courses = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM courses"));
$total_admissions = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM admissions"));

$courses = mysqli_query($conn,
"SELECT * FROM courses ORDER BY id DESC LIMIT 6");
$notices = mysqli_query($conn,
"SELECT * FROM notices ORDER BY id DESC LIMIT 3");
?>
<html>
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $site['institute_name']; ?> | Professional Courses & Skills Training</title>

<meta name="description" content="Unique Training Institution provides professional IT courses, Web Development, Graphic Designing, Digital Marketing, Flutter, MERN Stack, AI, Cyber Security and career-focused skills training.">

<meta name="keywords" content="Unique Training Institution, Computer Courses, Web Development, Graphic Designing, Digital Marketing, Flutter, MERN Stack, AI, Cyber Security, Professional Training">

<meta name="author" content="Unique Training Institution">

<meta name="robots" content="index, follow">

<link rel="canonical" href="https://uniqueinstitute.infinityfree.me/">

<meta property="og:title" content="Unique Training Institution | Professional Courses & Skills Training">

<meta property="og:description" content="Professional skills training, modern education and career-focused courses at Unique Training Institution.">

<meta property="og:image" content="https://uniqueinstitute.infinityfree.me/images/logo.png">

<meta property="og:url" content="https://uniqueinstitute.infinityfree.me/">

<meta property="og:type" content="website">

<link rel="icon" type="image/png" href="images/<?php echo $site['logo']; ?>">

<link rel="stylesheet" href="website.css?v=<?php echo time(); ?>">

<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

</head>

<body>
    <div id="loader">

<img src="images/logo.png" class="loader-logo">

<div class="loader-text">
Unique Training Institution
</div>

<div class="spinner"></div>

</div>
<div class="navbar">

    <div class="logo">
        <img src="images/<?php echo $site['logo']; ?>?v=<?php echo time(); ?>">
        <span><?php echo $site['institute_name']; ?></span>
    </div>

    <button class="mobile-menu-btn" id="mobileMenuBtn" type="button">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <div class="menu" id="mainMenu">

        <a href="#">Home</a>
        <a href="#about">About</a>
        <a href="#courses">Courses</a>
        <a href="#contact">Contact</a>
        <a href="admission.php">Apply Now</a>
        <a href="admission.php">Check Admission Status</a>
        <a href="check_result.php">Check Result</a>
        <a href="verify_certificate.php">Certificate Verify</a>
        <a href="student_login.php">Student Login</a>
        <a href="login.php">Admin Login</a>

    </div>

</div>
<section class="hero-slider">

<div class="slides fade">
    <img src="images/banner1.jpg">
</div>

<div class="slides fade">
    <img src="images/bannertwo.jpg">
</div>

<div class="slides fade">
    <img src="images/bannerthree.jpg">
</div>

<div class="slides fade">
    <img src="images/bannerfour.jpg">
</div>

<div class="hero-content">

<h1>Unique Training Institution</h1>

<p>
Professional Skills • Modern Education • Career Growth
</p>

<a href="admission.php" class="btn1">
Apply Now
</a>

</div>

</section>

<a href="#courses" class="btn2">
Explore Courses
</a>

<section id="about" class="section" data-aos="fade-up">
<h2>About Us</h2>

<p>
Unique Training Institution provides quality education,
computer courses, professional skills and career development opportunities.
</p>

</section>

<section id="courses" class="section" data-aos="fade-up">

<h2>Popular Courses</h2>

<div class="course-grid">

<?php
while($row = mysqli_fetch_assoc($courses))
{
?>

<div class="course-card" data-aos="zoom-in">

<img src="course_images/<?php echo $row['course_image']; ?>"
alt="<?php echo $row['course_name']; ?>">

<h3><?php echo $row['course_name']; ?></h3>

<p><?php echo $row['description']; ?></p>

<a href="admission.php" class="btn">Apply Now</a>

</div>

<?php
}
?>

</div>

</section>

<section class="section" data-aos="fade-up">

<h2>Latest News & Announcements</h2>

<div class="notice-grid">

<?php
while($notice = mysqli_fetch_assoc($notices))
{
?>

<div class="notice-card" data-aos="fade-right">

<h3><?php echo $notice['title']; ?></h3>

<p><?php echo $notice['description']; ?></p>

</div>

<?php
}
?>

</div>

</section>

<section class="why-us">

<h2>Why Choose Unique Training Institution?</h2>

<div class="why-container">

<div class="why-card" data-aos="flip-left">
<div class="icon">🎓</div>
<h3>Expert Trainers</h3>
<p>Learn from experienced and certified instructors.</p>
</div>

<div class="why-card" data-aos="flip-left">
<div class="icon">💻</div>
<h3>Practical Training</h3>
<p>Hands-on projects with real industry experience.</p>
</div>

<div class="why-card" data-aos="flip-left">
<div class="icon">📜</div>
<h3>Professional Certificate</h3>
<p>Get recognized certificates after course completion.</p>
</div>

<div class="why-card" data-aos="flip-left">
<div class="icon">💼</div>
<h3>Job Assistance</h3>
<p>Career guidance and job placement support.</p>
</div>

<div class="why-card" data-aos="flip-left">
<div class="icon">🤝</div>
<h3>Internship</h3>
<p>Work on live projects during your training.</p>
</div>

<div class="why-card" data-aos="flip-left">
<div class="icon">🌍</div>
<h3>Modern Learning</h3>
<p>Updated courses with latest technologies.</p>
</div>

</div>

</section>
<section class="section">

<h2>Meet Our Expert Trainers</h2>

<div class="course-grid">

<div class="course-card" data-aos="zoom-in">

<img src="images/trainerone.jpg">

<h3>Sir Ali Ahmed</h3>

<p>
Senior Web Development Trainer with 8+ years of experience.
</p>

</div>

<div class="course-card" data-aos="zoom-in">

<img src="images/trainertwo.jpg">

<h3>Miss Ayesha Khan</h3>

<p>
Graphic Designing & UI/UX Specialist.
</p>

</div>

<div class="course-card" data-aos="zoom-in">

<img src="images/trainerthree.jpg">

<h3>Sir Muhammad Usman</h3>

<p>
Digital Marketing & SEO Expert.
</p>

</div>

</div>

</section>

<section class="testimonials">

<h2>What Our Students Say</h2>

<div class="testimonial-slider">

<div class="testimonial active">
<p>
"Excellent learning environment and professional teachers.
I highly recommend Unique Training Institution."
</p>
<h4>— Ali Ahmed</h4>
</div>

<div class="testimonial">
<p>
"I learned Web Development from scratch and got practical experience through projects."
</p>
<h4>— Ayesha Khan</h4>
</div>

<div class="testimonial">
<p>
"Best institute for IT courses with modern teaching methods."
</p>
<h4>— Muhammad Usman</h4>
</div>

</div>

</section>

<div class="stats-section">

    <div class="stats-card students-card">
        <div class="stats-icon">👨‍🎓</div>
        <div class="stats-number">
            <span class="counter" data-target="100">0</span><b>+</b>
        </div>
        <div class="stats-title">Total Students</div>
        <div class="stats-line"></div>
    </div>

    <div class="stats-card teachers-card">
        <div class="stats-icon">👨‍🏫</div>
        <div class="stats-number">
            <span class="counter" data-target="50">0</span><b>+</b>
        </div>
        <div class="stats-title">Teachers</div>
        <div class="stats-line"></div>
    </div>

    <div class="stats-card courses-card">
        <div class="stats-icon">📚</div>
        <div class="stats-number">
            <span class="counter" data-target="10">0</span><b>+</b>
        </div>
        <div class="stats-title">Courses</div>
        <div class="stats-line"></div>
    </div>

    <div class="stats-card admissions-card">
        <div class="stats-icon">📝</div>
        <div class="stats-number">
            <span class="counter" data-target="100">0</span><b>+</b>
        </div>
        <div class="stats-title">Admissions</div>
        <div class="stats-line"></div>
    </div>

</div>

</section>

<section class="section">

<h2>Campus Gallery</h2>

<div class="gallery">

<img src="images/gallery1.jpg" data-aos="zoom-in">
<img src="images/gallery2.jpg" data-aos="zoom-in">
<img src="images/gallery3.jpg" data-aos="zoom-in">
<img src="images/gallery4.jpg" data-aos="zoom-in">

</div>

</section>
<section class="events-section" data-aos="fade-up">

<h2>Latest Events</h2>

<div class="events-grid">

<div class="event-card">
<img src="images/eventone.jpg">
<div class="event-content">
<h3>IT Seminar 2026</h3>
<p>Professional seminar on Artificial Intelligence and Web Development.</p>
</div>
</div>

<div class="event-card">
<img src="images/eventtwo.jpg">
<div class="event-content">
<h3>Graphic Designing Workshop</h3>
<p>Hands-on practical training with Adobe Photoshop and Illustrator.</p>
</div>
</div>

<div class="event-card">
<img src="images/eventthree.jpg">
<div class="event-content">
<h3>Programming Competition</h3>
<p>Students participated in coding and software development competitions.</p>
</div>
</div>

</div>

</section>
<section class="faq-section">

<h2>Frequently Asked Questions</h2>

<div class="faq">

<button class="faq-question">
How can I apply for admission?
</button>

<div class="faq-answer">
<p>You can apply online through our Admission Form or visit our campus.</p>
</div>

<button class="faq-question">
What courses do you offer?
</button>

<div class="faq-answer">
<p>We offer Computer Courses, Web Development, Graphic Designing, Digital Marketing and many more.</p>
</div>

<button class="faq-question">
Do you provide certificates?
</button>

<div class="faq-answer">
<p>Yes, professional certificates are awarded after successful course completion.</p>
</div>

<button class="faq-question">
Is internship available?
</button>

<div class="faq-answer">
<p>Yes, selected students get internship opportunities on live projects.</p>
</div>

</div>

</section>
<footer class="footer">

<h3><?php echo $site['institute_name']; ?></h3>

<p><?php echo $site['address']; ?></p>

<p><?php echo $site['phone']; ?></p>

<p><?php echo $site['footer']; ?></p>


</footer>
<a href="https://wa.me/<?php echo $site['whatsapp']; ?>" class="whatsapp-btn" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" width="40" alt="WhatsApp">
</a>

<a href="ai_assistant.php" class="ai-btn">
🤖
</a>
<script>
let slideIndex = 0;
const slides = document.querySelectorAll(".slides");

function showSlides() {

    slides.forEach(slide => {
        slide.style.display = "none";
    });

    slideIndex++;

    if (slideIndex > slides.length) {
        slideIndex = 1;
    }

    slides[slideIndex - 1].style.display = "block";
}

// First slide show
showSlides();

// Auto change every 3 seconds
setInterval(showSlides, 3000);
</script>


<script>
window.onload = function(){

    document.querySelectorAll(".counter").forEach(function(counter){

        let target = Number(counter.getAttribute("data-target"));
        let count = 0;

        let timer = setInterval(function(){

            count++;

            counter.innerHTML = count;

            if(count >= target){
                counter.innerHTML = target;
                clearInterval(timer);
            }

        },50);

    });

};
</script>
<script>

let testimonialIndex = 0;

const testimonials = document.querySelectorAll(".testimonial");

function showTestimonials(){

testimonials.forEach(t => t.classList.remove("active"));

testimonialIndex++;

if(testimonialIndex > testimonials.length){

testimonialIndex = 1;

}

testimonials[testimonialIndex-1].classList.add("active");

setTimeout(showTestimonials,4000);

}

showTestimonials();

</script>
<script>

window.addEventListener("load",function(){

setTimeout(function(){

document.getElementById("loader").style.display="none";

},1500);

});

</script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
AOS.init({
    duration:1000,
    once:true
});
</script>
<script>
document.querySelectorAll(".faq-question").forEach(function(btn){

btn.addEventListener("click",function(){

let answer=this.nextElementSibling;

if(answer.style.display==="block"){
answer.style.display="none";
}
else{
answer.style.display="block";
}

});

});
</script>

<button id="topBtn">⬆</button>
<script>

const topBtn = document.getElementById("topBtn");

window.onscroll = function(){

if(document.body.scrollTop > 300 || document.documentElement.scrollTop > 300){
topBtn.style.display = "block";
}
else{
topBtn.style.display = "none";
}

};

topBtn.onclick = function(){

window.scrollTo({
top:0,
behavior:"smooth"
});

};

</script>
<script>

document.addEventListener("DOMContentLoaded", function(){

    const counters = document.querySelectorAll(".counter");

    counters.forEach(counter => {

        const target = parseInt(counter.getAttribute("data-count")) || 0;

        let current = 0;

        const duration = 1500;
        const increment = Math.max(1, Math.ceil(target / (duration / 20)));

        const updateCounter = () => {

            current += increment;

            if(current >= target){
                counter.textContent = target;
            }
            else{
                counter.textContent = current;
                setTimeout(updateCounter,20);
            }

        };

        updateCounter();

    });

});

</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const counters = document.querySelectorAll(".counter");

    counters.forEach(counter => {

        const target = parseInt(counter.dataset.target) || 0;
        let current = 0;

        const duration = 1800;
        const steps = 60;
        const increment = target / steps;

        function updateCounter() {

            current += increment;

            if (current >= target) {
                counter.textContent = target;
                return;
            }

            counter.textContent = Math.floor(current);
            requestAnimationFrame(updateCounter);
        }

        updateCounter();
    });

});
</script>
<script>

const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const mainMenu = document.getElementById("mainMenu");

mobileMenuBtn.addEventListener("click", function(){

    mainMenu.classList.toggle("menu-open");

    mobileMenuBtn.classList.toggle("active");

});

</script>
</body>
</html>

